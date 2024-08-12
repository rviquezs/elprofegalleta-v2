<?php

declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include_once __DIR__ . '/../public/connection.php';
require '../vendor/phpmailer/phpmailer/src/Exception.php';
require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../vendor/phpmailer/phpmailer/src/SMTP.php';

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', function (Request $request, Response $response) {
        ob_start();
        include __DIR__ . '/../../index.php'; // Adjust the path correctly
        $output = ob_get_clean();
        $response->getBody()->write($output);
        return $response;
    });

    // Endpoints Inscripciones

    // Guardar Inscripcion
    $app->post('/guardarInscripcion', function (Request $request, Response $response) {
        //abrir la conexion
        $db = connection();

        //determinar el registro a guardar
        $rec = $request->getQueryParams();
        var_dump($rec);

        //insertar en la bd
        $res = $db->AutoExecute("inscripciones", $rec, "INSERT");
        $db->Close();

        $response->getBody()->write(strval($res));
        return $response;
    });

    // actualizar inscripciones
    $app->put('/actualizarInscripcion', function (Request $request, Response $response) {
        //abrir la conexion
        $db = connection();

        $rec = $request->getQueryParams();
        $res = $db->AutoExecute("inscripciones", $rec, "UPDATE", "usuario='$rec[usuario]'");
        $db->Close();

        $response->getBody()->write(strval($res));
        return $response;
    });

    // eliminar inscripciones
    $app->delete('/eliminarInscripcion/{usuario}', function (Request $request, Response $response, array $args) {
        $usuario = $args["usuario"];
        $db = connection();

        $sql = "DELETE FROM inscripciones WHERE usuario='$usuario'";

        if ($db->Execute($sql)) {
            $res = 1;
        } else {
            $res = 0;
        }

        $response->getBody()->write(strval($res));
        return $response;
    });

    // obtener todas las inscripciones
    $app->get('/obtenerInscripciones', function (Request $request, Response $response) {
        $db = connection();

        $db->SetFetchMode("ADODB_FETCH_ASSOC");

        $sql = "SELECT * FROM inscripciones";

        $res = $db->GetAll($sql);
        $response->getBody()->write(json_encode($res));
        return $response;
    });

    // obtener inscripciones por nombre de usuario
    $app->get('/obtenerInscripciones/{usuario}', function (Request $request, Response $response, array $args) {
        $usuario = $args["usuario"];
        $db = connection();

        $db->SetFetchMode("ADODB_FETCH_ASSOC");

        $sql = "SELECT * FROM inscripciones WHERE  usuario='$usuario'";

        $res = $db->GetAll($sql);
        $response->getBody()->write(json_encode($res));
        return $response;
    });

    //ENDPOINTS TABLA CURSOS

    // guardar curso
    $app->post('/guardarCurso', function (Request $request, Response $response) {
        $db = connection();
        $data = $request->getParsedBody();
        $uploadedFiles = $request->getUploadedFiles();

        // Extract course data
        $courseName = $data['courseName'];
        $duration = $data['duration'];
        $mode = $data['mode'];
        $description = $data['description'];
        $category = $data['category'];
        $price = $data['price'];
        $promoterName = $data['promoterName'];

        // Decode images
        $images = json_decode($data['images'], true);
        $images = array_map(function ($img) {
            return str_replace('data:image/png;base64,', '', $img);
        }, $images);

        // Save course data to database
        $sql = "INSERT INTO cursos (name, duration, modalidad, description, category, price, promoter_name)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([$courseName, $duration, $mode, $description, $category, $price, $promoterName]);

        // Get the last inserted course ID
        $courseId = $db->lastInsertId();

        // Save images to database
        foreach ($images as $image) {
            $sql = "INSERT INTO course_images (course_id, image_data) VALUES (?, ?)";
            $stmt = $db->prepare($sql);
            $stmt->execute([$courseId, $image]);
        }

        $response->getBody()->write(json_encode(['status' => 'success']));
        return $response;
    });


    // actualizar cursos
    $app->put('/actualizarCurso', function (Request $request, Response $response) {
        $db = connection();

        $rec = $request->getQueryParams();
        $res = $db->AutoExecute("cursos", $rec, "UPDATE", "id_curso='$rec[id_curso]'");
        $db->Close();

        $response->getBody()->write(strval($res));
        return $response;
    });

    // eliminar cursos
    $app->delete('/eliminarCurso/{id_curso}', function (Request $request, Response $response, array $args) {
        $id_curso = $args["id_curso"];
        $db = connection();

        $sql = "DELETE FROM cursos WHERE id_curso='$id_curso'";

        if ($db->Execute($sql)) {
            $res = 1;
        } else {
            $res = 0;
        }

        $response->getBody()->write(strval($res));
        return $response;
    });

    // Obtener todos los cursos S
    $app->get('/obtenerTodosCursos', function (Request $request, Response $response) {
        $db = connection();
        $db->SetFetchMode("ADODB_FETCH_ASSOC");

        $sql = "SELECT cursos.id, cursos.name, cursos.duration, cursos.modalidad, cursos.category, cursos.price, 
                promotores.name AS promotor, cursos.img1, COUNT(inscripciones.user_id) AS inscription_count FROM cursos 
                JOIN promotores ON cursos.promoter = promotores.id 
                LEFT JOIN inscripciones ON cursos.id = inscripciones.course_id
                GROUP BY cursos.id, promotores.name;";
        
        $res = $db->GetAll($sql);
        $response->getBody()->write(json_encode($res));
        return $response;
    });


    // Filtrar cursos por categoria
    $app->get('/filtrarCursos[/{category}]', function (Request $request, Response $response, $args) {
        $category = $args['category'] ?? '';
        $db = connection();
        $db->SetFetchMode("ADODB_FETCH_ASSOC");
    
        // Build SQL query with filters
        $sql = "SELECT cursos.name, cursos.duration, cursos.modalidad, cursos.category, cursos.price, 
                promotores.name AS promotor, COUNT(inscripciones.user_id) AS inscription_count 
                FROM cursos 
                JOIN promotores ON cursos.promoter = promotores.id 
                LEFT JOIN inscripciones ON cursos.id = inscripciones.course_id
                WHERE (cursos.category LIKE ? OR ? = '') 
                GROUP BY cursos.id, promotores.name;";
    
        $params = ["%$category%", $category];
        $res = $db->GetAll($sql, $params);
        $response->getBody()->write(json_encode($res));
        return $response;
    });
    

    //ENDPOINTS TABLA PROMOTORES

    // guardar promotores
    $app->post('/guardarPromotor', function (Request $request, Response $response) {
        $db = connection();

        $rec = $request->getQueryParams();

        $res = $db->AutoExecute("promotores", $rec, "INSERT");
        $db->Close();

        $response->getBody()->write(strval($res));
        return $response;
    });

    // actualizar promotores
    $app->put('/actualizarPromotor', function (Request $request, Response $response) {
        $db = connection();

        $rec = $request->getQueryParams();

        $res = $db->AutoExecute("promotores", $rec, "UPDATE", "id_promotor='$rec[id_promotor]'");
        $db->Close();

        $response->getBody()->write(strval($res));
        return $response;
    });

    // eliminar promotores
    $app->delete('/eliminarPromotor/{id_promotor}', function (Request $request, Response $response, array $args) {
        $id_promotor = $args["id_promotor"];
        $db = connection();

        $sql = "DELETE FROM promotores WHERE id_promotor='$id_promotor'";

        if ($db->Execute($sql)) {
            $res = 1;
        } else {
            $res = 0;
        }

        $response->getBody()->write(strval($res));
        return $response;
    });

    // obtener todos los promotores
    $app->get('/obtenerTodosPromotores', function (Request $request, Response $response) {
        $db = connection();

        $db->SetFetchMode("ADODB_FETCH_ASSOC");

        $sql = "SELECT * FROM promotores";

        $res = $db->GetAll($sql);
        $response->getBody()->write(json_encode($res));
        return $response;
    });

    // obtener todos por id_promotor
    $app->get('/obtenerPromotor/{id_promotor}', function (Request $request, Response $response, array $args) {
        $id_promotor = $args["id_promotor"];
        $db = connection();

        //cambiar el metodo fetch
        $db->SetFetchMode("ADODB_FETCH_ASSOC");

        //generar ka consulta
        $sql = "SELECT * FROM promotores WHERE  id_promotor='$id_promotor'";
        //ejecutar la consulta
        $res = $db->GetAll($sql);
        $response->getBody()->write(json_encode($res));
        return $response;
    });

    //ENDPOINTS TABLA USUARIOS

    // guardar usuarios
    $app->post('/guardarUsuario', function (Request $request, Response $response) {
        $db = connection();

        $rec = $request->getQueryParams();

        $res = $db->AutoExecute("usuarios", $rec, "INSERT");
        $db->Close();

        $response->getBody()->write(strval($res));
        return $response;
    });

    // actualizar usuarios
    $app->put('/actualizarUsuario', function (Request $request, Response $response) {
        $db = connection();

        $rec = $request->getQueryParams();
        $res = $db->AutoExecute("usuarios", $rec, "UPDATE", "cedula='$rec[cedula]'");
        $db->Close();

        $response->getBody()->write(strval($res));
        return $response;
    });

    // actualizar usuarios
    $app->delete('/eliminarUsuario/{cedula}', function (Request $request, Response $response, array $args) {
        $cedula = $args["cedula"];
        $db = connection();

        $sql = "DELETE FROM usuarios WHERE cedula='$cedula'";

        if ($db->Execute($sql)) {
            $res = 1;
        } else {
            $res = 0;
        }

        $response->getBody()->write(strval($res));
        return $response;
    });

    // obtener todos los usuarios
    $app->get('/obtenerTodosUsuarios', function (Request $request, Response $response) {
        $db = connection();

        $db->SetFetchMode("ADODB_FETCH_ASSOC");

        $sql = "SELECT * FROM usuarios";

        $res = $db->GetAll($sql);
        $response->getBody()->write(json_encode($res));
        return $response;
    });

    // obtener por id_promotor
    $app->get('/obtenerUsuario/{cedula}', function (Request $request, Response $response, array $args) {
        $cedula = $args["cedula"];
        $db = connection();

        //cambiar el metodo fetch
        $db->SetFetchMode("ADODB_FETCH_ASSOC");

        //generar ka consulta
        $sql = "SELECT * FROM usuarios WHERE  cedula='$cedula'";
        //ejecutar la consulta
        $res = $db->GetAll($sql);
        $response->getBody()->write(json_encode($res));
        return $response;
    });

    //ENDPOINTS TABLA ADMINISTRADORES

    // guardar administradores
    $app->post('/guardarAdministrador', function (Request $request, Response $response) {
        $db = connection();

        $rec = $request->getQueryParams();

        $res = $db->AutoExecute("administradores", $rec, "INSERT");
        $db->Close();

        $response->getBody()->write(strval($res));
        return $response;
    });

    // actualizar administradores
    $app->put('/actualizarAdministrador', function (Request $request, Response $response) {
        $db = connection();

        $rec = $request->getQueryParams();
        $res = $db->AutoExecute("administradores", $rec, "UPDATE", "id_admin='$rec[id_admin]'");
        $db->Close();

        $response->getBody()->write(strval($res));
        return $response;
    });

    // eliminar administradores
    $app->delete('/eliminarAdministrador/{id_admin}', function (Request $request, Response $response, array $args) {
        $id_admin = $args["id_admin"];
        //abrir la conexion
        $db = connection();

        //crear la consulta
        $sql = "DELETE FROM vehiculos WHERE id_admin='$id_admin'";

        //ejecutar consulta
        if ($db->Execute($sql)) {
            $res = 1;
        } else {
            $res = 0;
        }

        $response->getBody()->write(strval($res));
        return $response;
    });

    // obtener todos los administradores
    $app->get('/obtenerTodosAdmin', function (Request $request, Response $response) {
        $db = connection();

        //cambiar el metodo fetch
        $db->SetFetchMode("ADODB_FETCH_ASSOC");

        $sql = "SELECT * FROM administradores";

        $res = $db->GetAll($sql);
        $response->getBody()->write(json_encode($res));
        return $response;
    });

    // obtener por id_admin
    $app->get('/obtenerAdmin/{id_admin}', function (Request $request, Response $response, array $args) {
        $id_admin = $args["id_admin"];
        $db = connection();

        //cambiar el metodo fetch
        $db->SetFetchMode("ADODB_FETCH_ASSOC");

        //generar ka consulta
        $sql = "SELECT * FROM administradores WHERE  id_admin='$id_admin'";
        //ejecutar la consulta
        $res = $db->GetAll($sql);
        $response->getBody()->write(json_encode($res));
        return $response;
    });

    // Enviar correo desde el formulario de contacto
    $app->post('/send-email', function (Request $request, Response $response, array $args) {
        $data = $request->getParsedBody();

        // Sanitize and validate input
        $name = filter_var($data['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
        $phone = filter_var($data['phone'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $message = filter_var($data['message'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // Validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $response->getBody()->write(json_encode(['status' => 'error', 'message' => 'Invalid email format']));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }

        // Create a new PHPMailer instance
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();  // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  // Specify main SMTP server
            $mail->SMTPAuth = true;  // Enable SMTP authentication
            $mail->Username = 'profegalleta8@gmail.com';  // SMTP username (Gmail address)
            $mail->Password = 'mjgo mfpo bxvu xmss ';  // SMTP password (App password)
            $mail->SMTPSecure = 'tls';  // Enable TLS encryption; `PHPMailer::ENCRYPTION_STARTTLS` also accepted
            $mail->Port = 587;  // TCP port to connect to              

            // Recipients
            $mail->setFrom('profegalleta8@gmail.com', 'noreply');
            $mail->addAddress('profegalleta8@gmail.com', 'noreply');

            // Content
            $mail->isHTML(true);                                    // Set email format to HTML
            $mail->Subject = 'Contact Form Submission';
            $mail->Body    = "Name: $name<br>Email: $email<br>Phone: $phone<br>Message:<br>$message";
            $mail->AltBody = "Name: $name\nEmail: $email\nPhone: $phone\nMessage:\n$message";

            // Send the email
            if ($mail->send()) {
                $response->getBody()->write(json_encode(['status' => 'success', 'message' => 'Email sent successfully']));
                return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
            } else {
                $response->getBody()->write(json_encode(['status' => 'error', 'message' => 'Failed to send email']));
                return $response->withHeader('Content-Type', 'application/json')->withStatus(500);
            }
        } catch (Exception $e) {
            $response->getBody()->write(json_encode(['status' => 'error', 'message' => "Mailer Error: {$mail->ErrorInfo}"]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(500);
        }
    });
};
