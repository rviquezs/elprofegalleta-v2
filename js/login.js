// Toggle password visibility for Login form
$('#togglePasswordLogin').click(function () {
    var passwordField = $('#passwordLogin');
    var passwordFieldType = passwordField.attr('type');
    var icon = $(this).find('i');
    if (passwordFieldType === 'password') {
        passwordField.attr('type', 'text');
        icon.removeClass('bi-eye').addClass('bi-eye-slash');
    } else {
        passwordField.attr('type', 'password');
        icon.removeClass('bi-eye-slash').addClass('bi-eye');
    }
});