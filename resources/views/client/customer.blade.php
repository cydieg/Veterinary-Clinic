@extends('back.layout.ecom-layout')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Make an Appointment')

@section('content')
<div class="col-md-7 col-lg-8 col-xl-9">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 col-lg-6">
                    <form action="{{ route('appointments.store') }}" method="post" class="bg-light p-4 rounded">
                        @csrf
                        <h2 class="text-center">Make an Appointment</h2>

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
                <div class="col-md-7 col-lg-8 col-xl-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <!-- Display Available Slots for Current Date -->
                                <div class="col-md-12 col-lg-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Available Slots for Current Date ({{ $selectedDate }})</h5>
                                            <ul class="list-group">
                                                <li class="list-group-item">
                                                    <span>{{ $selectedDate }}</span>
                                                    <span class="badge badge-primary badge-pill">{{ $currentDateRemainingSlots }} slots left</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                
                                <!-- Display Available Slots for Next 7 Days -->
                                <div class="col-md-12 col-lg-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Available Slots for Next 7 Days</h5>
                                            <ul class="list-group">
                                                @foreach($futureAppointments as $date => $slots)
                                                    <li class="list-group-item">
                                                        <span>{{ $date }}</span>
                                                        <span class="badge badge-primary badge-pill">{{ $slots }} slots left</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endsection
                
                @section('scripts')
                <script>
                    document.getElementById('appointment_date').addEventListener('change', function() {
                        var selectedDate = this.value; // Get the selected date
                        // Perform an action, such as fetching available slots for the selected date via AJAX
                        // You can make an AJAX request to your backend to fetch the available slots for the selected date and update the UI accordingly
                        // For simplicity, I'm just logging the selected date here
                        console.log(selectedDate);
                        // You can then update the UI with the available slots for the selected date
                    });
                </script>
                @endsection
