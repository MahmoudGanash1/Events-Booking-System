@component('mail::message')
# Email Verification

Hello 👋,

Thank you for registering with us!

Your One-Time Password (OTP) for email verification is:

@component('mail::panel')
**{{ $otp }}**
@endcomponent

This code will expire in 10 minutes.

If you didn’t request this, please ignore the email.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
