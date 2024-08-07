<?php
// Obtener nombre del archivo css de la página abierta
$url = basename($_SERVER["PHP_SELF"], ".php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El Profe Galleta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="./css/<?php echo $url ?>.css">
</head>

<!-- Encabezado  -->
<header>
    <nav class="navbar navbar-expand-lg navbar-transparent">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <img src="img/logogalleta.png" alt="Logo" width="65" height="30" class="d-inline-block align-text-top"> El Profe Galleta
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Página Principal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="porque_elegirnos">¿Por qué elegirnos?</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="oferta_academica">Oferta Academica</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="services">Servicios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact">Contacto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard">Shortcut admin dashboard</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Buscar">
                    <button class="btn btn-outline-primary btn_search" type="submit"><i class="fas fa-search"></i></button>
                </form>
                <div class="dropdown">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                        Dropdown form
                    </button>
                    <div class="dropdown-menu">
                        <form class="px-4 py-3">
                            <div class="mb-3">
                                <label for="exampleDropdownFormEmail1" class="form-label">Usuario</label>
                                <input type="email" class="form-control" id="exampleDropdownFormEmail1" placeholder="email@example.com">
                            </div>
                            <div class="mb-3">
                                <label for="exampleDropdownFormPassword1" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="exampleDropdownFormPassword1" placeholder="Password">
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="dropdownCheck">
                                    <label class="form-check-label" for="dropdownCheck">
                                        Remember me
                                    </label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Sign in</button>
                        </form>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="signup">Registrarse</a>
                        <a class="dropdown-item" href="recover_password">Olividó su contraseña?</a>
                    </div>


                </div>
            </div>
        </div>
    </nav>
</header>

<body>