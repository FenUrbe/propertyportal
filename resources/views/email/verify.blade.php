<x-mail::message>
# Hello!

Please click the button below to verify your email address.

<x-mail::button :url="$verificationUrl">
Verify Email Address
</x-mail::button>

If you did not create an account, no further action is required.

Regards,<br>
Penn Urbe<br>
IT Team, Bed & Go Inc.

<hr>

If you're having trouble clicking the "Verify Email Address" button, copy and paste the URL below into your web browser: <a href="{{ $verificationUrl }}">{{ $verificationUrl }}</a>
</x-mail::message>
