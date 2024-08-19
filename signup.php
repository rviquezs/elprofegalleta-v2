<?php include "shared/header.php" ?>

<body>
    <div class="container signup-container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1 class="text-center my-4">Formulario de Registro</h1>
                <form action="/submit" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="cedula" class="form-label">Cédula:</label>
                                <input type="text" class="form-control" id="cedula" name="cedula" required>
                            </div>
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre:</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>
                            <div class="mb-3">
                                <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento:</label>
                                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                                <!-- Añadir boton de toggle password visibility -->
                                <!-- <button id="togglePasswordSignup" type="button" class="btn btn-outline-secondary btn-sm position-absolute top-50 end-0 translate-middle-y me-2">
                                    <i class="bi bi-eye"></i>
                                </button> -->
                                <div class="mb-3">
                                    <label for="telefono" class="form-label">Teléfono:</label>
                                    <input type="tel" class="form-control" id="telefono" name="telefono">
                                </div>
                                <div class="mb-3">
                                    <label for="whatsapp" class="form-label">Número de WhatsApp:</label>
                                    <input type="tel" class="form-control" id="whatsapp" name="whatsapp">
                                </div>

                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="fotografia" class="form-label">Fotografía:</label>
                            <input type="file" class="form-control" id="fotografia" name="fotografia" accept="image/*">
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">Registrarse</button>
                        </div>
                        <div class="text-center mt-3">
                            <a href="login.php" class="link-primary">¿Ya tienes una cuenta? Inicia sesión</a>
                        </div>
                </form>
            </div>
        </div>
    </div>

    <?php include "shared/footer.php" ?>