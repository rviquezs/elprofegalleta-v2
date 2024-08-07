<?php include "shared/header.php" ?>

<main>

    <body>
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2 class="title">Registrarse</h2>
                    <form class="signup-form">
                        <div class="user-details">
                            <div class="mb-3">
                                <label for="username" class="form-label">Usuario</label>
                                <input type="text" id="username" class="form-control" placeholder="Nombre de Usuario" required>
                            </div>
                            <div class="mb-3">
                                <label for="uniqueKey" class="form-label">Cédula</label>
                                <input type="text" id="uniqueKey" class="form-control" placeholder="0-0000-0000" required>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre</label>
                                <input type="text" id="name" class="form-control" placeholder="Nombre" required>
                            </div>
                            <div class="mb-3">
                                <label for="last_name_1" class="form-label">Primer Apellido</label>
                                <input type="text" id="last_name_1" class="form-control" placeholder="Primer Apellido" required>
                            </div>
                            <div class="mb-3">
                                <label for="last_name_2" class="form-label">Segundo Apellido</label>
                                <input type="text" id="last_name_2" class="form-control" placeholder="Segundo Apellido" required>
                            </div>
                            <div class="mb-3">
                                <label for="birth_date" class="form-label">Fecha de Nacimiento</label>
                                <input type="text" id="birth_date" class="form-control" placeholder="16/05/1999" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone_number" class="form-label">Teléfono</label>
                                <input type="text" id="phone_number" class="form-control" placeholder="8888-8888" required>
                            </div>
                            <div class="mb-3">
                                <label for="whatsapp" class="form-label">WhatsApp</label>
                                <input type="text" id="whatsapp" class="form-control" placeholder="8888-8888" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" id="password" class="form-control" placeholder="********" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo electrónico</label>
                                <input type="email" id="email" class="form-control" placeholder="Ejemplo@gmail.com" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Confirmar contraseña</label>
                                <input type="password" id="confirm_password" class="form-control" placeholder="********" required>
                            </div>
                        </div>
                    </form>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Registrarse</button>
                    </div>
                    <div class="text-center mt-3">
                        <p>¿Ya tienes una cuenta? <a href="login" class="btn btn-outline-primary">Iniciar Sesión</a></p>
                    </div>
                </div>
            </div>
        </div>
    </body>
    
</main>

<?php include "shared/footer.php" ?>
