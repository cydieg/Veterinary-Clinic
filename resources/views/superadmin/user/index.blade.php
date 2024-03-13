@extends('back.layout.superadmin-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title here')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Users</title>
    <!-- Link Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Add any necessary CSS stylesheets here -->
</head>
<body>
    <div class="container">
        <div class="card-box mb-4">
            <div class="table-responsive">
                <h2 class="h2 p-3">List of Users</h2>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <a href="{{ route('superadmin.user.create') }}" class="btn btn-primary ml-3">Create User</a>
                    <a href="http://127.0.0.1:8000/super-admin-dashboard" class="btn btn-secondary mr-3">Back to Super Admin Dashboard</a>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Email</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Middle Name</th>
                            <th>Address</th>
                            <th>Gender</th>
                            <th>Age</th>
                            <th>Role</th>
                            <th>Clinic Location</th>
                            <th>Created At</th>
                            <th>Action</th> <!-- Add the Action column -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->firstName }}</td>
                            <td>{{ $user->lastName }}</td>
                            <td>{{ $user->middleName }}</td>
                            <td>{{ $user->address }}</td>
                            <td>{{ $user->gender }}</td>
                            <td>{{ $user->age }}</td>
                            <td>{{ $user->role }}</td>
                            <td>{{ $user->clinic->name ?? 'N/A' }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>
                                <a href="{{ route('superadmin.user.edit', ['id' => $user->id]) }}" class="btn btn-primary">Edit</a>
                                <!-- Add other action buttons here, e.g., delete -->
                                <form action="{{ route('superadmin.user.archive', ['id' => $user->id]) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to archive this user?')">Archive</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Link Bootstrap JS and any other necessary scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
@endsection
