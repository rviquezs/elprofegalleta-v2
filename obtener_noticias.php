<?php
header('Content-Type: application/json');
include_once 'connection.php';

$query = "SELECT * FROM noticias ORDER BY fecha DESC LIMIT 5"; //TENTATIVO, FALTA TABLA BASE DE DATOS
$result = mysqli_query($conn, $query);

$noticias = [];

while ($row = mysqli_fetch_assoc($result)) {
    $noticias[] = $row;
}

echo json_encode($noticias);
?>
