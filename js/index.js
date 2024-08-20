document.addEventListener('DOMContentLoaded', function() {
    const noticiasContainer = document.getElementById('noticias-container');

    const endpointUrl = 'http://localhost:8080/obtenerUltimasNoticias';

    function fetchUltimasNoticias() {
        fetch(endpointUrl)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log('Data:', data);
                renderNoticias(data);
            })
            .catch(error => {
                console.error('Error al obtener las noticias:', error);
            });
    }

    function renderNoticias(noticias) {
        noticiasContainer.innerHTML = '';

        noticias.forEach(noticia => {
            const noticiaElement = document.createElement('div');
            noticiaElement.className = 'noticia-item';
            noticiaElement.innerHTML = `
                <div class="noticia-img">
                    <img src="${noticia.img}" alt="${noticia.titulo}">
                </div>
                <div class="noticia-content">
                    <h4>${noticia.titulo}</h4>
                    <p>${noticia.descripcion}</p>
                    <p><small>${noticia.fecha}</small></p>
                </div>
            `;
            noticiasContainer.appendChild(noticiaElement);
        });
    }

    fetchUltimasNoticias();
});

