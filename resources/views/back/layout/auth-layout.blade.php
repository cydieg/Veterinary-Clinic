<!DOCTYPE html>
<html>
<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>@yield('pageTitle')</title>

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="" />
    <link rel="icon" type="image/png" sizes="32x32" href="" />
    <link rel="icon" type="image/png" sizes="16x16" href="/back/images/OralEase.png" />

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
    
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="/back/vendors/styles/core.css" />
    <link rel="stylesheet" type="text/css" href="/back/vendors/styles/icon-font.min.css" />
    <link rel="stylesheet" type="text/css" href="/back/vendors/styles/style.css" />
    @stack('stylesheets')

    <style>
        div {
            background-color: white;
            color: blue; /* You can adjust the text color as needed */
        }
    </style>
</head>

<body class="login-page">
    <div class="login-header box-shadow">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="brand-logo">
                <a href="login.html">
                    <img src="" alt="" />
                </a>
            </div>

        </div>
    </div>
    <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-7">
                    <img src="/back/images/Pet Image.jpg" alt="" />
                </div>
                <div class="col-md-6 col-lg-5">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- JavaScript files -->
    <script src="/back/vendors/scripts/core.js"></script>
    <script src="/back/vendors/scripts/script.min.js"></script>
    <script src="/back/vendors/scripts/process.js"></script>
    <script src="/back/vendors/scripts/layout-settings.js"></script>

    <!-- Custom JavaScript -->
    <script>
        // Paste the provided JavaScript code here
        var my_handlers = {
            // fill province
            fill_provinces: function() {
                //selected region
                var region_code = $(this).val();

                // set selected text to input
                var region_text = $(this).find("option:selected").text();
                let region_input = $('#region-text');
                region_input.val(region_text);
                //clear province & city & barangay input
                $('#province-text').val('');
                $('#city-text').val('');
                $('#barangay-text').val('');

                //province
                let dropdown = $('#province');
                dropdown.empty();
                dropdown.append('<option selected="true" disabled>Choose State/Province</option>');
                dropdown.prop('selectedIndex', 0);

                //city
                let city = $('#city');
                city.empty();
                city.append('<option selected="true" disabled></option>');
                city.prop('selectedIndex', 0);

                //barangay
                let barangay = $('#barangay');
                barangay.empty();
                barangay.append('<option selected="true" disabled></option>');
                barangay.prop('selectedIndex', 0);

                // filter & fill
                var url = '/philippine-address-selector-main/ph-json/province.json';
                $.getJSON(url, function(data) {
                    var result = data.filter(function(value) {
                        return value.region_code == region_code;
                    });

                    result.sort(function(a, b) {
                        return a.province_name.localeCompare(b.province_name);
                    });

                    $.each(result, function(key, entry) {
                        dropdown.append($('<option></option>').attr('value', entry.province_code).text(entry.province_name));
                    })

                });
            },
            // fill city
            fill_cities: function() {
                //selected province
                var province_code = $(this).val();

                // set selected text to input
                var province_text = $(this).find("option:selected").text();
                let province_input = $('#province-text');
                province_input.val(province_text);
                //clear city & barangay input
                $('#city-text').val('');
                $('#barangay-text').val('');

                //city
                let dropdown = $('#city');
                dropdown.empty();
                dropdown.append('<option selected="true" disabled>Choose city/municipality</option>');
                dropdown.prop('selectedIndex', 0);

                //barangay
                let barangay = $('#barangay');
                barangay.empty();
                barangay.append('<option selected="true" disabled></option>');
                barangay.prop('selectedIndex', 0);

                // filter & fill
                var url = '/philippine-address-selector-main/ph-json/city.json';
                $.getJSON(url, function(data) {
                    var result = data.filter(function(value) {
                        return value.province_code == province_code;
                    });

                    result.sort(function(a, b) {
                        return a.city_name.localeCompare(b.city_name);
                    });

                    $.each(result, function(key, entry) {
                        dropdown.append($('<option></option>').attr('value', entry.city_code).text(entry.city_name));
                    })

                });
            },
            // fill barangay
            fill_barangays: function() {
                // selected barangay
                var city_code = $(this).val();

                // set selected text to input
                var city_text = $(this).find("option:selected").text();
                let city_input = $('#city-text');
                city_input.val(city_text);
                //clear barangay input
                $('#barangay-text').val('');

                // barangay
                let dropdown = $('#barangay');
                dropdown.empty();
                dropdown.append('<option selected="true" disabled>Choose barangay</option>');
                dropdown.prop('selectedIndex', 0);

                // filter & Fill
                var url = '/philippine-address-selector-main/ph-json/barangay.json';
                $.getJSON(url, function(data) {
                    var result = data.filter(function(value) {
                        return value.city_code == city_code;
                    });

                    result.sort(function(a, b) {
                        return a.brgy_name.localeCompare(b.brgy_name);
                    });

                    $.each(result, function(key, entry) {
                        dropdown.append($('<option></option>').attr('value', entry.brgy_code).text(entry.brgy_name));
                    })

                });
            },

            onchange_barangay: function() {
                // set selected text to input
                var barangay_text = $(this).find("option:selected").text();
                let barangay_input = $('#barangay-text');
                barangay_input.val(barangay_text);
            },

        };

        $(function() {
            // events
            $('#region').on('change', my_handlers.fill_provinces);
            $('#province').on('change', my_handlers.fill_cities);
            $('#city').on('change', my_handlers.fill_barangays);
            $('#barangay').on('change', my_handlers.onchange_barangay);

            // load region
            let dropdown = $('#region');
            dropdown.empty();
            dropdown.append('<option selected="true" disabled>Choose Region</option>');
            dropdown.prop('selectedIndex', 0);
            const url = '/philippine-address-selector-main/ph-json/region.json';
            // Populate dropdown with list of regions
            $.getJSON(url, function(data) {
                $.each(data, function(key, entry) {
                    dropdown.append($('<option></option>').attr('value', entry.region_code).text(entry.region_name));
                })
            });

        });
    </script>
    @stack('scripts')
</body>
</html>
