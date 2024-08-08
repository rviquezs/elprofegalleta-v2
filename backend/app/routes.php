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
};