@extends('back.layout.superadmin-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Create New User')
@section('content')
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

<div class="container p-3 my-3 custom-bg-color text-white">Add User</div>
<div class="container">

    <form action="{{ route('superadmin.user.store') }}" method="POST" class="needs-validation" novalidate>
        @csrf
        <!-- Personal Information -->
        <div class="row">
            <!-- Username -->
            <div class="col-md-4 mb-3">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
                <div class="invalid-feedback">
                    Please choose a username.
                </div>
            </div>
            <!-- Email -->
            <div class="col-md-4 mb-3">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
                <div class="invalid-feedback">
                    Please provide a valid email.
                </div>
            </div>
            <!-- Contact Number -->
            <div class="col-md-4 mb-3">
                <label for="contact_number">Contact Number:</label>
                <input type="text" class="form-control" id="contact_number" name="contact_number">
            </div>
        </div>

        <div class="row">
            <!-- Last Name -->
            <div class="col-md-4 mb-3">
                <label for="lastName">Last Name:</label>
                <input type="text" class="form-control" id="lastName" name="lastName">
            </div>
            <!-- First Name -->
            <div class="col-md-4 mb-3">
                <label for="firstName">First Name:</label>
                <input type="text" class="form-control" id="firstName" name="firstName" required>
                <div class="invalid-feedback">
                    Please provide a valid first name.
                </div>
            </div>
            <!-- Middle Name -->
            <div class="col-md-4 mb-3">
                <label for="middleName">Middle Name:</label>
                <input type="text" class="form-control" id="middleName" name="middleName">
            </div>
        </div>

        <div class="row">
            <!-- Age -->
            <div class="col-md-4 mb-3">
                <label for="age">Age:</label>
                <input type="number" class="form-control" id="age" name="age">
            </div>
            <!-- Gender -->
            <div class="col-md-4 mb-3">
                <label for="gender">Gender:</label>
                <select class="form-control" id="gender" name="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
            <!-- Branch -->
            <div class="col-md-4 mb-3">
                <label for="branch">Branch:</label>
                <select class="form-control" id="branch" name="branch_id">
                    @foreach($branches as $branch)
                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row">
            <!-- Role -->
            <div class="col-md-4 mb-3">
                <label for="role">Role:</label>
                <select class="form-control" id="role" name="role">
                    <option value="admin">Admin</option>
                    <option value="patient">Patient</option>
                    <option value="staff">Staff</option>
                    <option value="super_admin">Super Admin</option>
                </select>
            </div>
            <!-- Region -->
            <div class="col-md-4 mb-3">
                <label for="region">Region:</label>
                <select class="form-control" id="region" name="region" required>
                    <!-- Options will be dynamically populated by JavaScript -->
                </select>
                <input type="hidden" name="region_text" id="region-text">
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
                <input type="hidden" name="province_text" id="province-text">
                <div class="invalid-feedback">
                    Please select a valid province.
                </div>
            </div>
        </div>

        <div class="row">
            <!-- City -->
            <div class="col-md-4 mb-3">
                <label for="city">City:</label>
                <select class="form-control" id="city" name="city" required>
                    <!-- Options will be dynamically populated by JavaScript -->
                </select>
                <input type="hidden" name="city_text" id="city-text">
                <div class="invalid-feedback">
                    Please select a valid city.
                </div>
            </div>
            <!-- Barangay -->
            <div class="col-md-4 mb-3">
                <label for="barangay">Barangay:</label>
                <select class="form-control" id="barangay" name="barangay" required>
                    <!-- Options will be dynamically populated by JavaScript -->
                </select>
                <input type="hidden" name="barangay_text" id="barangay-text">
                <div class="invalid-feedback">
                    Please select a valid barangay.
                </div>
            </div>
            <!-- Password -->
            <div class="col-md-4 mb-3">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
                <div class="invalid-feedback">
                    Please provide a valid password.
                </div>
            </div>
        </div>

        <!-- Status -->
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="status">Status:</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="verified">Verified</option>
                    <option value="pending">Pending</option>
                </select>
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

@endsection
