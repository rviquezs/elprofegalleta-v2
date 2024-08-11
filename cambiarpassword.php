<?php
//script para enviar el email que contiene el token y el reset link

$email = $_POST["email"];

//crear random token value.
$token = bin2hex(random_bytes(16));

$token_hash = hash("sha256", $token);

//tiempo de validez para el reset token
$expiry = date ("Y-m-d H:i:s", time() + 60 * 30);

$mysqli = require __DIR__ . "../public/conexion.php";

$sql = "UPDATE user
        SET reset_token_hash = ?,
            reset_token_expires_at = ?
        WHERE email = ?";

$stmt = $mysqli->prepare($sql);

$stmt->bind_param("sss", $token_hash, $expiry, $email);

$stmt->execute();

if($mysqli->affected_rows){
    $mail = require __DIR__ . "/mailer.php";

    $mail->setFrom("noreply@example.com");
    $mail->addAddress($email);
    $mail->Subject = "password reset";
    $mail->Body = <<<END

    Click <a href="http://example.com/reset_password.php?$token">here</a>
    to reset your password.

    END;

    try{
        $email->send();

    } catch(Exception $e){
        echo "message could not be sent. Mailer error: {$mail->ErrorInfo}";

    }

    

}

echo "message sent, check your inbox";