<?php include "shared/header.php" ?>
<!-- pagina para introducir la nueva contrasena -->

<main>

    <body>
        <div class="container">
            <h1 class="title"> Reiniciar contraseña</h1>

            <form id="reset-password-form">
                <input type="password" id="new-password" placeholder="New Password">
                <input type="password" id="confirm-password" placeholder="Confirm Password">
                <input type="hidden" id="token" value="your_token_here">
                <button type="submit">Reset Password</button>
            </form>
            <div id="response"></div>

        </div>
    </body>
</main>

<?php include "shared/footer.php" ?>