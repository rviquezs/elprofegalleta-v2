<!-- Header -->
<?php include "shared/header.php" ?>

<body>
    <div class="container contact-section">
        <div class="row">
            <!-- Información de Contacto -->
            <div class="col-md-6 contact-info">
                <div class="contact-item">
                    <i class="fas fa-envelope contact-icon"></i>
                    <div class="contact-details">
                        <h4>Correo Electrónico</h4>
                        <p><a href="mailto:elprofegalleta@elprofegalleta.com">elprofegalleta@elprofegalleta.com</a></p>
                    </div>
                </div>
                <div class="contact-item">
                    <i class="fas fa-phone contact-icon"></i>
                    <div class="contact-details">
                        <h4>Teléfono</h4>
                        <p><a href="tel:+50645678901">+506 4567 8901</a></p>
                    </div>
                </div>
                <div class="social-icons">
                    <h4>Síguenos en</h4>
                    <a href="https://facebook.com/empresa" target="_blank" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
                    <a href="https://twitter.com/empresa" target="_blank" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="https://linkedin.com/company/empresa" target="_blank" aria-label="LinkedIn"><i class="fab fa-linkedin"></i></a>
                    <a href="https://instagram.com/empresa" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                </div>
                <div class="map-container mt-4">
                    <!-- <iframe src="https://app.cartes.io/maps/048eebe4-8dac-46e2-a947-50b6b8062fec/embed?type=map" width="100%" height="400" frameborder="0"></iframe> -->
                    <div id="map"></div>
                    <!-- Formulario de Contacto -->
                </div>
                <div class="col-md-6">
                    <div class="contact-form">
                        <h3>Envíanos un Mensaje</h3>
                        <form method="post" action="process_form.php">
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" placeholder="Nombre *" required />
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" placeholder="Correo Electrónico *" required />
                            </div>
                            <div class="form-group">
                                <input type="text" name="phone" class="form-control" placeholder="Teléfono *" required />
                            </div>
                            <div class="form-group">
                                <textarea name="message" class="form-control" placeholder="Mensaje *" required></textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="btnSubmit" class="btnContact" value="Enviar" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <?php include "shared/footer.php" ?>