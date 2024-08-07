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

    //endpoint obtener todas las inscripciones
    $app->get('/inscripciones', function (Request $request, Response $response) {
        $db = connection();
        checkDbConnection($db);
        $sql = 'SELECT * FROM inscripciones';
        $result = $db->Execute($sql);
        $inscripciones = $result->GetRows();
        $response->getBody()->write(json_encode($inscripciones));
        return $response->withHeader('Content-Type', 'application/json');
    });
};
