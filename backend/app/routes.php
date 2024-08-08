<?php

declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

include_once __DIR__ . '/../public/connection.php';


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
$app->delete('/eliminarInscripciones/{usuario}', function (
    Request $request,
    Response $response,
    array $args
) {
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
$app->get('/obtenerInscripciones/{usuario}', function (
    Request $request,
    Response $response,
    array $args
) {
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
$app->delete('/eliminarCurso/{id_curso}', function (
    Request $request,
    Response $response,
    array $args
) {
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
$app->get('/obtenerCurso/{id_curso}', function (
    Request $request,
    Response $response,
    array $args
) {
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
$app->delete('/eliminarPromotor/{id_promotor}', function (
    Request $request,
    Response $response,
    array $args
) {
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
$app->get('/obtenerPromotor/{id_promotor}', function (
    Request $request,
    Response $response,
    array $args
) {
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
$app->delete('/eliminarUsuario/{cedula}', function (
    Request $request,
    Response $response,
    array $args
) {
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
$app->get('/obtenerUsuario/{cedula}', function (
    Request $request,
    Response $response,
    array $args
) {
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
$app->delete('/eliminarAdministrador/{id_admin}', function (
    Request $request,
    Response $response,
    array $args
) {
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
$app->get('/obtenerAdmin/{id_admin}', function (
    Request $request,
    Response $response,
    array $args
) {
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
};