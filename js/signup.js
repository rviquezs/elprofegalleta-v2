$(document).ready(function () {

    $('#signupForm').submit(function (e) {
        e.preventDefault();

        var formData = new FormData(this);
        var reader = new FileReader();

        reader.onload = function (e) {
            var base64Image = e.target.result; // Base64 encoded string
            formData.append('picture_base64', base64Image);
            formData.delete('picture');

            // Send the data via AJAX
            $.ajax({
                url: 'http://localhost:8080/guardarUsuario',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    // Use the showAlert function for success
                    showAlert("Registro Exitoso", "Usuario registrado exitosamente", "success");

                    setTimeout(() => {
                        // Clear all input fields after successful registration
                        $('#signupForm').trigger("reset");
                        // Redirect to login page after the timer ends
                        window.location.href = 'login.php';
                    }, 4000); // Matches the SweetAlert timer duration
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    // Use the showAlert function for error
                    showAlert("Error", "Error al registrar el usuario: " + textStatus, "error");
                }
            });

        };

        if ($('#picture')[0].files[0]) {
            reader.readAsDataURL($('#picture')[0].files[0]);
        } else {
            // If no file is selected, send empty Base64 string
            formData.append('picture_base64', '');
            $.ajax({
                url: 'http://localhost:8080/guardarUsuario',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    // Use the showAlert function for success
                    showAlert("Registro Exitoso", "Usuario registrado exitosamente", "success");

                    setTimeout(() => {
                        // Clear all input fields after successful registration
                        $('#signupForm').trigger("reset");
                        // Redirect to login page after the timer ends
                        window.location.href = 'login.php';
                    }, 4000); // Matches the SweetAlert timer duration
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    // Use the showAlert function for error
                    showAlert("Error", "Error al registrar el usuario: " + textStatus, "error");
                }
            });
        }
    });

});

$('#cedula').keydown(function (event) {
    if (event.key === 'Enter' || event.key === 'Tab') {
        event.preventDefault(); // Prevent the default form submission
        var cedulaValue = $(this).val();

        if (cedulaValue.trim() !== '') {
            var apiUrl = 'https://apis.gometa.org/cedulas/' + encodeURIComponent(cedulaValue);

            $.ajax({
                url: apiUrl,
                method: 'GET',
                dataType: 'json',
                success: function (response) {
                    // Check if results are available
                    if (response.resultcount > 0 && response.results.length > 0) {
                        var result = response.results[0];
                        var nombre = capitalizeFirstLetter(result.firstname1);
                        var primerApellido = capitalizeFirstLetter(result.lastname1);
                        var segundoApellido = capitalizeFirstLetter(result.lastname2 || '');

                        // Update the fields with the API results
                        $('#name').val(nombre);
                        $('#last_name1').val(primerApellido);
                        $('#last_name2').val(segundoApellido);
                    } else {
                        // Clear the fields if no results are found
                        $('#name').val('');
                        $('#last_name1').val('');
                        $('#last_name2').val('');
                        $('#email').val('');
                    }
                },
                error: function (xhr, status, error) {
                    console.error('API request failed:', status, error);
                    // Optionally, clear the fields on error
                    $('#name').val('');
                    $('#last_name1').val('');
                    $('#last_name2').val('');
                }
            });
        } else {
            // Clear the fields if the input is empty
            $('#name').val('');
            $('#last_name1').val('');
            $('#last_name2').val('');
        }
    }
});

// Function to capitalize the first letter of a string
function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1).toLowerCase();
}

function showAlert(title, text, icon, timer = 4000) {
    Swal.fire({
        title: title,
        text: text,
        icon: icon,
        timer: timer,
        showConfirmButton: false,
        timerProgressBar: true,
        didOpen: () => {
            Swal.showLoading();
        }
    });
}

$('#togglePasswordSignup').click(function () {
    var passwordField = $('#password');
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