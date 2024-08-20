$(document).ready(function() {
    $('#logout').click(function(e) {
        e.preventDefault();
        
        $.ajax({
            url: '/logout', // Adjust to your actual logout endpoint
            type: 'POST',
            success: function(response) {
                if (response.success) {
                    // Redirect to home or login page
                    window.location.href = 'index.php'; // or 'login.php'
                } else {
                    alert('Error al cerrar sesión. Inténtalo de nuevo.');
                }
            },
            error: function() {
                alert('Error al cerrar sesión. Inténtalo de nuevo.');
            }
        });
    });
});
