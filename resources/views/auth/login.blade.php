<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="{{ asset('img/logo_icon.ico') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <br>
                <div class="card text-white bg-dark" style="margin-top: 100px;">
                    <div class="card-body">
                        <img src="{{ asset('img/logo_light.png') }}" height="65">
                        <form method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}
                            <br>
                            @if ($message = Session::get('error'))
                                <div class="alert alert-light" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @endif
                            <div class="form-group">
                                <label>Email address</label>
                                <input name="email" type="email" class="form-control" placeholder="Enter email" value="{{ old('email') }}">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input name="password" type="password" class="form-control" placeholder="Password">
                            </div>
                            <div class="form-check">
                                <input name="remember" type="checkbox" class="form-check-input" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label">Remember me</label>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                            <br>
                        <a class="btn btn-link " href="{{route('reset')}}">{{ __('Forgot Your Password?') }}</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>