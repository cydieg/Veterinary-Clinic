<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h1>Edit User</h1>
    <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
        @csrf <!-- CSRF Token -->
        @method('PUT') <!-- Method Spoofing for PUT request -->

        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}">
        </div>
        <div class="form-group">
            <label for="firstName">First Name</label>
            <input type="text" class="form-control" id="firstName" name="firstName" value="{{ $user->firstName }}">
        </div>
        <div class="form-group">
            <label for="lastName">Last Name</label>
            <input type="text" class="form-control" id="lastName" name="lastName" value="{{ $user->lastName }}">
        </div>
        <div class="form-group">
            <label for="middleName">Middle Name</label>
            <input type="text" class="form-control" id="middleName" name="middleName" value="{{ $user->middleName }}">
        </div>
        <div class="form-group">
            <label for="gender">Gender</label>
            <select class="form-control" id="gender" name="gender">
                <option value="male" {{ $user->gender === 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ $user->gender === 'female' ? 'selected' : '' }}>Female</option>
                <option value="other" {{ $user->gender === 'other' ? 'selected' : '' }}>Other</option>
            </select>
        </div>
        <div class="form-group">
            <label for="age">Age</label>
            <input type="number" class="form-control" id="age" name="age" value="{{ $user->age }}">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
        </div>
        <div class="form-group">
            <label for="role">Role</label>
            <select class="form-control" id="role" name="role">
                <option value="super_admin" {{ $user->role === 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="staff" {{ $user->role === 'staff' ? 'selected' : '' }}>Staff</option>
                <option value="patient" {{ $user->role === 'patient' ? 'selected' : '' }}>Patient</option>
            </select>
        </div>
        <div class="form-group">
            <label for="contact_number">Contact Number</label>
            <input type="text" class="form-control" id="contact_number" name="contact_number" value="{{ $user->contact_number }}">
        </div>
        <div class="row mb-2">
            <div class="col-md-6">
                <div class="input-group custom">
                    <select class="form-control form-control-lg" id="region" name="region" required>
                        <!-- Options will be dynamically populated by JavaScript -->
                    </select>
                    <input type="hidden" name="region_text" id="region-text">
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group custom">
                    <select class="form-control form-control-lg" id="province" name="province" required>
                        <!-- Options will be dynamically populated by JavaScript -->
                    </select>
                    <input type="hidden" name="province_text" id="province-text">
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-6">
                <div class="input-group custom">
                    <select class="form-control form-control-lg" id="city" name="city" required>
                        <!-- Options will be dynamically populated by JavaScript -->
                    </select>
                    <input type="hidden" name="city_text" id="city-text">
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group custom">
                    <select class="form-control form-control-lg" id="barangay" name="barangay" required>
                        <!-- Options will be dynamically populated by JavaScript -->
                    </select>
                    <input type="hidden" name="barangay_text" id="barangay-text">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status">
                <option value="verified" {{ $user->status === 'verified' ? 'selected' : '' }}>Verified</option>
                <option value="pending" {{ $user->status === 'pending' ? 'selected' : '' }}>Pending</option>
            </select>
        </div>
        <!-- Password field -->
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Leave blank to keep current password">
        </div>

        <button type="submit" class="btn btn-primary">Update User</button>
    </form>
</div>
<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


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
            dropdown.append('<option selected="true" disabled>Choose State/Province</option>');
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
            dropdown.append('<option selected="true" disabled>Choose city/municipality</option>');
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
            dropdown.append('<option selected="true" disabled>Choose barangay</option>');
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
@stack('scripts')

</body>
</html>
