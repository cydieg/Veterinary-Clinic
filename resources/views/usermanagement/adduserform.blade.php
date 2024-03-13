@extends('back.layout.main-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title here')
@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        /* Add any additional styles here */
        body {
            padding: 20px;
        }

        .form-container {
            max-width: 600px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- Your add user form goes here -->
    <div class="card-box mb-30">
        <h2 class="h2 pd-20" >Add User</h2>
        <div class="table-responsive">
            <div class="card-body">
                <form action="{{ route('storeUser') }}" method="post" enctype="multipart/form-data" class="form-container">
                    @csrf
                    <!-- Your form fields go here -->
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="username">Username:</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Email:</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="password">Password:</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="firstName">First Name:</label>
                            <input type="text" name="firstName" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="lastName">Last Name:</label>
                            <input type="text" name="lastName" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="middleName">Middle Name:</label>
                            <input type="text" name="middleName" class="form-control">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="address">Address:</label>
                            <input type="text" name="address" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="gender">Gender:</label>
                            <select name="gender" class="form-control" required>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <!-- Add more gender options if needed -->
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="age">Age:</label>
                            <input type="number" name="age" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="role">Role:</label>
                            <select name="role" class="form-control" required>
                                <option value="admin">Admin</option>
                                <option value="patient">Patient</option>
                                <option value="staff">Staff</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="clinic_id">Clinic:</label>
                            <select name="clinic_id" class="form-control" required>
                                @foreach($clinics as $clinic)
                                <option value="{{ $clinic->id }}">{{ $clinic->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <button type="submit" class="btn btn-primary btn-block">Add User</button>
                            <a href="{{ route('userTable') }}">Go Back to User Table</a>
                        </div>
                    </div>
                    <!-- Add more fields if needed -->

                </form>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS at the end of the body for better performance -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>

@endsection
