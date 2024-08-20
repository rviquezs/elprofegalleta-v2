<?php include "shared/header.php" ?>

<main>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="text-center mb-4">Iniciar Sesión</h2>
                <form class="row g-3">
                    <div class="col-md-6">
                        <label for="username" class="form-label">Usuario</label>
                        <input type="text" id="username" class="form-control" required>
                    </div>
                    <div class="col-md-6 position-relative">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" id="password" class="form-control" required>
                        <button id="togglePasswordLogin" type="button" class="btn btn-outline-secondary btn-sm position-absolute top-50 end-0 translate-middle-y me-2">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>

                    <div class="col-12 text-center">
                        <button id="btn_login" type="submit" class="btn btn-primary">Iniciar Sesión</button>
                    </div>
                </form>
                <div class="text-center mt-3">
                    <a href="recover_password.php">¿Olvidaste tu contraseña?</a>
                </div>
                <div class="text-center mt-3">
                    <p>¿No tienes una cuenta? <a href="signup.php" class="link-primary">Registrarse</a></p>
                </div>
            </div>
        </div>
    </div>
</main>


<?php include "shared/footer.php" ?>