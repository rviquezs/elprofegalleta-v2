<?php
//script para procesar el reset de la contrasena
$token = $_GET["token"];

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

?>

<?php include "shared/header.php" ?>
<!-- pagina para introducir la nueva contrasena -->

<main>

    <body>
        <div class="container">
            <h1 class="title"> Reiniciar contraseña</h1>

            <form method="POST" action="process_reset_password.php">

                <input type="hidden" name="token" value="<?= htmlspecialchars($token)?>">

                <label for="password">Nueva contraseña</label>
                <input type="password" name="password" id="password">

                <label for="confirm_password">Repetir contraseña</label>
                <input type="confirm_password" name="confirm_password" id="confirm_password">

                <button class="btn btn-primary">Enviar</button>

            </form>

        </div>
    </body>
</main>

<?php include "shared/footer.php" ?>