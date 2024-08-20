$(document).ready(function () {

    $("#btn_login").on("click", function (event) {
        event.preventDefault();

        var username = $("#username").val(); 
        var password = $("#password").val();

        $.ajax({
            url: "http://localhost:8080/login", // Ensure this URL matches your back-end endpoint
            type: "POST",
            data: { username: username, password: password }, 
            success: function (response) {
                if (response.success) {
                    window.location.href = 'index.php'; // Redirect to a dashboard or homepage
                } else {
                    alert(response.message);
                }
            },
            error: function (xhr, status, error) {
                alert("An error occurred. Please try again.");
            }
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

});
