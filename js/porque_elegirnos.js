document.addEventListener('DOMContentLoaded', function() {
    // Solicitud AJAX para obtener los testimonios
    fetch('http://localhost:8080/obtenerUltimosTestimonios')
        .then(response => response.json())
        .then(data => {
            const testimoniosContainer = document.getElementById('testimonios-container');
            
            data.forEach(testimonio => {
                // Crear los elementos para la tarjeta
                const col = document.createElement('div');
                col.className = 'col-md-4 mb-4';

                const card = document.createElement('div');
                card.className = 'card h-100';

                const img = document.createElement('img');
                img.src = testimonio.imagen;
                img.alt = `Testimonio de ${testimonio.nombre}`;
                img.className = 'card-img-top img-fluid';

                const cardBody = document.createElement('div');
                cardBody.className = 'card-body';

                const cardTitle = document.createElement('h5');
                cardTitle.className = 'card-title';
                cardTitle.textContent = testimonio.nombre;

                const cardText = document.createElement('p');
                cardText.className = 'card-text';
                cardText.textContent = testimonio.comentario;

                // Agregar los elementos al DOM
                cardBody.appendChild(cardTitle);
                cardBody.appendChild(cardText);
                card.appendChild(img);
                card.appendChild(cardBody);
                col.appendChild(card);
                testimoniosContainer.appendChild(col);
            });
        })
        .catch(error => console.error('Error al cargar los testimonios:', error));
});
