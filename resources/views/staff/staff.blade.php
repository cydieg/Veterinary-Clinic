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
    @foreach($pendingAppointments->groupBy('service_type') as $serviceType => $appointments)
        <div class="table-responsive"> <!-- Add table-responsive class here -->
            <h3>{{ $serviceType }}</h3>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Pet Name</th>
                        <th>Breed</th>
                        <th>Address</th>
                        <th>Contact Number</th>
                        <th>Appointment Date</th>
                        <th>Reservation Slot</th>
                        @if($serviceType == 'Pet Hotel')
                            <th>Check Out Date</th>
                            <th>Size</th>
                            <th>Price</th>
                        @endif
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->first_name }} {{ $appointment->last_name }}</td>
                            <td>{{ $appointment->pet_name }}</td>
                            <td>{{ $appointment->breed }}</td>
                            <td>{{ $appointment->user->address }}</td>
                            <td>{{ $appointment->user->contact_number }}</td> <!-- Display the contact number -->
                            <td>{{ $appointment->appointment_date }}</td>
                            <td>{{ $appointment->appointment_slot }}</td>
                            @if($serviceType == 'Pet Hotel' && $appointment->petHotel)
                                <td>{{ $appointment->petHotel->check_out_date }}</td>
                                <td>{{ $appointment->petHotel->size }}</td>
                                <td>{{ $appointment->petHotel->price }}</td>
                            @elseif($serviceType == 'Pet Hotel' && !$appointment->petHotel)
                                <td colspan="3">No Pet Hotel information available</td>
                            @endif
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
    @endforeach
@else
    <p>No pending appointments found.</p>
@endif
@endsection
