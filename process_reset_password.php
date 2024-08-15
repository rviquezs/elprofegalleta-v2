<!-- script para procesar el form en el reset password.php -->

<?php
//script para procesar el reset de la contrasena
$token = $_POST["token"];

//obtener el has del password que se guardo
$token_hash = hash("sha256", $token);

//conexion a la base de datos
$mysqli = require __DIR__ . "./backend/public/connection.php";

//seleccionar el valor especifico en la database que tenga el token hash
$sql = "SELECT * FROM user
        WHERE reset_token_hash = ?";


$stmt = $mysqli->prepare($sql);

$stmt->bind_param("s", $token_hash);

$stmt->execute();

$result = $stmt->get_result();

$user = $result->fetch_assoc();

if($user=== null){
    die("token no encontrado");

}

//ver si el token todavia no ha vencido por el tiempo
if(strtotime($user["reset_token_expires_at"]) <= time() ){

}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$sql = "UPDATE user
        SET password_hash = ?,
            reset_token_hash = NULL,
            reset_token_expires_at = NULL
        WHERE cedula = ?";

$stmt = $mysqli->prepare($sql);

$stmt->bind_param("ss", $password_hash, $user["cedula"]);

$stmt->execture();

echo "Contraseña actualizada. Puedes volver a entrar con la nueva contraseña"; 