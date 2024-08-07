<?php include "shared/header.php" ?>

<main>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center mb-4">Iniciar Sesión</h2>
                <form class="login-form">
                    <div class="mb-3">
                        <label for="username" class="form-label">Usuario</label>
                        <input type="text" id="username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" id="password" class="form-control" required>
                        <button id="showPassword" onclick="showPassword()" class="btn btn-primary me-md-2" type="button">Ver Contraseña</button>
                    </div>
                    <div class="text-center">
                        <button id="btn_login" type="submit" class="btn btn-primary">Iniciar Sesión</button>
                    </div>
                </form>
                <div class="text-center mt-3">
                    <a href="recover_password">¿Olvidaste tu contraseña?</a>
                </div>
                <div class="text-center mt-3">
                    <p>¿No tienes una cuenta? <a href="signup" class="btn btn-outline-primary">Registrarse</a></p>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include "shared/footer.php" ?>