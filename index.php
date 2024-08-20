<!-- Encabezado -->
<?php include_once __DIR__ . "/shared/header.php" ?>

<!-- Pagina principal -->

<!-- Carousel -->
<div id="index-carousel" class="carousel slide" data-bs-ride="true">
    <div id="carouselIndicators" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active"  data-bs-interval="6000">
                <img src="img/banner.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item"  data-bs-interval="6000">
                <img src="img/bannerelprofegalleta.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item"  data-bs-interval="6000">
                <img src="img/bannerinscribete.png" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<div class="container-fluid">
    <h2>Sobre Nosotros</h2>
    <div class="accordion accordion-flush" id="accordionFlush">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    <h3>Nuestra Historia</h3>
                </button>
            </h2>
            <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlush">
                <div class="accordion-body">Fundado en 2020, El Profe Galleta comenzó con la visión de ser líder en la enseñanza de
                    idiomas, proporcionando a nuestros estudiantes las herramientas lingüísticas necesarias para comunicarse
                    efectivamente en un mundo globalizado.</div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                    <h3>Nuestra Misión y Visión</h3>
                </button>
            </h2>
            <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlush">
                <div class="accordion-body">
                    <p><strong>Misión:</strong> Proporcionar a nuestros estudiantes una educación lingüística de calidad que no solo
                        les permita adquirir fluidez en idiomas extranjeros, sino también desarrollar habilidades interculturales y globales que los preparen
                        para tener éxito.</p>
                    <p><strong>Visión:</strong> Ser líder en la enseñanza de idiomas, innovando constantemente para ofrecer programas educativos de
                        calidad.
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <h2>Descubre la Últimas Noticias</h2>
    <div id="noticias-container" class="noticias-container">
        <!-- Las noticias se cargarán aquí mediante JavaScript -->
    </div>
</div>


<?php include __DIR__ . "/oferta_academica.php" ?>
<script src="index.js"></script>
