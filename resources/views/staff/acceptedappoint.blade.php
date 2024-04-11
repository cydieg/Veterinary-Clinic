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
            font-size: 20px;
        }
        .action-buttons button {
            margin-right: 5px; /* Add some spacing between buttons */
            font-size: 12px; /* Adjust button font size */
        }
    </style>
    <div class="container p-3 my-3 custom-bg-color text-white">Accepted Appointments</div>
    <table class="table mt-4 table-bordered table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Pet Name</th>
                <th>Breed</th>
                <th>Address</th>
                <th>Contact Number</th>
                <th>Description</th> 
                <th>Date</th>
                <th>Slot</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($acceptedAppointments as $appointment)
                <tr>
                    <td>{{ $appointment->user->firstName }} {{ $appointment->user->lastName }}</td>
                    <td>{{ $appointment->pet_name }}</td>
                    <td>{{ $appointment->breed }}</td>
                    <td>{{ $appointment->user->address }}</td>
                    <td>{{ $appointment->user->contact_number }}</td>
                    <td>{{ $appointment->description }}</td> <!-- Display contact number -->
                    <td>{{ $appointment->appointment_date }}</td>
                    <td>{{ $appointment->appointment_slot }}</td>
                    <td>{{ $appointment->status }}</td>
                    <td class="action-buttons">
                        @if($appointment->status === 'accepted')
                            <form method="POST" action="{{ route('complete.appointment', $appointment) }}">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Completed</button>
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#cancelModal{{$appointment->id}}">Cancel</button>
                                <!-- Modal -->
                                <div class="modal fade" id="cancelModal{{$appointment->id}}" tabindex="-1" role="dialog" aria-labelledby="cancelModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="cancelModalLabel">Cancel Appointment</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to cancel this appointment?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <form method="POST" action="{{ route('staff.cancel', $appointment->id) }}">
                                                    @csrf
                                                    @method('PUT') <!-- Using PUT method for updating -->
                                                    <button type="submit" class="btn btn-danger">Yes, Cancel</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <!-- Bootstrap JavaScript link -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
