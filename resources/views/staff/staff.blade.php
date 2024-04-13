@extends('back.layout.cashier-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title here')

@section('content')
<style>
    /* Additional styling */
    .form-group {
        margin-bottom: 20px; /* Add some spacing between form groups */
    }
    .custom-bg-color {
        background-color: #BC7FCD;
        font-size: 12px;
    }
</style>
<div class="container p-3 my-3 custom-bg-color text-white">Pending Appointments</div>
@if(count($pendingAppointments) > 0)
<div class="table-responsive"> <!-- Add table-responsive class here -->
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Pet Name</th>
                <th>Breed</th>
                <th>Address</th>
                <th>Contact Number</th>
                <th>Description</th>
                <th>Appointment Date</th>
                <th>Reservation Slot</th>
                <th>Service Type</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pendingAppointments as $appointment)
                <tr>
                    <td>{{ $appointment->first_name }} {{ $appointment->last_name }}</td>
                    <td>{{ $appointment->pet_name }}</td>
                    <td>{{ $appointment->breed }}</td>
                    <td>{{ $appointment->user->address }}</td>
                    <td>{{ $appointment->user->contact_number }}</td> <!-- Display the contact number -->
                    <td>{{ $appointment->description }}</td>
                    <td>{{ $appointment->appointment_date }}</td>
                    <td>{{ $appointment->appointment_slot }}</td>
                    <td>{{ $appointment->service_type }}</td>
                    <td>
                        <form method="POST" action="{{ route('accept.appointment', $appointment) }}">
                            @csrf
                            <button type="submit" class="btn btn-success">Accept Appointment</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@else
<p>No pending appointments found.</p>
@endif
</div>
</div>
</div>

<!-- Add any additional scripts or footer content here -->
@endsection
