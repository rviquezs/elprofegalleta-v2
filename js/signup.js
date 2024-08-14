//evento click
$("#btnregistrar").click(function (e) {
    //serializar parametros
    const datos = $("#frmRegistro").serialize();
    peticionGuardar(datos);


});

function peticionGuardar(datos) {
    const url = `http://localhost:8080/crearUsuario?${datos}`
    $.ajax({
        type: "POST",
        url: url,
        dataType: "JSON",
        success: function (res) {
            alert("datos guardados");
        }
    });
}

$('#cedula').keydown(function (event) {
    if (event.key === 'Enter') {
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
                        var fullname = result.firstname1 + ' ' + result.lastname1 + ' ' + (result.lastname2 || '');

                        // Update the nombre field with the full name
                        $('#nombre').val(fullname);
                    } else {
                        // Clear the nombre field if no results are found
                        $('#nombre').val('');
                    }
                },
                error: function (xhr, status, error) {
                    console.error('API request failed:', status, error);
                    // Optionally, clear the nombre field on error
                    $('#nombre').val('');
                }
            });
        } else {
            // Clear the nombre field if the input is empty
            $('#nombre').val('');
        }
    }
});

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
