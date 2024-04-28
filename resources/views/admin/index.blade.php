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
        <!-- Include jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Address</th>
                        <th>Contact Number</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($users as $user)
                        <tr>
                             
                            <td>{{ $user->firstName }} {{ $user->lastName }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <td>{{ $user->barangay }}, {{ $user->city }}, {{ $user->province }}, {{ $user->region }}</td>
                            <td>{{ $user->contact_number }}</td>
                            <td>{{ $user->age }}</td>
                            <td>{{ $user->gender }}</td>
                            <td>
                                <div style="display: flex;">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#userModal{{ $user->id }}">View</button>
                                    
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning">Edit</a>

                                    
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </div>
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
                                        <p><strong>Username:</strong> {{ $user->username }}</p>
                                        <p><strong>Email:</strong> {{ $user->email }}</p>
                                        <p><strong>First Name:</strong> {{ $user->firstName }}</p>
                                        <p><strong>Last Name:</strong> {{ $user->lastName }}</p>
                                        <p><strong>Middle Name:</strong> {{ $user->middleName }}</p>
                                        <p><strong>Address:</strong> {{ $user->barangay }}, {{ $user->city }}, {{ $user->province }}, {{ $user->region }}</p>
                                        <p><strong>Region:</strong> {{ $user->region }}</p>
                                        <p><strong>Province:</strong> {{ $user->province }}</p>
                                        <p><strong>City:</strong> {{ $user->city }}</p>
                                        <p><strong>Barangay:</strong> {{ $user->barangay }}</p>
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
                            <script>
                              
                            </script>
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
