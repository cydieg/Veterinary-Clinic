@extends('back.layout.main-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title here')
@section('content')
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <div class="container p-3 my-3 custom-bg-color text-white">User Management</div>
        <!-- Include Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <!-- Include jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <style>
            /* Additional styling */
            .form-group {
                margin-bottom: 20px; /* Add some spacing between form groups */
            }
            .custom-bg-color {
                background-color: #BC7FCD;
                font-size: 20px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="col-md-12 mb-3 text-right">
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Add User</a>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Address</th>
                        <th>Contact Number</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($users as $user)
                        <tr>
                             
                            <td>{{ $user->firstName }} {{ $user->lastName }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <td>{{ $user->barangay }}, {{ $user->city }}, {{ $user->province }}, {{ $user->region }}</td>
                            <td>{{ $user->contact_number }}</td>
                            <td>{{ $user->age }}</td>
                            <td>{{ $user->gender }}</td>
                            <td>
                                <div style="display: flex;">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#userModal{{ $user->id }}">View</button>
                                    
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editUserModal{{ $user->id }}">Edit</button>
                                    
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                        <!-- View User Modal -->
                        <div class="modal fade" id="userModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="userModalLabel">User Details</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Username:</strong> {{ $user->username }}</p>
                                        <p><strong>Email:</strong> {{ $user->email }}</p>
                                        <p><strong>First Name:</strong> {{ $user->firstName }}</p>
                                        <p><strong>Last Name:</strong> {{ $user->lastName }}</p>
                                        <p><strong>Middle Name:</strong> {{ $user->middleName }}</p>
                                        <p><strong>Address:</strong> {{ $user->barangay }}, {{ $user->city }}, {{ $user->province }}, {{ $user->region }}</p>
                                        <p><strong>Region:</strong> {{ $user->region }}</p>
                                        <p><strong>Province:</strong> {{ $user->province }}</p>
                                        <p><strong>City:</strong> {{ $user->city }}</p>
                                        <p><strong>Barangay:</strong> {{ $user->barangay }}</p>
                                        <p><strong>Gender:</strong> {{ $user->gender }}</p>
                                        <p><strong>Age:</strong> {{ $user->age }}</p>
                                        
                                        <!-- Add other user details as needed -->
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>                                                    <!-- Edit User Modal -->
                            <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Edit User Form -->
                                            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <label for="username">Username:</label>
                                                    <input type="text" name="username" id="username" class="form-control" value="{{ $user->username }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email:</label>
                                                    <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="firstName">First Name:</label>
                                                    <input type="text" name="firstName" id="firstName" class="form-control" value="{{ $user->firstName }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="lastName">Last Name:</label>
                                                    <input type="text" name="lastName" id="lastName" class="form-control" value="{{ $user->lastName }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="middleName">Middle Name:</label>
                                                    <input type="text" name="middleName" id="middleName" class="form-control" value="{{ $user->middleName }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="contact_number">Contact Number:</label>
                                                    <input type="text" name="contact_number" id="contact_number" class="form-control" value="{{ $user->contact_number }}">
                                                </div>     
                                                <!-- Address Selector -->
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="region">Region:</label>
                                                            <select class="form-control" id="region" name="region">
                                                                <!-- Options will be dynamically populated by JavaScript -->
                                                            </select>
                                                            <input type="hidden" name="region_text" id="region-text" value="">
                                                            <div class="invalid-feedback">
                                                                Please select a valid region.
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="province">Province:</label>
                                                            <select class="form-control" id="province" name="province">
                                                                <!-- Options will be dynamically populated by JavaScript -->
                                                            </select>
                                                            <input type="hidden" name="province_text" id="province-text" value="">
                                                            <div class="invalid-feedback">
                                                                Please select a valid province.
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="city">City:</label>
                                                            <select class="form-control" id="city" name="city">
                                                                <!-- Options will be dynamically populated by JavaScript -->
                                                            </select>
                                                            <input type="hidden" name="city_text" id="city-text" value="">
                                                            <div class="invalid-feedback">
                                                                Please select a valid city.
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Barangay select -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="barangay">Barangay:</label>
                                                        <select class="form-control" id="barangay" name="barangay">
                                                            <!-- Options will be dynamically populated by JavaScript -->
                                                        </select>
                                                        <input type="hidden" name="barangay_text" id="barangay-text" value="">
                                                        <div class="invalid-feedback">
                                                            Please select a valid barangay.
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Add other form fields as needed -->
                                                <div class="form-group">
                                                    <label for="gender">Gender:</label>
                                                    <select name="gender" id="gender" class="form-control" required>
                                                        <option value="male" {{ $user->gender === 'male' ? 'selected' : '' }}>Male</option>
                                                        <option value="female" {{ $user->gender === 'female' ? 'selected' : '' }}>Female</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="age">Age:</label>
                                                    <input type="number" name="age" id="age" class="form-control" value="{{ $user->age }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="role">Role:</label>
                                                    <select name="role" id="role" class="form-control" required>
                                                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                                        <option value="patient" {{ $user->role === 'patient' ? 'selected' : '' }}>Patient</option>
                                                        <option value="staff" {{ $user->role === 'staff' ? 'selected' : '' }}>Staff</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="password">Password:</label>
                                                    <input type="password" name="password" id="password" class="form-control" placeholder="Leave blank to keep current password">
                                                </div>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
                                                dropdown.append($('<option></option>').attr('value', entry.province_code).text(entry.province_name));
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
                                                dropdown.append($('<option></option>').attr('value', entry.city_code).text(entry.city_name));
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
                                                dropdown.append($('<option></option>').attr('value', entry.brgy_code).text(entry.brgy_name));
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
                                            dropdown.append($('<option></option>').attr('value', entry.region_code).text(entry.region_name));
                                        })
                                    });
                            
                                });
                            </script>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Include jQuery and Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>
@endsection
