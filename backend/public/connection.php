<?php

declare(strict_types=1);

include "../vendor/adodb/adodb-php/adodb.inc.php";

function connection() {
    $conector = NewADOConnection('mysql');
    $host = "localhost";
    $user = "root";
    $pass = "";
    $bd = "elprofegalleta";
    $conector->debug = true;
    if (!$conector->Connect($host, $user, $pass, $bd)) {
        throw new Exception("Error en la conexión a la base de datos");
    }
    return $conector;
}

function checkDbConnection($db)
{
    if (!$db) {
        throw new Exception('La conexión a la base de datos falló.');
    }
}

?>
