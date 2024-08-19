
const resetPasswordForm = document.getElementById('frmResetPassword');
const responseDiv = document.getElementById('response');

resetPasswordForm.addEventListener('submit', (event) => {
    event.preventDefault();

    const email = document.getElementById('email').value;

    $.ajax({
        type: "POST",
        url: "http://localhost:8080/reset-password-email-process", //llamar al endpoint
        data: $(this).serialize(),
        success: function (response) {
            alert("Correo con contraseña temporal enviado.")
        }
    });
});

