@component('mail::message')
# Welcome to Our Application

Hi {{ $user->firstName }},

Thank you for registering with us.

Regards,<br>
<p>Dr. Wendell Cabrera</p>
@endcomponent
