@component('mail::message')
# Verify your email address

Thank you for registering an account on Quizly. We are glad to have you as a part of this community of learners. We value your support and we would like to help you make the most out of our platform! Enter the code below to verify your email address.

@component('mail::panel')
{{$code}}
@endcomponent

Also do not share the code above with anyone for securiity reasons.
Thanks,<br>
{{ config('app.name') }}
@endcomponent
