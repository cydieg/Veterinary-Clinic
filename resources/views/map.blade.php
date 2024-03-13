@extends('back.layout.main-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title here')
@section('content')
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    <div>
        <div class="row">
            <div class="col-md-12">
                <div id="map" style="height: 400px;"></div>
            </div>
            <div class="col-md-4">
                <!-- Bootstrap Appointment Modal -->
                <div class="modal" id="appointmentModal" tabindex="-1" role="dialog">
                    <!-- Modal content goes here (unchanged) -->
                </div>
            </div>
        </div>
    </div>

        <!-- Include Leaflet and other scripts -->
        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
        <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
        
            <!-- jQuery -->
            <script src="assets/js/jquery.min.js"></script>
            
            <!-- Bootstrap Core JS -->
            <script src="assets/js/popper.min.js"></script>
            <script src="assets/js/bootstrap.min.js"></script>
            
            <!-- Slick JS -->
            <script src="assets/js/slick.js"></script>
            
            <!-- Custom JS -->
            <script src="assets/js/script.js"></script>
        <!-- Your custom JavaScript -->
        <script src="assets/js/dental-clinic-map.js"></script>
   @endsection