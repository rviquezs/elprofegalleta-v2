// Initialize the map and set its view to San Jose, Costa Rica
var map = L.map('map').setView([9.9281, -84.0907], 10);

// Add a tile layer to the map
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

// Function to add markers to the map
function addMarkers(markers) {
    markers.forEach(marker => {
        var popupContent = `
                <div class="popup-content">
                    <img src="${marker.imageUrl}" alt="${marker.name}">
                    <h4>${marker.name}</h4>
                    <p><strong>Address:</strong> ${marker.address}</p>
                    <p><strong>Phone:</strong> ${marker.phone}</p>
                </div>
            `;
        L.marker([marker.lat, marker.lng]).addTo(map)
            .bindPopup(popupContent);
    });
}

// Example markers data
var markers = [
    {
        lat: 9.935519817927876,
        lng: -84.06537360019769,
        imageUrl: 'path/to/image1.jpg',
        name: 'Place 1',
        address: 'Address 1',
        phone: '123-456-7890'
    },
    {
        lat: 9.989518654071595,
        lng: -84.12766890605289,
        imageUrl: 'path/to/image2.jpg',
        name: 'Place 2',
        address: 'Address 2',
        phone: '098-765-4321'
    },
    {
        lat: 9.856230195865328,
        lng: -83.91074325189614,
        imageUrl: 'path/to/image3.jpg',
        name: 'Place 3',
        address: 'Address 3',
        phone: '456-789-0123'
    }
];

// Add markers to the map
addMarkers(markers);

