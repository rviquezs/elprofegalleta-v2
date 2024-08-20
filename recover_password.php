<?php include "shared/header.php" ?>

<main class="d-flex align-items-center justify-content-center vh-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <h1 class="text-center mb-4">Recuperar Contraseña</h1>

                <form id="frmResetPassword">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" class="form-control" placeholder="youremail@example.com" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Enviar correo de recuperación</button>
                </form>

                <div id="response" class="mt-3"></div>
            </div>
        </div>
    </div>
</main>

<?php include "shared/footer.php" ?>