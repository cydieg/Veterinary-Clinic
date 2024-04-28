@component('mail::message')
# Welcome to Our Application

Hi {{ $user->firstName }},

Thank you for registering with us. Please click the button below to verify your account:

@component('mail::button', ['url' => $verificationUrl])
Verify Account
@endcomponent

Regards,<br>
Dr. Wendell Cabrera
@endcomponent
