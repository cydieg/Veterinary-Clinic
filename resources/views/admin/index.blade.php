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
                       
                        <th>Username</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                             
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#userModal{{ $user->id }}">
                                    View
                                </button>
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editUserModal{{ $user->id }}">
                                    Edit
                                </button>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
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
                                        <p><strong>ID:</strong> {{ $user->id }}</p>
                                        <p><strong>Username:</strong> {{ $user->username }}</p>
                                        <p><strong>Email:</strong> {{ $user->email }}</p>
                                        <p><strong>First Name:</strong> {{ $user->firstName }}</p>
                                        <p><strong>Last Name:</strong> {{ $user->lastName }}</p>
                                        <p><strong>Middle Name:</strong> {{ $user->middleName }}</p>
                                        <p><strong>Address:</strong> {{ $user->address }}</p>
                                        <p><strong>Gender:</strong> {{ $user->gender }}</p>
                                        <p><strong>Age:</strong> {{ $user->age }}</p>
                                        <!-- Add other user details as needed -->
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Edit User Modal -->
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
                                                <label for="address">Address:</label>
                                                <input type="text" name="address" id="address" class="form-control" value="{{ $user->address }}">
                                            </div>
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