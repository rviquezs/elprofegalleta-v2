<?php
    include "../vendor/adodb/adodb-php/adodb.inc.php";

    function connection(){
        $conector=NewADOConnection('mysql');

        //credenciales
        $host="localhost";
        $user="root";
        $pass="";
        $bd="elprofegalleta";
        // $host = "sql5.freesqldatabase.com";
        // $user="sql5725390";
        // $pass="pTH9ITAl4p";
        // $bd="sql5725390";
        
        $conector->debug=true;

        $conector->Connect($host,$user,$pass,$bd);
        return $conector;
    }

?>