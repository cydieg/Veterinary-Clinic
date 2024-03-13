

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accepted Appointments</title>
    <!-- Add your CSS links here -->
</head>
<body>
    <div class="container">
        <h1>Accepted Appointments</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($acceptedAppointments as $appointment)
                    <tr>
                        <td>{{ $appointment->id }}</td>
                        <td>{{ $appointment->user->firstName }} {{ $appointment->user->lastName }}</td>
                        <td>{{ $appointment->appointment_date }}</td>
                        <td>{{ $appointment->appointment_time }}</td>
                        <td>{{ $appointment->status }}</td>
                        <td>
                            @if($appointment->status === 'accepted')
                                <form method="POST" action="{{ route('complete.appointment', $appointment) }}">
                                    @csrf
                                    <button type="submit">Completed</button>
                                </form>
                                <form method="POST" action="{{ route('staff.cancel', $appointment->id) }}">
                                    @csrf
                                    @method('PUT') <!-- Using PUT method for updating -->
                                    <button type="submit">Cancel</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Add your JavaScript links here -->
</body>
</html>
