@extends('back.layout.superadmin-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title here')
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
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit User</h1>
        <form action="{{ route('superadmin.user.update', $user->id) }}" method="POST" class="needs-validation" novalidate>
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}" required>
                        <div class="invalid-feedback">
                            Please enter a username.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                        <div class="invalid-feedback">
                            Please enter a valid email address.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="firstName">First Name:</label>
                        <input type="text" class="form-control" id="firstName" name="firstName" value="{{ $user->firstName }}">
                    </div>
                    <div class="form-group">
                        <label for="lastName">Last Name:</label>
                        <input type="text" class="form-control" id="lastName" name="lastName" value="{{ $user->lastName }}">
                    </div>
                    <div class="form-group">
                        <label for="contact_number">Contact Number:</label>
                        <input type="text" class="form-control" id="contact_number" name="contact_number" value="{{ $user->contact_number }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="middleName">Middle Name:</label>
                        <input type="text" class="form-control" id="middleName" name="middleName" value="{{ $user->middleName }}">
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender:</label>
                        <select class="form-control" id="gender" name="gender">
                            <option value="male" @if($user->gender == 'male') selected @endif>Male</option>
                            <option value="female" @if($user->gender == 'female') selected @endif>Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="age">Age:</label>
                        <input type="number" class="form-control" id="age" name="age" value="{{ $user->age }}">
                    </div>
                </div>
            </div>

            <!-- Address Selector -->
            <div class="row mb-2">
                <div class="col-md-6">
                    <div class="input-group custom">
                        <select class="form-control form-control-lg" id="region" name="region">
                            @foreach($addresses['regions'] as $region)
                                <option value="{{ $region }}" @if($user->region == $region) selected @endif>{{ $region }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="region_text" id="region-text" value="{{ $user->region }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group custom">
                        <select class="form-control form-control-lg" id="province" name="province">
                            @foreach($addresses['provinces'] as $province)
                                <option value="{{ $province }}" @if($user->province == $province) selected @endif>{{ $province }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="province_text" id="province-text" value="{{ $user->province }}">
                    </div>
                </div>
            </div>
    
            <div class="row mb-2">
                <div class="col-md-6">
                    <div class="input-group custom">
                        <select class="form-control form-control-lg" id="city" name="city">
                            @foreach($addresses['cities'] as $city)
                                <option value="{{ $city }}" @if($user->city == $city) selected @endif>{{ $city }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="city_text" id="city-text" value="{{ $user->city }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group custom">
                        <select class="form-control form-control-lg" id="barangay" name="barangay">
                            @foreach($addresses['barangays'] as $barangay)
                                <option value="{{ $barangay }}" @if($user->barangay == $barangay) selected @endif>{{ $barangay }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="barangay_text" id="barangay-text" value="{{ $user->barangay }}">
                    </div>
                </div>
            </div>
            <!-- End Address Selector -->

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="role">Role:</label>
                        <select class="form-control" id="role" name="role">
                            <option value="admin" @if($user->role == 'admin') selected @endif>Admin</option>
                            <option value="patient" @if($user->role == 'patient') selected @endif>Patient</option>
                            <option value="staff" @if($user->role == 'staff') selected @endif>Staff</option>
                            <option value="super_admin" @if($user->role == 'super_admin') selected @endif>Super Admin</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Leave blank to keep the current password">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 offset-md-6">
                    <div class="form-group"><br>
                        <button type="submit" class="btn btn-primary">Update User</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Link Bootstrap JS and any other necessary scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
@endsection
