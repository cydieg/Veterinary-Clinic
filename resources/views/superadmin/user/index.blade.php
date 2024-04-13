@extends('back.layout.superadmin-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title here')
@section('content')
<style>
    .custom-thead {
        background-color: #BC7FCD;
        color: white;
    }
</style>

<h2 class="h2 p-3">List of Users</h2>
<div class="d-flex justify-content-between align-items-center mb-3">
    <a href="{{ route('superadmin.user.create') }}" class="btn btn-info ml-3">Create User</a>
    <a href="http://127.0.0.1:8000/super-admin-dashboard" class="btn btn-secondary mr-3">Back</a>
</div>
<div class="table-responsive">
    <table class="table table-striped">
        <thead class="custom-thead">
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Name</th>
                <th>Address</th>
                <th>Gender</th>
                <th>Age</th>
                <th>Contact Number</th>
                <th>Branch</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->firstName }} {{ $user->middleName }} {{ $user->lastName }}</td>
                <td>{{ $user->barangay }}, {{ $user->city }}, {{ $user->province }}, {{ $user->region }}</td>
                <td>{{ $user->gender }}</td>
                <td>{{ $user->age }}</td>
                <td>{{ $user->contact_number }}</td>
                <td>{{ $user->branch ? $user->branch->name : 'N/A' }}</td> <!-- Use ternary operator to check if branch exists -->
                <td>{{ $user->role }}</td>
                <td>
                    <div class="btn-group">
                        <a href="{{ route('superadmin.user.edit', ['id' => $user->id]) }}" class="btn btn-success btn-sm">Edit</a>
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#userModal{{$user->id}}">View</button>
                        <form action="{{ route('superadmin.user.archive', ['id' => $user->id]) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to archive this user?')">Archive</button>
                        </form>
                    </div>
                </td>
            </tr>

            <!-- Modal -->
            <div class="modal fade" id="userModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="userModalLabel{{$user->id}}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="userModalLabel{{$user->id}}">User Information</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Username:</strong> {{ $user->username }}
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Email:</strong> {{ $user->email }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Name:</strong> {{ $user->firstName }} {{ $user->middleName }} {{ $user->lastName }}
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Gender:</strong> {{ $user->gender }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Age:</strong> {{ $user->age }}
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Contact Number:</strong> {{ $user->contact_number }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Address:</strong> {{ $user->barangay }}, {{ $user->city }}, {{ $user->province }}, {{ $user->region }}
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Branch:</strong> {{ $user->branch ? $user->branch->name : 'N/A' }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <strong>Role:</strong> {{ $user->role }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
