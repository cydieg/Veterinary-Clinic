@extends('back.layout.ecom-layout')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Make an Appointment')

@section('content')
<div class="col-md-7 col-lg-6 col-xl-5 mx-auto">
    <div class="card">
        <div class="card-body">
            <h2 class="text-center mb-4">Make an Appointment</h2>

            <!-- Display success or error message -->
            @if(session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                    @if(session('status') == 'pending')
                        Please wait for a notification in your email.
                    @endif
                </div>
            @elseif(session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('appointments.store') }}" method="post" class="bg-light p-4 rounded">
                @csrf
                
                <div class="form-group">
                    <label for="appointment_date">Reservation Date:</label>
                    <input type="date" name="appointment_date" id="appointment_date" class="form-control" value="{{ $selectedDate }}" min="{{ $selectedDate }}" required>
                </div>

                <div class="form-group">
                    <label for="branch_id">Select Branch:</label>
                    <select name="branch_id" class="form-control" required>
                        @foreach($branches as $branch)
                            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="pet_name">Pet Name:</label>
                    <input type="text" name="pet_name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="animal_type">Animal Type:</label>
                    <select name="animal_type" class="form-control" required>
                        <option value="Dog">Dog</option>
                        <option value="Cat">Cat</option>
                        <option value="Bird">Bird</option>
                        <!-- Add more options as needed -->
                    </select>
                </div>

                <div class="form-group">
                    <label for="breed">Breed:</label>
                    <input type="text" name="breed" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea name="description" class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <label for="service_type">Service Type:</label>
                    <select name="service_type" class="form-control" required>
                        <option value="Pet Hotel">Pet Hotel</option>
                        <option value="Grooming">Grooming</option>
                    </select>
                </div>
                
                <button type="submit" class="btn btn-info btn-block">Request Reservation</button>
            </form>
        </div>
    </div>
</div>

<div class="col-md-5 col-lg-6 col-xl-4 mx-auto mt-4">
    <div class="card">
        <div class="card-body">
            <h3 class="text-center">Remaining Slots</h3>
            @foreach($futureAppointments as $date => $branchSlots)
                <div class="border-bottom mb-3">
                    <h5>{{ $date }}</h5>
                    <ul class="list-unstyled">
                        @foreach($branchSlots as $branchId => $remainingSlots)
                            <li>{{ $branches->find($branchId)->name }}: {{ $remainingSlots }}</li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
