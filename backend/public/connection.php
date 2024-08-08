<?php
    include "../vendor/adodb/adodb-php/adodb.inc.php";

    function connection(){
        $conector=NewADOConnection('mysql');

        //credenciales
        $host="localhost";
        $user="root";
        $pass="";
        $bd="elprofegalleta";

        $conector->debug=true;

        $conector->Connect($host,$user,$pass,$bd);
        return $conector;
    }

?>