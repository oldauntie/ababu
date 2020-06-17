@component('mail::message')
# Join {{$clinic->name}}

You have received an invitation to join a clinic as a veterinarian on Ababu, the free veterinary clinical record software.
Just login to the platform and click the button / link belove.

@component('mail::button', ['url' => ''])
Join
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
