@component('mail::message')
Hello {{$data['name']}}
# Your request for verifing the email has been approuved

Use the code below in order to continue the authentication

@component('mail::panel')
{{$data['code']}}
@endcomponent

Thanks,<br>
<img src="{{ asset('img/logo_dark.png') }}">

@endcomponent
