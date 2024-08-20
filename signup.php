<?php include "shared/header.php" ?>

<body>
    <div class="container signup-container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1 class="text-center my-4">Formulario de Registro</h1>
                <form id="signupForm" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="cedula" class="form-label">Cédula:</label>
                                <input type="text" class="form-control" id="cedula" name="cedula" required>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre:</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="last_name1" class="form-label">Primer Apellido:</label>
                                <input type="text" class="form-control" id="last_name1" name="last_name1" required>
                            </div>
                            <div class="mb-3">
                                <label for="last_name2" class="form-label">Segundo Apellido:</label>
                                <input type="text" class="form-control" id="last_name2" name="last_name2">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo Electrónico:</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone_number" class="form-label">Teléfono:</label>
                                <input type="tel" class="form-control" id="phone_number" name="phone_number">
                            </div>
                            <div class="mb-3">
                                <label for="whatsapp" class="form-label">Número de WhatsApp:</label>
                                <input type="tel" class="form-control" id="whatsapp" name="whatsapp">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="picture" class="form-label">Fotografía:</label>
                            <input type="file" class="form-control" id="picture" name="fotografia" accept="image/*">
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