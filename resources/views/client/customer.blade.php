@extends('back.layout.ecom-layout')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Make an Appointment')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make an Appointment</title>
    <style>
        form {
            max-width: 400px;
            margin: auto;
        }
        button {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div>
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
                <label for="appointment_date">Appointment Date:</label>
                <input type="date" name="appointment_date" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="appointment_time">Appointment Time:</label>
                <select name="appointment_time" class="form-control" required>
                    <option value="08:00">8:00 AM - 9:00 AM</option>
                    <option value="09:00">9:00 AM - 10:00 AM</option>
                    <option value="10:00">10:00 AM - 11:00 AM</option>
                    <option value="11:00">11:00 AM - 12:00 PM</option>
                    <option value="13:00">1:00 PM - 2:00 PM</option>
                    <option value="15:00">3:00 PM - 4:00 PM</option>
                    <option value="17:00">5:00 PM - 6:00 PM</option>
                </select>
            </div>

            <div class="form-group">
                <label for="clinic_id">Select Clinic:</label>
                <select name="clinic_id" class="form-control" required>
                    @foreach($clinics as $clinic)
                        <option value="{{ $clinic->id }}">{{ $clinic->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-info btn-block">Request  Appointment</button>
        </form>
    </div>
</body>
</html>
@endsection
