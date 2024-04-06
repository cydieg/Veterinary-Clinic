@extends('back.layout.superadmin-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Create New User')
@section('content')

<div class="container">
    <h1>Create New User</h1>

    <form action="{{ route('superadmin.user.store') }}" method="POST">
        @csrf
        <!-- Personal Information -->
        <div class="row">
            <!-- Username -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
            </div>
            <!-- Last Name -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="lastName">Last Name:</label>
                    <input type="text" class="form-control" id="lastName" name="lastName">
                </div>
            </div>
        </div>
        <div class="row">
            <!-- First Name -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="firstName">First Name:</label>
                    <input type="text" class="form-control" id="firstName" name="firstName" required>
                </div>
            </div>
            <!-- Middle Name -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="middleName">Middle Name:</label>
                    <input type="text" class="form-control" id="middleName" name="middleName">
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Age -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="age">Age:</label>
                    <input type="number" class="form-control" id="age" name="age">
                </div>
            </div>
            <!-- Gender -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="gender">Gender:</label>
                    <select class="form-control" id="gender" name="gender">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Branch -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="branch">Branch:</label>
                    <select class="form-control" id="branch" name="branch_id">
                        @foreach($branches as $branch)
                            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- Role -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="role">Role:</label>
                    <select class="form-control" id="role" name="role">
                        <option value="admin">Admin</option>
                        <option value="patient">Patient</option>
                        <option value="staff">Staff</option>
                        <option value="super_admin">Super Admin</option>
                    </select>
                </div>
            </div>
        </div>
        <!-- Address Fields -->
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
        <!-- Email -->
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
            </div>
        </div>
        <!-- Password -->
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
            </div>
        </div>
        <!-- Contact Number -->
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="contact_number">Contact Number:</label>
                    <input type="text" class="form-control" id="contact_number" name="contact_number">
                </div>
            </div>
        </div>
        <!-- Submit Button -->
        <div class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>

@endsection
