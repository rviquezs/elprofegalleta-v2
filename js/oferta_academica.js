function loadPrograms() {
    $.ajax({
        url: 'http://localhost:8080/obtenerTodosCursos',
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            if (Array.isArray(data)) {
                let cards = '';
                data.forEach(program => {
                    cards += `
                        <div class="program-card">
                            ${program.img1}
                            <h3>${program.name}</h3>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="detalles_curso.php?${program.id}">
                                    <button class="btn btn-primary me-md-2" type="button">Ver más</button>
                                </a>
                            </div>
                        </div>
                    `;
                });
                $('#programsContainer').html(cards);
            } else {
                console.error('Expected an array but received:', data);
                $('#programsContainer').html('<div class="alert alert-danger">Failed to load programs. Please try again later.</div>');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error loading programs data:', error);
            $('#programsContainer').html('<div class="alert alert-danger">Error loading programs data. Please try again later.</div>');
        }
    });
}

// Call the function on page load
$(document).ready(function() {
    loadPrograms();
});
