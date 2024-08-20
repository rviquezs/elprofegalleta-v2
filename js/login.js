$(document).ready(function () {

    $("#btn_login").on("click", function (event) {
        event.preventDefault();

        var username = $("#username").val();  // This username refers to 'cedula' in the database
        var password = $("#password").val();

        $.ajax({
            url: "http://localhost:8080/login",
            type: "POST",
            data: { username: username, password: password },  // username is still used as the key
            success: function (response) {
                if (response.success) {
                    // Redirect to a dashboard or homepage
                    window.location.href = 'index.php';
                } else {
                    alert(response.message);
                }
            },
            error: function (xhr, status, error) {
                alert("An error occurred. Please try again.");
            }
        });
    });

});

$("#togglePasswordLogin").on("click", function () {
    var passwordField = $("#password");
    var passwordFieldType = passwordField.attr("type");

    if (passwordFieldType === "password") {
        passwordField.attr("type", "text");
        $(this).find("i").removeClass("bi-eye").addClass("bi-eye-slash");
    } else {
        passwordField.attr("type", "password");
        $(this).find("i").removeClass("bi-eye-slash").addClass("bi-eye");
    }
});
