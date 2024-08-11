<!-- Header -->
<?php include_once __DIR__ . "/shared/header.php" ?>

<body>
    <div class="container mt-5">
        <div class="row">
            <!-- Información de Contacto -->
            <div class="col-lg-6 mb-4">
                <div class="contact-item d-flex align-items-center mb-4 p-3 bg-light rounded shadow-sm">
                    <i class="fas fa-envelope contact-icon me-3"></i>
                    <div class="contact-details">
                        <h4 class="mb-1">Correo Electrónico</h4>
                        <p class="mb-0"><a href="mailto:elprofegalleta@elprofegalleta.com">elprofegalleta@elprofegalleta.com</a></p>
                    </div>
                </div>
                <div class="contact-item d-flex align-items-center mb-4 p-3 bg-light rounded shadow-sm">
                    <i class="fas fa-phone contact-icon me-3"></i>
                    <div class="contact-details">
                        <h4 class="mb-1">Teléfono</h4>
                        <p class="mb-0"><a href="tel:+50645678901">+506 4567 8901</a></p>
                    </div>
                </div>
                <div class="map-container mb-4">
                    <h4>Localizanos</h4>
                    <div id="map" class="border rounded"></div>
                </div>
            </div>

            <div class="col-lg-6">
                <!-- Social Icons -->
                <div class="social-icons mb-4">
                    <h4>Síguenos en</h4>
                    <a href="https://facebook.com/empresa" target="_blank" aria-label="Facebook" class="me-3"><i class="fab fa-facebook"></i></a>
                    <a href="https://twitter.com/empresa" target="_blank" aria-label="Twitter" class="me-3"><i class="fab fa-twitter"></i></a>
                    <a href="https://linkedin.com/company/empresa" target="_blank" aria-label="LinkedIn" class="me-3"><i class="fab fa-linkedin"></i></a>
                    <a href="https://instagram.com/empresa" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                </div>
                <!-- Contact Form -->
                <div class="contact-form bg-light p-4 rounded shadow-sm">
                    <h3 class="mb-4">Envíanos un Mensaje</h3>
                    <form id="contactForm">
                        <div class="mb-3">
                            <input type="text" name="name" class="form-control" placeholder="Nombre *" required />
                        </div>
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Correo Electrónico *" required />
                        </div>
                        <div class="mb-3">
                            <input type="text" name="phone" class="form-control" placeholder="Teléfono *" required />
                        </div>
                        <div class="mb-3">
                            <textarea name="message" class="form-control" placeholder="Mensaje *" rows="4" required></textarea>
                        </div>
                        <div class="mb-3">
                            <input type="submit" class="btnContact w-100" value="Enviar" />
                        </div>
                    </form>
                    <div id="responseMessage"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include_once __DIR__ . "/shared/footer.php" ?>
</body>