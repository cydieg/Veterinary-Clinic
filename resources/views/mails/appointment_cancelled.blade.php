<!DOCTYPE html>
<html>
<head>
    <title>Appointment Cancelled</title>
</head>
<body>
    <p>Dear {{ $appointment->user->first_name }},</p>
    
    <p>We regret to inform you that your appointment scheduled for {{ $appointment->appointment_date }} at {{ $appointment->appointment_time }} has been cancelled.</p>
    
    <p>If you have any questions or need to reschedule, please feel free to contact us.</p>
    
    <p>Thank you.</p>
</body>
</html>
