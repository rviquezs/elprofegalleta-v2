document.addEventListener('DOMContentLoaded', function() {
    const testimoniosContainer = document.getElementById('testimonios-container');
    const endpointUrl = 'http://localhost:8080/obtenerUltimosTestimonios';

    function fetchUltimosTestimonios() {
        console.log('Intentando cargar testimonios desde:', endpointUrl);

        fetch(endpointUrl)
            .then(response => {
                console.log('Estado de la respuesta:', response.status);
                if (!response.ok) {
                    throw new Error('Red no OK: ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                console.log('Datos recibidos:', data);
                renderTestimonios(data);
            })
            .catch(error => {
                console.error('Error al obtener los testimonios:', error);
            });
    }

    function renderTestimonios(testimonios) {
        console.log('Renderizando testimonios:', testimonios);
        testimoniosContainer.innerHTML = '';

        testimonios.forEach(testimonio => {
            const testimonioElement = document.createElement('div');
            testimonioElement.className = 'col-md-4 mb-4';
            testimonioElement.innerHTML = `
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">${testimonio.nombre}</h5>
                        <p class="card-text">${testimonio.testimonio}</p>
                    </div>
                </div>
            `;
            testimoniosContainer.appendChild(testimonioElement);
        });
    }

    fetchUltimosTestimonios();
});
