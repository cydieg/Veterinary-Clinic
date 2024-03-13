<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Completed</title>
</head>

<body>
    <div>
        <h1>Appointment Completed</h1>
        <p>Dear {{ $appointment->user->name }},</p>
        <p>Your appointment scheduled for {{ $appointment->appointment_date }} at {{ $appointment->appointment_time }} has been completed successfully.</p>
        <p>Thank you for choosing our service.</p>
        <p>Best regards,</p>
        <p>Dr. Wendell Cabrera</p>
    </div>
</body>

</html>
