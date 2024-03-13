@extends('back.layout.cashier-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title here')

@section('content')

<div>
    <h2> Staff Dashboard </h2>
</div>
<div class="main-container">
    <div class="pd-ltr-20">
        <div class="card-box pd-20 height-100-p mb-30">
            <div class="row align-items-center">
                <div class="card-body">
                    <p>Welcome, {{ auth()->user()->name }}!</p>
                    <!-- Add more content as needed -->

                    <h2>Pending Appointments</h2>
                    @if(count($pendingAppointments) > 0)
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pendingAppointments as $appointment)
                                <tr>
                                    <td>{{ $appointment->first_name }} {{ $appointment->last_name }}</td>
                                    <td>{{ $appointment->appointment_date }}</td>
                                    <td>{{ $appointment->appointment_time }}</td>
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
                    @else
                    <p>No pending appointments found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add any additional scripts or footer content here -->
@endsection
