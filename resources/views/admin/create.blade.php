@extends('back.layout.main-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title here')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <div class="container p-3 my-3 custom-bg-color text-white">Add User</div>
        <!-- Include jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- Include any other CSS or JavaScript files here -->
        <style>
            /* Additional styling */
            .form-group {
                margin-bottom: 20px;
                /* Add some spacing between form groups */
            }

            .custom-bg-color {
                background-color: #BC7FCD;
                font-size: 20px;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                <!-- First Row -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" name="username" id="username" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="contact_number">Contact Number:</label>
                            <input type="text" name="contact_number" id="contact_number" class="form-control" required>
                        </div>
                    </div>
                </div>

                <!-- Second Row -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="lastName">Last Name:</label>
                            <input type="text" name="lastName" id="lastName" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="firstName">First Name:</label>
                            <input type="text" name="firstName" id="firstName" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="middleName">Middle Name:</label>
                            <input type="text" name="middleName" id="middleName" class="form-control">
                        </div>
                    </div>
                </div>

                <!-- Third Row -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="age">Age:</label>
                            <input type="number" name="age" id="age" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="gender">Gender:</label>
                            <select name="gender" id="gender" class="form-control" required>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="role">Role:</label>
                            <select name="role" id="role" class="form-control" required>
                                <option value="admin">Admin</option>
                                <option value="patient">Patient</option>
                                <option value="staff">Staff</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Fourth Row -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="region">Region:</label>
                            <select class="form-control" id="region" name="region" required>
                                <!-- Options will be dynamically populated by JavaScript -->
                            </select>
                            <input type="hidden" name="region_text" id="region-text">
                            <div class="invalid-feedback">
                                Please select a valid region.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="province">Province:</label>
                            <select class="form-control" id="province" name="province" required>
                                <!-- Options will be dynamically populated by JavaScript -->
                            </select>
                            <input type="hidden" name="province_text" id="province-text">
                            <div class="invalid-feedback">
                                Please select a valid province.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="city">City:</label>
                            <select class="form-control" id="city" name="city" required>
                                <!-- Options will be dynamically populated by JavaScript -->
                            </select>
                            <input type="hidden" name="city_text" id="city-text">
                            <div class="invalid-feedback">
                                Please select a valid city.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Fifth Row -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="barangay">Barangay:</label>
                            <select class="form-control" id="barangay" name="barangay" required>
                                <!-- Options will be dynamically populated by JavaScript -->
                            </select>
                            <input type="hidden" name="barangay_text" id="barangay-text">
                            <div class="invalid-feedback">
                                Please select a valid barangay.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                            <div class="invalid-feedback">
                                Please provide a valid password.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="status">Status:</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="verified">Verified</option>
                                <option value="pending">Pending</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- Sixth Row -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="branch_id">Branch:</label>
                            <select name="branch_id" id="branch_id" class="form-control">
                                <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                            </select>
                        </div>
                    </div>
                </div>


                <!-- Submit Button -->
                <div class="row">
                    <div class="col-md-12 mb-3 text-right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>


        <script>
            var my_handlers = {
                // fill province
                fill_provinces: function() {
                    var region_code = $(this).val();
                    var region_text = $(this).find("option:selected").text();
                    let region_input = $('#region-text');
                    region_input.val(region_text);
                    $('#province-text').val('');
                    $('#city-text').val('');
                    $('#barangay-text').val('');

                    let dropdown = $('#province');
                    dropdown.empty();
                    dropdown.append('<option selected="true" disabled>Choose Province</option>');
                    dropdown.prop('selectedIndex', 0);

                    let city = $('#city');
                    city.empty();
                    city.append('<option selected="true" disabled></option>');
                    city.prop('selectedIndex', 0);

                    let barangay = $('#barangay');
                    barangay.empty();
                    barangay.append('<option selected="true" disabled></option>');
                    barangay.prop('selectedIndex', 0);

                    var url = '/philippine-address-selector-main/ph-json/province.json';
                    $.getJSON(url, function(data) {
                        var result = data.filter(function(value) {
                            return value.region_code == region_code;
                        });

                        result.sort(function(a, b) {
                            return a.province_name.localeCompare(b.province_name);
                        });

                        $.each(result, function(key, entry) {
                            dropdown.append($('<option></option>').attr('value', entry.province_code)
                                .text(entry.province_name));
                        })

                    });
                },
                // fill city
                fill_cities: function() {
                    var province_code = $(this).val();
                    var province_text = $(this).find("option:selected").text();
                    let province_input = $('#province-text');
                    province_input.val(province_text);
                    $('#city-text').val('');
                    $('#barangay-text').val('');

                    let dropdown = $('#city');
                    dropdown.empty();
                    dropdown.append('<option selected="true" disabled>Choose City/Municipality</option>');
                    dropdown.prop('selectedIndex', 0);

                    let barangay = $('#barangay');
                    barangay.empty();
                    barangay.append('<option selected="true" disabled></option>');
                    barangay.prop('selectedIndex', 0);

                    var url = '/philippine-address-selector-main/ph-json/city.json';
                    $.getJSON(url, function(data) {
                        var result = data.filter(function(value) {
                            return value.province_code == province_code;
                        });

                        result.sort(function(a, b) {
                            return a.city_name.localeCompare(b.city_name);
                        });

                        $.each(result, function(key, entry) {
                            dropdown.append($('<option></option>').attr('value', entry.city_code).text(
                                entry.city_name));
                        })

                    });
                },
                // fill barangay
                fill_barangays: function() {
                    var city_code = $(this).val();
                    var city_text = $(this).find("option:selected").text();
                    let city_input = $('#city-text');
                    city_input.val(city_text);
                    $('#barangay-text').val('');

                    let dropdown = $('#barangay');
                    dropdown.empty();
                    dropdown.append('<option selected="true" disabled>Choose Barangay</option>');
                    dropdown.prop('selectedIndex', 0);

                    var url = '/philippine-address-selector-main/ph-json/barangay.json';
                    $.getJSON(url, function(data) {
                        var result = data.filter(function(value) {
                            return value.city_code == city_code;
                        });

                        result.sort(function(a, b) {
                            return a.brgy_name.localeCompare(b.brgy_name);
                        });

                        $.each(result, function(key, entry) {
                            dropdown.append($('<option></option>').attr('value', entry.brgy_code).text(
                                entry.brgy_name));
                        })

                    });
                },

                onchange_barangay: function() {
                    var barangay_text = $(this).find("option:selected").text();
                    let barangay_input = $('#barangay-text');
                    barangay_input.val(barangay_text);
                },
            };

            $(function() {
                $('#region').on('change', my_handlers.fill_provinces);
                $('#province').on('change', my_handlers.fill_cities);
                $('#city').on('change', my_handlers.fill_barangays);
                $('#barangay').on('change', my_handlers.onchange_barangay);

                let dropdown = $('#region');
                dropdown.empty();
                dropdown.append('<option selected="true" disabled>Choose Region</option>');
                dropdown.prop('selectedIndex', 0);
                const url = '/philippine-address-selector-main/ph-json/region.json';
                $.getJSON(url, function(data) {
                    $.each(data, function(key, entry) {
                        dropdown.append($('<option></option>').attr('value', entry.region_code).text(
                            entry.region_name));
                    })
                });

            });
        </script>
    </body>

    </html>
@endsection
