<?php include_once __DIR__ . "/shared/header.php" ?>

<div class="header text-center">
    <h1>¿Por qué elegirnos?</h1>
    <p class="lead">Descubre las razones por las que somos la mejor opción.</p>
</div>

<section class="main-content container">
    <div class="row text-center">
        <!-- Tarjetas estáticas -->
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <img src="img/profesor.jpg" alt="Profesionales altamente capacitados" class="card-img-top img-fluid">
                <div class="card-body">
                    <h5 class="card-title">Profesionales altamente capacitados <i class="fas fa-graduation-cap"></i></h5>
                    <p class="card-text">Ofrecemos una educación de alta calidad, avalada por la vasta experiencia de nuestros profesores.</p>
                    <a href="services.php" class="btn btn-primary btn-block">Ver Más</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <img src="img/academico.jpg" alt="Oferta académica" class="card-img-top img-fluid">
                <div class="card-body">
                    <h5 class="card-title">Oferta académica <i class="fas fa-book"></i></h5>
                    <p class="card-text">El instituto ofrece una amplia gama de cursos demandados en la actualidad.</p>
                    <a href="services.php" class="btn btn-primary btn-block">Ver Más</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <img src="img/edificio.jpg" alt="Ubicación e instalaciones" class="card-img-top img-fluid">
                <div class="card-body">
                    <h5 class="card-title">Ubicación e instalaciones <i class="fas fa-map-marker-alt"></i></h5>
                    <p class="card-text">Nos comprometemos a brindar una excelente ubicación e instalaciones para mejorar la experiencia de estudio de los estudiantes.</p>
                    <a href="services.php" class="btn btn-primary btn-block">Ver Más</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Contenedor para testimonios -->
    <div class="row" id="testimonios-container">
        <!-- Las tarjetas de testimonios se cargarán aquí mediante AJAX -->
    </div>
</section>

<script src="scripts/porque_elegirnos.js"></script>

<?php include_once __DIR__ . "/shared/footer.php" ?>
