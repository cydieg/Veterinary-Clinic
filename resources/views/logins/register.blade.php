@extends('back.layout.auth-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Register')
@section('content')

<div class="login-box bg-white box-shadow border-radius-10">
    <div class="login-title">
        <h2 class="text-center text-primary">Personal Information</h2>
    </div>
    
    <form action="{{ route('register') }}" method="post">
        @csrf

        <div class="row mb-2">
            <div class="col-md-12">
                <div class="input-group custom">
                    <input type="text" class="form-control form-control-lg" placeholder="Username" name="username" required>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-6">
                <div class="input-group custom">
                    <input type="text" class="form-control form-control-lg" placeholder="First Name" name="firstName" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group custom">
                    <input type="text" class="form-control form-control-lg" placeholder="Last Name" name="lastName" required>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-6">
                <div class="input-group custom">
                    <input type="text" class="form-control form-control-lg" placeholder="Middle Name" name="middleName">
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group custom">
                    <select class="form-control form-control-lg" id="gender" name="gender" required>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </div>
            </div>
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

        <div class="row mb-2">
            <div class="col-md-6">
                <div class="input-group custom">
                    <input type="number" class="form-control form-control-lg" placeholder="Age" name="age" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group custom">
                    <select class="form-control form-control-lg" id="role" name="role" required>
                        <option value="patient">Patient</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-6">
                <div class="input-group custom">
                    <input type="email" class="form-control form-control-lg" placeholder="Email" name="email" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group custom">
                    <input type="text" class="form-control form-control-lg" placeholder="Contact Number" name="contact_number">
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-12">
                <div class="input-group custom">
                    <input type="password" class="form-control form-control-lg" placeholder="Password" name="password" id="password" required>
                    <div class="input-group-append">
                        <span class="input-group-text" onclick="togglePasswordVisibility()">
                            <i id="togglePasswordIcon" class="fa fa-eye"></i> <!-- Eye icon -->
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add a message for email verification -->
        <div class="alert alert-info" role="alert">
            Please note that you need to verify your email address before logging in. A verification link will be sent to your email after registration.
        </div>

        <div class="text-center mt-2">
            <p>Already have an account? <a href="{{ route('login') }}" class="text-primary">Login</a></p>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="input-group mb-0">
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Register</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    function togglePasswordVisibility() {
        var passwordField = document.getElementById("password");
        var icon = document.getElementById("togglePasswordIcon");

        if (passwordField.type === "password") {
            passwordField.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            passwordField.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    }
</script>

@endsection
