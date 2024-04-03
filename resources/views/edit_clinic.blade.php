<!-- resources/views/edit_clinic.blade.php -->

@extends('back.layout.main-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title here')
@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Branch</title>
    <style>
        /* ... (your existing styles) ... */
    </style>
</head>
<body>

    <div class="card-box mb-30">
        <div class="table-responsive">
            <h2 class="h4 pd-20">Edit Branch</h2>
            <div class="card-body">

                @if (Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif

                <!-- Check for error message -->
                @if (Session::has('error'))
                    <div class="alert alert-danger">
                        {{ Session::get('error') }}
                    </div>
                @endif

                @if(isset($branch))
                    <!-- Your edit form goes here -->
                    <form action="{{ route('branch.update', ['id' => $branch->id]) }}" method="post">
                        @csrf
                        @method('put')

                        <!-- Your form fields go here, pre-filled with clinic data -->
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" name="name" value="{{ $branch->name }}" required>
                        </div>

                        <div class="form-group">
                            <label for="location">Location:</label>
                            <input type="text" class="form-control" name="location" value="{{ $branch->location }}" required>
                        </div>

                        <div class="form-group">
                            <label for="contact">Contact Number:</label>
                            <input type="text" class="form-control" name="contact" value="{{ $branch->contact }}" required>
                        </div>

                        <div class="form-group">
                            <label for="status">Status:</label>
                            <select class="form-control" name="status" required>
                                <option value="Active" {{ $branch->status == 'Active' ? 'selected' : '' }}>Active</option>
                                <option value="Inactive" {{ $branch->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <!-- New field for branch selection -->
                        <div class="form-group">
                            <label for="branch">Branch:</label>
                            <select class="form-control" name="branch_id" required>
                                @foreach($branches as $branch)
                                    <option value="{{ $branch->id }}" {{ $branch->branch_id == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Update Branches</button>
                    </form>
                @else
                    <p>No branch data found.</p>
                @endif
            </div>
        </div>
    </div>

</body>
</html>

@endsection
