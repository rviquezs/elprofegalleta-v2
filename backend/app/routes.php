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


    //ENDPOINTS TABLA INSCRIPCIONES

    //endpoint guardar inscripciones
    $app->post('/guardarInscripciones', function (Request $request, Response $response) {
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

    //endpoint actualizar inscripciones
    $app->put('/actualizarInscripciones', function (Request $request, Response $response) {
        //abrir la conexion
        $db = connection();

        $rec = $request->getQueryParams();
        $res = $db->AutoExecute("inscripciones", $rec, "UPDATE", "usuario='$rec[usuario]'");
        $db->Close();

        $response->getBody()->write(strval($res));
        return $response;
    });

    //endpoint eliminar inscripciones
    $app->delete('/eliminarInscripciones/{usuario}', function (Request $request, Response $response, array $args) {
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

    //endpoint obtener todas las inscripciones
    $app->get('/obtenerTodasInscripciones', function (Request $request, Response $response) {
        $db = connection();

        $db->SetFetchMode("ADODB_FETCH_ASSOC");

        $sql = "SELECT * FROM inscripciones";

        $res = $db->GetAll($sql);
        $response->getBody()->write(json_encode($res));
        return $response;
    });

    //endpoint obtener inscripciones por nombre de usuario
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

    //endpoint guardar cursos
    $app->post('/guardarCurso', function (Request $request, Response $response) {
        $db = connection();

        $rec = $request->getQueryParams();

        $res = $db->AutoExecute("cursos", $rec, "INSERT");
        $db->Close();

        $response->getBody()->write(strval($res));
        return $response;
    });

    //endpoint actualizar cursos
    $app->put('/actualizarCurso', function (Request $request, Response $response) {
        $db = connection();

        $rec = $request->getQueryParams();
        $res = $db->AutoExecute("cursos", $rec, "UPDATE", "id_curso='$rec[id_curso]'");
        $db->Close();

        $response->getBody()->write(strval($res));
        return $response;
    });

    //endpoint eliminar cursos
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

    //endpoint obtener todos los cursos
    $app->get('/obtenerTodosCursos', function (Request $request, Response $response) {
        $db = connection();

        $db->SetFetchMode("ADODB_FETCH_ASSOC");

        $sql = "SELECT * FROM cursos";
        $res = $db->GetAll($sql);
        $response->getBody()->write(json_encode($res));
        return $response;
    });

    //endpoint cursos por id_curso
    $app->get('/obtenerCurso/{id_curso}', function (Request $request, Response $response, array $args) {
        $id_curso = $args["id_curso"];
        $db = connection();

        $db->SetFetchMode("ADODB_FETCH_ASSOC");

        $sql = "SELECT * FROM cursos WHERE  id_curso='$id_curso'";

        $res = $db->GetAll($sql);
        $response->getBody()->write(json_encode($res));
        return $response;
    });

    //ENDPOINTS TABLA PROMOTORES

    //endpoint guardar promotores
    $app->post('/guardarPromotor', function (Request $request, Response $response) {
        $db = connection();

        $rec = $request->getQueryParams();

        $res = $db->AutoExecute("promotores", $rec, "INSERT");
        $db->Close();

        $response->getBody()->write(strval($res));
        return $response;
    });

    //endpoint actualizar promotores
    $app->put('/actualizarPromotor', function (Request $request, Response $response) {
        $db = connection();

        $rec = $request->getQueryParams();

        $res = $db->AutoExecute("promotores", $rec, "UPDATE", "id_promotor='$rec[id_promotor]'");
        $db->Close();

        $response->getBody()->write(strval($res));
        return $response;
    });

    //endpoint eliminar promotores
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

    //endpoint obtener todos los promotores
    $app->get('/obtenerTodosPromotores', function (Request $request, Response $response) {
        $db = connection();

        $db->SetFetchMode("ADODB_FETCH_ASSOC");

        $sql = "SELECT * FROM promotores";

        $res = $db->GetAll($sql);
        $response->getBody()->write(json_encode($res));
        return $response;
    });

    //endpoint obtener todos por id_promotor
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

    //endpoint guardar usuarios
    $app->post('/guardarUsuario', function (Request $request, Response $response) {
        $db = connection();

        $rec = $request->getQueryParams();

        $res = $db->AutoExecute("usuarios", $rec, "INSERT");
        $db->Close();

        $response->getBody()->write(strval($res));
        return $response;
    });

    //endpoint actualizar usuarios
    $app->put('/actualizarUsuario', function (Request $request, Response $response) {
        $db = connection();

        $rec = $request->getQueryParams();
        $res = $db->AutoExecute("usuarios", $rec, "UPDATE", "cedula='$rec[cedula]'");
        $db->Close();

        $response->getBody()->write(strval($res));
        return $response;
    });

    //endpoint actualizar usuarios
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

    //endpoint obtener todos los usuarios
    $app->get('/obtenerTodosUsuarios', function (Request $request, Response $response) {
        $db = connection();

        $db->SetFetchMode("ADODB_FETCH_ASSOC");

        $sql = "SELECT * FROM usuarios";

        $res = $db->GetAll($sql);
        $response->getBody()->write(json_encode($res));
        return $response;
    });

    //endpoint obtener por id_promotor
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

    //endpoint guardar administradores
    $app->post('/guardarAdministrador', function (Request $request, Response $response) {
        $db = connection();

        $rec = $request->getQueryParams();

        $res = $db->AutoExecute("administradores", $rec, "INSERT");
        $db->Close();

        $response->getBody()->write(strval($res));
        return $response;
    });

    //endpoint actualizar administradores
    $app->put('/actualizarAdministrador', function (Request $request, Response $response) {
        $db = connection();

        $rec = $request->getQueryParams();
        $res = $db->AutoExecute("administradores", $rec, "UPDATE", "id_admin='$rec[id_admin]'");
        $db->Close();

        $response->getBody()->write(strval($res));
        return $response;
    });

    //endpoint eliminar administradores
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

    //endpoint obtener todos los administradores
    $app->get('/obtenerTodosAdmin', function (Request $request, Response $response) {
        $db = connection();

        //cambiar el metodo fetch
        $db->SetFetchMode("ADODB_FETCH_ASSOC");

        $sql = "SELECT * FROM administradores";

        $res = $db->GetAll($sql);
        $response->getBody()->write(json_encode($res));
        return $response;
    });

    //endpoint obtener por id_admin
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
