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
require '../vendor/autoload.php';

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

    // ENDPOINTS INSCRIPCIONES

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

    // ENDPOINTS CURSOS

    // Guardar Curso
    $app->post('/guardarCurso', function (Request $request, Response $response) {
        // Get form data
        $data = $request->getParsedBody();
        $uploadedFiles = $request->getUploadedFiles();

        // Extract file data
        $img2 = $uploadedFiles['additionalImage1'] ?? null; // Ensure the key matches with the AJAX request
        $img3 = $uploadedFiles['additionalImage2'] ?? null; // Ensure the key matches with the AJAX request

        // Initialize Base64 strings
        $img2Base64 = '';
        $img3Base64 = '';

        // Handle image files and convert to Base64
        if ($img2 && $img2->getError() === UPLOAD_ERR_OK) {
            $img2Content = file_get_contents($img2->getStream()->getMetadata('uri'));
            $img2Base64 = base64_encode($img2Content);
        }

        if ($img3 && $img3->getError() === UPLOAD_ERR_OK) {
            $img3Content = file_get_contents($img3->getStream()->getMetadata('uri'));
            $img3Base64 = base64_encode($img3Content);
        }

        // Process other form data
        $mainImageUrl = $data['mainImageUrl'];
        $courseName = $data['courseName'];
        $duration = $data['duration'];
        $mode = $data['mode'];
        $description = $data['description'];
        $category = $data['category'];
        $price = $data['price'];
        $promoterId = $data['promoterName']; // Make sure this matches the form field name

        // Save to the database
        $db = connection(); // Make sure connection() is defined and returns a PDO instance
        $sql = "INSERT INTO cursos (name, duration, modalidad, category, price, promoter, img1, img2, img3) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $params = [
            $courseName,
            $duration,
            $mode,
            $category,
            $price,
            $promoterId,
            $mainImageUrl,
            $img2Base64,
            $img3Base64
        ];
        $db->Execute($sql, $params);

        // Return a success response
        $response->getBody()->write(json_encode(['status' => 'success']));
        return $response->withHeader('Content-Type', 'application/json');
    });


    function moveUploadedFile($uploadedFile)
    {
        $directory = __DIR__ . '/uploads'; // Ensure this directory exists and is writable
        $filename = sprintf('%s-%s', uniqid(), $uploadedFile->getClientFilename());
        $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);
        return $filename;
    }

    // Actualizar cursos
    $app->put('/actualizarCurso/{id}', function (Request $request, Response $response) {
        $db = connection();

        $rec = $request->getQueryParams();
        $res = $db->AutoExecute("cursos", $rec, "UPDATE", "id_curso='$rec[id_curso]'");
        $db->Close();

        $response->getBody()->write(strval($res));
        return $response;
    });

    // Eliminar curso
    $app->delete('/eliminarCurso/{id}', function (Request $request, Response $response, array $args) {
        $id = $args["id"];
        $db = connection();

        $sql = "DELETE FROM cursos WHERE id=$id";

        if ($db->Execute($sql)) {
            $res = 1;
        } else {
            $res = 0;
        }

        $response->getBody()->write(strval($res));
        return $response;
    });

    // Obtener todos los cursos 
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

    // Obtener ultimos 10 cursos
    $app->get('/obtenerUltimosCursos', function (Request $request, Response $response) {
        $db = connection();
        $db->SetFetchMode("ADODB_FETCH_ASSOC");

        $sql = "SELECT cursos.id, cursos.name, cursos.duration, cursos.modalidad, cursos.category, cursos.price, 
                    promotores.name AS promotor, cursos.img1, COUNT(inscripciones.user_id) AS inscription_count FROM cursos 
                    JOIN promotores ON cursos.promoter = promotores.id 
                    LEFT JOIN inscripciones ON cursos.id = inscripciones.course_id
                    GROUP BY cursos.id, promotores.name
                    LIMIT 10;";

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


    // ENDPOINTS PROMOTORES

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

    // ENDPOINTS USUARIOS

    // Login
    $app->post('/login', function (Request $request, Response $response) {
        $data = $request->getParsedBody();
        $cedula = $data['username'];  // Use 'cedula' in the query
        $password = $data['password'];

        $db = connection();
        $db->SetFetchMode("ADODB_FETCH_ASSOC");

        // Query to get the user by cedula
        $sql = "SELECT * FROM usuarios WHERE cedula = ?";
        $user = $db->GetRow($sql, [$cedula]);

        if ($user && $password === $user['password']) {
            // Password matches, login successful
            $response->getBody()->write(json_encode([
                'success' => true,
                'message' => 'Login successful',
                'user' => $user
            ]));
        } else {
            // Invalid credentials
            $response->getBody()->write(json_encode([
                'success' => false,
                'message' => 'Invalid username or password'
            ]));
        }

        return $response->withHeader('Content-Type', 'application/json');
    });



    // Guardar usuario
    $app->post('/guardarUsuario', function (Request $request, Response $response) {
        $db = connection();

        $params = $request->getParsedBody();

        // Decode Base64 image data
        if (isset($params['fotografia_base64'])) {
            $base64Image = $params['fotografia_base64'];
            if (!empty($base64Image)) {
                $params['fotografia'] = $base64Image;
            } else {
                $params['fotografia'] = '';
            }
            unset($params['fotografia_base64']);
        } else {
            $params['fotografia'] = ''; // No image
        }

        // Insert the user data into the database
        try {
            // Ensure that `name`, `last_name1`, and `last_name2` are present in $params
            $result = $db->AutoExecute("usuarios", $params, "INSERT");
            if ($result) {
                $response->getBody()->write("Usuario registrado exitosamente");
            }
        } catch (Exception $e) {
            $response->getBody()->write("Error: " . $e->getMessage());
        }

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

    // eliminar usuarios
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

    // ENDPOINTS ADMINISTRADORES

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

    //Enviar correo de recuperación
    $app->post('/send-temp-password', function (Request $request, Response $response) {
        // Get form data
        $data = $request->getParsedBody();
        $db = connection();
        $imagePath = __DIR__ . '/img/email_sig.png';
        $email = $data['email'];

        // Generate a random temporary password
        $tempPassword = bin2hex(random_bytes(4)); // 8-character password
        $hashedPassword = password_hash($tempPassword, PASSWORD_DEFAULT);
        $rec = [
            'password' => $hashedPassword
        ];

        try {
            $res = $db->AutoExecute('usuarios', $rec, 'UPDATE', "email = '$email'");
            $db->Close();

            // If the insert successful, send the email
            if ($res) {
                $mail = new PHPMailer(true);

                try {
                    // Server settings
                    $mail->isSMTP();  // Set mailer to use SMTP
                    $mail->Host = 'smtp.gmail.com';  // Specify main SMTP server
                    $mail->SMTPAuth = true;  // Enable SMTP authentication
                    $mail->Username = 'profegalleta8@gmail.com';  // SMTP username (Gmail address)
                    $mail->Password = 'mjgo mfpo bxvu xmss';  // SMTP password (App password)
                    $mail->SMTPSecure = 'tls';  // Enable TLS encryption
                    $mail->Port = 587;  // TCP port to connect to              

                    // Recipients
                    $mail->setFrom('noreply@elprofegalleta.com', 'El Profe Galleta');
                    $mail->addAddress($email);

                    // Content
                    $mail->isHTML(true);
                    $mail->CharSet = 'UTF-8';
                    $mail->Subject = 'Contraseña Temporal';

                    $mail->Body =
                        "Hola,<br><br>
                        Su contraseña temporal es: <strong>$tempPassword</strong><br>
                        Por favor, utilice esta contraseña para iniciar sesión y cámbiela tan pronto como sea posible.<br><br>
                        --<br>
                        <img src='$imagePath' alt='Signature' style='max-width: 100%; height: auto;'>
                        ";

                    $mail->AltBody =
                        "Hola,\n\n
                        Su contraseña temporal es: $tempPassword\n
                        Por favor, utilice esta contraseña para iniciar sesión y cámbiela tan pronto como sea posible.\n\n
                        --\n";

                    // Send the email
                    if ($mail->send()) {
                        $response->getBody()->write(json_encode(['status' => 'success', 'message' => 'Temporary password sent to your email']));
                        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
                    } else {
                        $response->getBody()->write(json_encode(['status' => 'error', 'message' => 'Failed to send email']));
                        return $response->withHeader('Content-Type', 'application/json')->withStatus(500);
                    }
                } catch (Exception $e) {
                    $response->getBody()->write(json_encode(['status' => 'error', 'message' => "Mailer Error: {$mail->ErrorInfo}"]));
                    return $response->withHeader('Content-Type', 'application/json')->withStatus(500);
                }
            } else {
                $response->getBody()->write(json_encode(['status' => 'error', 'message' => 'Failed to update password in the database']));
                return $response->withHeader('Content-Type', 'application/json')->withStatus(500);
            }
        } catch (Exception $e) {
            $response->getBody()->write(json_encode(['status' => 'error', 'message' => "Database Error: {$e->getMessage()}"]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(500);
        }
    });



    //ENDPOINTS NOTICIAS

    // guardar noticias
    $app->post('/guardarNoticia', function (Request $request, Response $response) {
        $db = connection();

        $rec = $request->getQueryParams();

        $res = $db->AutoExecute("noticias", $rec, "INSERT");
        $db->Close();

        $response->getBody()->write(strval($res));
        return $response;
    });

    // actualizar noticias
    $app->put('/actualizarNoticia', function (Request $request, Response $response) {
        $db = connection();

        $rec = $request->getQueryParams();
        $res = $db->AutoExecute("noticias", $rec, "UPDATE", "id='$rec[id]'");
        $db->Close();

        $response->getBody()->write(strval($res));
        return $response;
    });

    // eliminar noticias
    $app->delete('/eliminarNoticia/{id}', function (Request $request, Response $response, array $args) {
        $id = $args["id"];
        $db = connection();

        $sql = "DELETE FROM noticias WHERE cedula='$id'";

        if ($db->Execute($sql)) {
            $res = 1;
        } else {
            $res = 0;
        }

        $response->getBody()->write(strval($res));
        return $response;
    });

    //obtener ultimas noticias
    $app->get('/obtenerUltimasNoticias', function (Request $request, Response $response) {
        $db = connection();
        $db->SetFetchMode("ADODB_FETCH_ASSOC");

        $sql = "SELECT id, titulo, descripcion, img, fecha 
                FROM noticias
                ORDER BY fecha DESC
                LIMIT 10;";

        $res = $db->GetAll($sql);
        $response->getBody()->write(json_encode($res));
        return $response;
    });
};
