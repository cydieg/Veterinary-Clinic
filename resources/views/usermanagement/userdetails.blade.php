@extends('back.layout.main-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title here')
@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        /* Your existing styles remain unchanged */

        /* Add any additional styles here */
        body {
            padding: 20px;
        }

        .h4 {
            padding: 20px;
        }

        .details-container {
            display: flex;
            justify-content: space-between;
        }

        .details-section {
            flex: 1;
            padding: 20px;
        }
    </style>
</head>

<body>

    <div class="h4 pd-20">User Details</div>

    <div class="details-container">
        @if(isset($user))
        <div class="details-section">
            <p><strong>Username:</strong> {{ $user->username }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Created At:</strong> {{ $user->created_at->format('Y-m-d H:i:s') }}</p>

            <!-- Add more user details if needed -->
            <p><strong>First Name:</strong> {{ $user->firstName }}</p>
            <p><strong>Last Name:</strong> {{ $user->lastName }}</p>
            <p><strong>Middle Name:</strong> {{ $user->middleName }}</p>
        </div>

        <div class="details-section">
            <p><strong>Address:</strong> {{ $user->address }}</p>
            <p><strong>Gender:</strong> {{ $user->gender }}</p>
            <p><strong>Age:</strong> {{ $user->age }}</p>
            <p><strong>Role:</strong> {{ $user->role }}</p>

            <!-- Display the associated clinic -->
            <p><strong>Branch:</strong> {{ $user->clinic->name }}</p>
            <div>
                <a href="{{ route('userTable') }}">Go Back to User Table</a>
            </div>
        </div>

        @else
        <p>No user data found.</p>
        @endif
    </div>

    <!-- Include Bootstrap JS at the end of the body for better performance -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>

@endsection
