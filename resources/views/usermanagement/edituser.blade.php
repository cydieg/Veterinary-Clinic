@extends('back.layout.main-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title here')
@section('content')

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if(isset($user))
<!-- Your edit form goes here -->
<div class="card-box mb-30">
    <h2 class="h2 pd-20">Edit User</h2>
    <div class="table-responsive">
        <div class="card-body">
            <form action="{{ route('updateUser', ['id' => $user->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('post')

                <!-- Your form fields go here, pre-filled with user data -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" name="username" value="{{ $user->username }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" name="email" value="{{ $user->email }}" class="form-control" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password">Password (Leave blank to keep current):</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="firstName">First Name:</label>
                            <input type="text" name="firstName" value="{{ $user->firstName }}" class="form-control" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="lastName">Last Name:</label>
                            <input type="text" name="lastName" value="{{ $user->lastName }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="middleName">Middle Name:</label>
                            <input type="text" name="middleName" value="{{ $user->middleName }}" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="address">Address:</label>
                            <input type="text" name="address" value="{{ $user->address }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="gender">Gender:</label>
                            <select name="gender" class="form-control" required>
                                <option value="" disabled>Select Gender</option>
                                <option value="male" {{ $user->gender === 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ $user->gender === 'female' ? 'selected' : '' }}>Female</option>
                                <!-- Add more gender options if needed -->
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="age">Age:</label>
                            <input type="number" name="age" value="{{ $user->age }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="role">Role:</label>
                            <select name="role" class="form-control" required>
                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="client" {{ $user->role === 'client' ? 'selected' : '' }}>Client</option>
                                <option value="cashier" {{ $user->role === 'cashier' ? 'selected' : '' }}>Cashier</option>
                                <!-- Add more role options if needed -->
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <input type="submit" value="Update User" class="btn btn-primary btn-block">
                </div>
            </form>
        </div>
    </div>
</div>
@else
<p>No user data found.</p>
@endif

@endsection
