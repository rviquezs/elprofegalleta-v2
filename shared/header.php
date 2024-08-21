<?php
session_start();

// Obtener nombre del archivo css de la página abierta
$url = basename($_SERVER["PHP_SELF"], ".php");
$isLoggedIn = isset($_SESSION['user_id']); // Adjust according to how you store login state
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El Profe Galleta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="css/<?php echo $url ?>.css">
</head>

<header>
    <nav class="navbar navbar-expand-lg navbar-transparent">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="img/logogalleta.png" alt="Logo" width="65" height="30" class="d-inline-block align-text-top"> El Profe Galleta
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Página Principal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="porque_elegirnos.php">¿Por qué elegirnos?</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="oferta_academica.php">Oferta Academica</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="services.php">Servicios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contacto</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">Shortcut admin dashboard</a>
                    </li> -->
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Buscar">
                    <button class="btn btn-outline-primary btn_search" type="submit"><i class="fas fa-search"></i></button>
                </form>
                <div class="dropdown">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                        <?php echo $isLoggedIn ? 'Profile' : 'Menu'; ?>
                    </button>
                    <div class="dropdown-menu">
                        <?php if ($isLoggedIn): ?>
                            <!-- Profile menu items -->
                            <a class="dropdown-item" href="profile.php">Perfil</a>
                            <a class="dropdown-item" href="settings.php">Ajustes</a>
                            <a class="dropdown-item" href="#" id="logout">Cerrar sesión</a>
                        <?php else: ?>
                            <a class="dropdown-item" href="login.php">Iniciar Sesión</a>
                            <a class="dropdown-item" href="signup.php">Registrarse</a>
                            <a class="dropdown-item" href="dashboard.php">Dashboard</a>
                            <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>


<body>