@extends('back.layout.superadmin-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title here')
@section('content')

<div class="card-box mb-30">
    <div class="table-responsive">
        <h2 class="h4 pd-20">Edit Branch</h2>

        <!-- Form for editing branch data -->
        <form action="{{ route('branch.update', $branch->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $branch->name }}">
            </div>

            <div class="form-group">
                <label for="location">Location:</label>
                <input type="text" class="form-control" id="location" name="location" value="{{ $branch->location }}">
            </div>

            <div class="form-group">
                <label for="contact">Contact Number:</label>
                <input type="text" class="form-control" id="contact" name="contact" value="{{ $branch->contact }}">
            </div>

            <div class="form-group">
                <label for="status">Status:</label>
                <input type="text" class="form-control" id="status" name="status" value="{{ $branch->status }}">
            </div>

           

            <button type="submit" class="btn btn-primary">Update Branch</button>
        </form>
    </div>
</div>

@endsection
