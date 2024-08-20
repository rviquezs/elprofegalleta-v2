
$(document).ready(function () {
    $("#frmResetPassword").on("submit", function (event) {
        event.preventDefault();

        var email = $("#email").val();

        $.ajax({
            url: "http://localhost:8080/send-temp-password",
            type: "POST",
            data: { email: email },
            success: function (response) {
                Swal.fire({
                    title: "Correo enviado",
                    text: "Correo enviado con éxito. Por favor, revisa tu bandeja de entrada.",
                    icon: "success",
                    timer: 4000,
                    showConfirmButton: false,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                // Redirect to login.php 
                setTimeout(function () {
                    window.location.href = 'login.php';
                }, 2000); 
            },
            error: function (xhr, status, error) {
                Swal.fire({
                    title: "Error",
                    text: "Hubo un error al enviar el correo. Por favor, inténtalo de nuevo.",
                    icon: "error",
                    timer: 4000,
                    showConfirmButton: false,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            }
        });
    });
});
