
const resetPasswordForm = document.getElementById('reset-password-form');
const responseDiv = document.getElementById('response');

resetPasswordForm.addEventListener('submit', (event) => {
    event.preventDefault();

    const newPassword = document.getElementById('new-password').value;
    const confirmPassword = document.getElementById('confirm-password').value;
    const token = document.getElementById('token').value;

    if (newPassword !== confirmPassword) {
        responseDiv.innerHTML = 'Passwords do not match.';
        return;
    }

    const formData = new FormData();
    formData.append('new_password', newPassword);
    formData.append('token', token);

    $.ajax({
        type: "POST",
        url: "http://localhost:8080/reset-password-email-send", //llamar al endpoint
        data: $(this).serialize(),
        success: function (response) {
            alert("Correo con contraseña temporal enviado.")
        }
    });
});  