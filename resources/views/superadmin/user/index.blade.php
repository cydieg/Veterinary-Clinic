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
                        <th>Name</th>
                        <th>Address</th>
                        <th>Gender</th>
                        <th>Age</th>
                        <th>Contact Number</th>
                        <th>Role</th>
                        <th>Action</th> <!-- Add the Action column -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->firstName }} {{ $user->middleName }} {{ $user->lastName }}</td>
                        <td>{{ $user->address }}</td>
                        <td>{{ $user->gender }}</td>
                        <td>{{ $user->age }}</td>
                        <td>{{ $user->contact_number }}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('superadmin.user.edit', ['id' => $user->id]) }}" class="btn btn-success btn-sm">Edit</a>
                                <!-- Add other action buttons here, e.g., delete -->
                                <form action="{{ route('superadmin.user.archive', ['id' => $user->id]) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to archive this user?')">Archive</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

@endsection
