@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card" style="margin-top: 100px;">
                <div class="card-header">Verify Your Email Address</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('verify') }}">
                        {{ csrf_field() }}
                        @if ($message = Session::get('success'))
                            <div class="alert alert-dark" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif
                        @if ($message = Session::get('error'))
                            <div class="alert alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif
                        Before proceeding, please check your email for a verification code.
                        If you did not receive the email, <a href="{{route('send')}}">click here to request another</a>.
                        <div class="form-group">
                            <br>
                            <label>Enter Code</label>
                            <input name="code" type="text" class="form-control" placeholder="Enter Code">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection