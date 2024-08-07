<footer class="footer bg-light py-3">
    <div class="container text-center">
        <span class="text-muted">© 2024 El Profe Galleta. (Casi) Todos los derechos reservados.</span>
        <ul class="list-inline mt-2">
            <li class="list-inline-item"><a href="./index.php">Página Principal</a></li>
            <li class="list-inline-item"><a href="./services.php">Servicios</a></li>
            <li class="list-inline-item"><a href="./contact.php">Contacto</a></li>
            <li class="list-inline-item"><a href="./oferta_academica.php">Oferta Academica</a></li>
        </ul>
        <div class="container text-center" justify-content-evenly>
            <a href="https://facebook.com" target="_blank"><i class="fab fa-facebook"></i></a>
            <a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
            <a href="https://linkedin.com" target="_blank"><i class="fab fa-linkedin"></i></a>
            <a href="https://instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<?php

switch ($url) {
    case 'index':
        echo "<script src=js/index.js></script>";
        break;
    case 'about':
        echo "<script src=js/about.js></script>";
        break;
    case 'login':
        echo "<script src=js/login.js></script>";
        break;
    case 'dashboard':
        echo "<script src=js/dashboard.js></script>";
        break;
    case 'contact':
        echo "<script src=js/contact.js></script>";
        break;
}
?>

</body>

</html>