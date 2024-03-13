// dental-clinic-map.js

document.addEventListener('DOMContentLoaded', function () {
    // Initialize the map
    var map = L.map('map').setView([13.4105, 121.1810], 14);

    // Add OpenStreetMap tiles
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

    // Sample dental clinic data
    var dentalClinics = [
        { name: 'Gayeta Dental Clinic', location: [13.4125465, 121.1791858] },
        { name: 'Benedick Masangkay Dental Clinic', location: [13.4070647444, 121.177026629 ] },
        { name: 'Bolor Dental Clinic', location: [13.41257, 121.17809] },
        { name: 'Orense Dental Clinic', location: [13.41372, 121.18024] },
        { name: 'Gozar Dental Clinic', location: [13.41288, 121.17993] },
        { name: 'Goco Dental Clinic', location: [13.4124765500005, 121.1797407499961] },
        // Add more dental clinic data as needed
    ];

    // Add markers for each dental clinic
    dentalClinics.forEach(function (clinic) {
        var marker = L.marker(clinic.location).addTo(map);
        marker.bindPopup('<b>' + clinic.name + '</b><br> <button class="book-appointment" data-name="' + clinic.name + '">Book Appointment</button>');
    });

    // Handle clicking on a marker
    map.on('popupopen', function (e) {
        var marker = e.popup._source;
        var clinicName = marker.getPopup().getContent();
        var button = document.querySelector('.book-appointment');
        button.addEventListener('click', function () {
            // Show modal or perform other actions for booking appointment
            alert('Booking appointment for ' + clinicName);
        });
    });

    // Add geocoding control for searching locations
    L.Control.geocoder().addTo(map);
});
