@extends('back.layout.superadmin-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title here')
@section('content')

<div class="card-box mb-30">
    <div class="table-responsive">
        <h2 class="h4 pd-20">Edit Clinic</h2>

        <!-- Form for editing clinic data -->
        <form action="{{ route('clinic.update', $clinic->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $clinic->name }}">
            </div>

            <div class="form-group">
                <label for="location">Location:</label>
                <input type="text" class="form-control" id="location" name="location" value="{{ $clinic->location }}">
            </div>

            <div class="form-group">
                <label for="contact">Contact Number:</label>
                <input type="text" class="form-control" id="contact" name="contact" value="{{ $clinic->contact }}">
            </div>

            <div class="form-group">
                <label for="status">Status:</label>
                <input type="text" class="form-control" id="status" name="status" value="{{ $clinic->status }}">
            </div>

            <div class="form-group">
                <label for="doctor_name">Doctor Name:</label>
                <input type="text" class="form-control" id="doctor_name" name="doctor_name" value="{{ $clinic->doctor_name }}">
            </div>

            <button type="submit" class="btn btn-primary">Update Clinic</button>
        </form>
    </div>
</div>

@endsection
