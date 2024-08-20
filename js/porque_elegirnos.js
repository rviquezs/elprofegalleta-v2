document.addEventListener('DOMContentLoaded', function() {
    const testimoniosContainer = document.getElementById('testimonios-container');
    const endpointUrl = 'http://localhost:8080/obtenerUltimosTestimonios';

    function fetchUltimosTestimonios() {
        fetch(endpointUrl)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log('Data:', data);
                renderTestimonios(data);
            })
            .catch(error => {
                console.error('Error al obtener los testimonios:', error);
            });
    }

    function renderTestimonios(testimonios) {
        testimoniosContainer.innerHTML = '';
    
        if (testimonios.length === 0) {
            testimoniosContainer.innerHTML = '<p>No hay testimonios disponibles.</p>';
        } else {
            testimonios.forEach(testimonio => {
                const testimonioElement = document.createElement('div');
                testimonioElement.className = 'testimonio-item';
                testimonioElement.innerHTML = `
                    <div class="testimonio-content">
                        <h4>${testimonio.nombre_curso || 'Curso Desconocido'}</h4>
                        <p>${testimonio.comment || 'No hay comentario disponible'}</p>
                        <p><small>${testimonio.fecha || 'Fecha desconocida'}</small></p>
                    </div>
                `;
                testimoniosContainer.appendChild(testimonioElement);
            });
        }
    }
    

    fetchUltimosTestimonios();
});


