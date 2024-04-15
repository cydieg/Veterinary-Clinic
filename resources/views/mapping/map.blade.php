@extends('back.layout.ecom-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Vet')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mapping</title>
    <!-- Add Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <!-- Add Leaflet JavaScript -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <style>
        /* Adjust map container size */
        #map {
            height: 600px;
            width: 70%;
        }
    </style>
</head>
<body>
    <!-- Map container -->
    <div id="map"></div>

    <script>
        // Initialize the map with coordinates of Mindoro, Philippines
        var map = L.map('map').setView([12.8445, 121.3790], 10);

        // Add the base OpenStreetMap layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(map);

        // Add a marker for Rem's Pet Shop Camilmil
        var marker1 = L.marker([13.4061, 121.1760]).addTo(map)
            .bindPopup("<b>Rem's Pet Shop Camilmil</b><br>Located here. <br><a href='https://www.google.com/maps/@13.4055364,121.1751609,3a,75y,337.08h,90t/data=!3m7!1e1!3m5!1s-3UaGvp-WrUGA56pyk-7dg!2e0!6shttps:%2F%2Fstreetviewpixels-pa.googleapis.com%2Fv1%2Fthumbnail%3Fpanoid%3D-3UaGvp-WrUGA56pyk-7dg%26cb_client%3Dsearch.revgeo_and_fetch.gps%26w%3D96%26h%3D64%26yaw%3D337.08377%26pitch%3D0%26thumbfov%3D100!7i16384!8i8192?entry=ttu'>View on Google Maps</a>")
            .openPopup();

        // Add a marker for Rem's Pet Shop Roxas
        var marker2 = L.marker([12.5988553, 121.4834413]).addTo(map)
            .bindPopup("<b>Rem's Pet Shop Roxas</b><br>Located here. <br><a href='https://www.google.com/maps/@12.5988553,121.4834413,3a,75y,161.59h,79.46t/data=!3m7!1e1!3m5!1sbJ_R7zKmjzm0ivwL-ikUTg!2e0!6shttps:%2F%2Fstreetviewpixels-pa.googleapis.com%2Fv1%2Fthumbnail%3Fpanoid%3DbJ_R7zKmjzm0ivwL-ikUTg%26cb_client%3Dmaps_sv.tactile.gps%26w%3D203%26h%3D100%26yaw%3D201.91084%26pitch%3D0%26thumbfov%3D100!7i16384!8i8192?entry=ttu'>View on Google Maps</a>")
            .openPopup();

        // Make the marker for Rem's Pet Shop Roxas clickable
        marker2.on('click', function() {
            window.open('https://www.google.com/maps/@12.5988553,121.4834413,3a,75y,161.59h,79.46t/data=!3m7!1e1!3m5!1sbJ_R7zKmjzm0ivwL-ikUTg!2e0!6shttps:%2F%2Fstreetviewpixels-pa.googleapis.com%2Fv1%2Fthumbnail%3Fpanoid%3DbJ_R7zKmjzm0ivwL-ikUTg%26cb_client%3Dmaps_sv.tactile.gps%26w%3D203%26h%3D100%26yaw%3D201.91084%26pitch%3D0%26thumbfov%3D100!7i16384!8i8192?entry=ttu');
        });

        // Center and zoom the map to show all markers
        var group = new L.featureGroup([marker1, marker2]);
        map.fitBounds(group.getBounds());
    </script>
</body>
</html>
@endsection