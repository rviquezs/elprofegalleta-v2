document.addEventListener("DOMContentLoaded", function() {
    fetch('http://localhost:8080/obtenerUltimosTestimonios')
        .then(response => response.json())
        .then(data => {
            const container = document.getElementById('testimonios-container');
            container.innerHTML = '';

            if (data.error) {
                container.innerHTML = `<p>Error al cargar los testimonios: ${data.error}</p>`;
                return;
            }

            data.forEach(testimonio => {
                const card = document.createElement('div');
                card.className = 'col-md-4 mb-4';

                card.innerHTML = `
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">${testimonio.nombre_curso}</h5>
                            <p class="card-text">${testimonio.comment}</p>
                            <small class="text-muted">Fecha: ${new Date(testimonio.fecha).toLocaleDateString()}</small>
                        </div>
                    </div>
                `;

                container.appendChild(card);
            });
        })
        .catch(error => {
            console.error('Error fetching testimonios:', error);
            const container = document.getElementById('testimonios-container');
            container.innerHTML = `<p>Error al cargar los testimonios. Por favor, inténtelo de nuevo más tarde.</p>`;
        });
});


