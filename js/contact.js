// Initialize the map and set its view to San Jose, Costa Rica
var map = L.map('map').setView([9.9281, -84.0907], 10);
var markers = [
    {
        lat: 9.935519817927876,
        lng: -84.06537360019769,
        imageUrl: 'https://i.pinimg.com/originals/81/59/79/81597960b9416380b6326362653457fc.jpg',
        name: 'Sucursal San José',
        address: 'San José Province, San José',
        phone: '(506)2252-3353'
    },
    {
        lat: 9.989518654071595,
        lng: -84.12766890605289,
        imageUrl: 'https://i.pinimg.com/originals/67/d3/ba/67d3ba3182153ece79857558e79e9d02.jpg',
        name: 'Sucursal Heredia',
        address: 'Heredia Province, Heredia',
        phone: '098-765-4321'
    },
    {
        lat: 9.856230195865328,
        lng: -83.91074325189614,
        imageUrl: 'https://www.tec.ac.cr/system/files/media/img/main/El%20TEC%20-%20Recintos%20-%20Cartago.JPG',
        name: 'Sucursal Cartago',
        address: 'Cartago Province, Cartago',
        phone: '(506)2252-3353'
    }
];

// Add a tile layer to the map
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

// Function to add markers to the map
function addMarkers(markers) {
    markers.forEach(marker => {
        var popupContent = `
                <div class="popup-content">
                    <img width='255' height='155' src="${marker.imageUrl}" alt="${marker.name}">
                    <h4>${marker.name}</h4>
                    <p><strong>Address:</strong> ${marker.address}</p>
                    <p><strong>Phone:</strong> ${marker.phone}</p>
                </div>
            `;
        L.marker([marker.lat, marker.lng]).addTo(map)
            .bindPopup(popupContent);
    });
}



$(document).ready(function () {

    $('#contactForm').on('submit', function (e) {
        e.preventDefault(); // Prevent default form submission

        $.ajax({
            url: 'http://localhost:8080/send-email', // Endpoint for sending email
            type: 'POST',
            data: $(this).serialize(),
            success: function (response) {
                let timerInterval;
                Swal.fire({
                    icon: 'success',
                    title: "Correo enviado!",
                    text: "Su mensaje ha sido enviado, será contactado por nuestro equipo",
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading();
                        const timer = Swal.getPopup().querySelector("b");
                        timerInterval = setInterval(() => {
                            timer.textContent = `${Swal.getTimerLeft()}`;
                        }, 100);
                    },
                    willClose: () => {
                        clearInterval(timerInterval);
                    }
                });
                $('#contactForm').find('input[type=text], input[type=email], textarea').val('');
            },
            error: function (xhr) {
                Swal.fire({
                    icon: 'error',
                    title: "Error al enviar mensaje!",
                    text: "No se logrón enviar su mensaje, por favor intente de nuevo",
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading();
                        const timer = Swal.getPopup().querySelector("b");
                        timerInterval = setInterval(() => {
                            timer.textContent = `${Swal.getTimerLeft()}`;
                        }, 100);
                    },
                    willClose: () => {
                        clearInterval(timerInterval);
                    }
                });
            }
        });
    });

    // Add markers to the map
    addMarkers(markers);
});

