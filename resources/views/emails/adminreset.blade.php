@component('mail::message')
Hello {{$data['name']}}
# Your request for reseting the password has been approuved

Use the password below in order to authenticate

@component('mail::panel')
{{$data['password']}}
@endcomponent

Thanks,<br>
<img src="{{ asset('img/logo_dark.png') }}">

@endcomponent
