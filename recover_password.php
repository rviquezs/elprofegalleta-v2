<!-- pagina para introducir email para reset -->
<?php include "shared/header.php" ?>

<main>

    <body>
        <div class="container">
            <h1 class="title"> Recuperar contraseña</h1>

            <form id="frmResetPassword">
                <input type="email" id="email" placeholder="Your email">
                <button type="submit">Send Reset Link</button>
            </form>
            <div id="response"></div>

        </div>
    </body>
</main>

<?php include "shared/footer.php" ?>