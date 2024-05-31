<x-mail::message>
    <x-slot name="subject">Reset Your Password</x-slot>

    <p>You are receiving this email because we received a password reset request for your account.</p>
    <p>
        Click the following link to reset your password:
        <a href="{{ route('password.reset', ['token' => $token, 'email' => $email]) }}">Reset Password</a>
    </p>
    <p>If you didn't request a password reset, no further action is required.</p>
</x-mail::message>
