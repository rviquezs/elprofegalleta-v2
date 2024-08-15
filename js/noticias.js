// Call the function on page load
$(document).ready(function() {
    loadNews();
});

function loadNews() {
    $.ajax({
        url: 'http://localhost:8080/obtenerNoticias', 
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            if (Array.isArray(data)) {
                let cards = '';
                data.forEach(news => {
                    cards += `
                        <div class="news-card">
                            <img width="96" height="96" src="${news.img}" alt="${news.title}"/>
                            <h3>${news.title}</h3>
                            <p>${news.description}</p>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="detalles_noticia.php?${news.id}">
                                    <button class="btn btn-primary me-md-2" type="button">Leer más</button>
                                </a>
                            </div>
                        </div>
                    `;
                });
                $('#newsContainer').html(cards);
            } else {
                console.error('Expected an array but received:', data);
                $('#newsContainer').html('<div class="alert alert-danger">Failed to load news. Please try again later.</div>');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error loading news data:', error);
            $('#newsContainer').html('<div class="alert alert-danger">Error loading news data. Please try again later.</div>');
        }
    });
}
