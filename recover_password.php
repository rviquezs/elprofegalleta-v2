<!-- pagina para introducir email para reset -->
<?php include "shared/header.php" ?>

<main>

    <body>
        <div class="container">
            <h1 class="title"> Recuperar contraseña</h1>

            <form method="POST" action="cambiarpassword.php">
                <label for="email">email</label>
                <input type="email" name="email" id="email">

                <button class="btn btn-primary">Enviar</button>

            </form>

        </div>
    </body>
</main>

<?php include "shared/footer.php" ?>