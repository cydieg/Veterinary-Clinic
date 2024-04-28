@extends('back.layout.superadmin-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Edit User')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <!-- Link Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Add any necessary CSS stylesheets here -->
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
        <div class="p-3 my-3 custom-bg-color text-white">Edit User</div>
        <form action="{{ route('superadmin.user.update', $user->id) }}" method="POST" class="needs-validation" novalidate>
            @csrf
            @method('PUT')
            <!-- Personal Information -->
            <div class="row">
                <!-- Username -->
                <div class="col-md-4 mb-3">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}" required>
                    <div class="invalid-feedback">
                        Please enter a username.
                    </div>
                </div>
                <!-- Email -->
                <div class="col-md-4 mb-3">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                    <div class="invalid-feedback">
                        Please enter a valid email address.
                    </div>
                </div>
                <!-- Contact Number -->
                <div class="col-md-4 mb-3">
                    <label for="contact_number">Contact Number:</label>
                    <input type="text" class="form-control" id="contact_number" name="contact_number" value="{{ $user->contact_number }}">
                </div>
            </div>

            <div class="row">
                <!-- Last Name -->
                <div class="col-md-4 mb-3">
                    <label for="lastName">Last Name:</label>
                    <input type="text" class="form-control" id="lastName" name="lastName" value="{{ $user->lastName }}">
                </div>
                <!-- First Name -->
                <div class="col-md-4 mb-3">
                    <label for="firstName">First Name:</label>
                    <input type="text" class="form-control" id="firstName" name="firstName" value="{{ $user->firstName }}" required>
                    <div class="invalid-feedback">
                        Please provide a valid first name.
                    </div>
                </div>
                <!-- Middle Name -->
                <div class="col-md-4 mb-3">
                    <label for="middleName">Middle Name:</label>
                    <input type="text" class="form-control" id="middleName" name="middleName" value="{{ $user->middleName }}">
                </div>
            </div>

            <div class="row">
                <!-- Age -->
                <div class="col-md-4 mb-3">
                    <label for="age">Age:</label>
                    <input type="number" class="form-control" id="age" name="age" value="{{ $user->age }}">
                </div>
                <!-- Gender -->
                <div class="col-md-4 mb-3">
                    <label for="gender">Gender:</label>
                    <select class="form-control" id="gender" name="gender">
                        <option value="male" @if($user->gender == 'male') selected @endif>Male</option>
                        <option value="female" @if($user->gender == 'female') selected @endif>Female</option>
                    </select>
                </div>
                 <!-- Role -->
                 <div class="col-md-4 mb-3">
                    <label for="role">Role:</label>
                    <select class="form-control" id="role" name="role">
                        <option value="admin" @if($user->role == 'admin') selected @endif>Admin</option>
                        <option value="patient" @if($user->role == 'patient') selected @endif>Patient</option>
                        <option value="staff" @if($user->role == 'staff') selected @endif>Staff</option>
                        <option value="super_admin" @if($user->role == 'super_admin') selected @endif>Super Admin</option>
                    </select>
                </div>
                <!-- Status -->
                <div class="col-md-4 mb-3">
                    <label for="status">Status:</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="verified" @if($user->status == 'verified') selected @endif>Verified</option>
                        <option value="pending" @if($user->status == 'pending') selected @endif>Pending</option>
                    </select>
                </div>
                
            </div>
            

            <div class="row">
                <!-- Region -->
                <div class="col-md-4 mb-3">
                    <label for="region">Region:</label>
                    <select class="form-control" id="region" name="region" required>
                        <!-- Options will be dynamically populated by JavaScript -->
                    </select>
                    <input type="hidden" name="region_text" id="region-text" value="{{ $user->region }}">
                    <div class="invalid-feedback">
                        Please select a valid region.
                    </div>
                </div>
                <!-- Province -->
                <div class="col-md-4 mb-3">
                    <label for="province">Province:</label>
                    <select class="form-control" id="province" name="province" required>
                        <!-- Options will be dynamically populated by JavaScript -->
                    </select>
                    <input type="hidden" name="province_text" id="province-text" value="{{ $user->province }}">
                    <div class="invalid-feedback">
                        Please select a valid province.
                    </div>
                </div>
                <!-- City -->
                <div class="col-md-4 mb-3">
                    <label for="city">City:</label>
                    <select class="form-control" id="city" name="city" required>
                        <!-- Options will be dynamically populated by JavaScript -->
                    </select>
                    <input type="hidden" name="city_text" id="city-text" value="{{ $user->city }}">
                    <div class="invalid-feedback">
                        Please select a valid city.
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Barangay -->
                <div class="col-md-4 mb-3">
                    <label for="barangay">Barangay:</label>
                    <select class="form-control" id="barangay" name="barangay" required>
                        <!-- Options will be dynamically populated by JavaScript -->
                    </select>
                    <input type="hidden" name="barangay_text" id="barangay-text" value="{{ $user->barangay }}">
                    <div class="invalid-feedback">
                        Please select a valid barangay.
                    </div>
                </div>
               <!-- Password -->
                <div class="col-md-4 mb-3">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password">
                    <div class="invalid-feedback">
                        Please provide a valid password.
                    </div>
                </div>
                <!-- Password Confirmation -->
                <div class="col-md-4 mb-3">
                    <label for="password_confirmation">Confirm Password:</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                </div>

            </div>

            <!-- Submit Button -->
            <div class="row">
                <div class="col-md-12 mb-3 text-right">
                    <button type="submit" class="btn btn-primary">Update User</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Link Bootstrap JS and any other necessary scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // JavaScript to handle branch selection based on role
        document.getElementById('role').addEventListener('change', function() {
            var role = this.value;
            var branchSelect = document.getElementById('branch');

            if (role === 'patient') {
                // Set branch value to null and disable branch selection
                branchSelect.value = '';
                branchSelect.setAttribute('disabled', 'disabled');
            } else {
                // Enable branch selection
                branchSelect.removeAttribute('disabled');
            }
        });
    </script>
</body>
</html>
@endsection
