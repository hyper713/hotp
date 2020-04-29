@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card text-white bg-dark">
                    <div class="card-header">Edit Your Data</div>
                    <div class="card-body">
                        {!! Form::open(['route' => ['admins.update', $admin->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}
                            <div class="form-group">
                                <div class="col-10">
                                    {{Form::label('name', 'Name')}}
                                    {{Form::text('name', $admin->name, ['class' => 'form-control', 'placeholder' => 'Name'])}}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-10">
                                    {{Form::label('email', 'Email')}}
                                    {{Form::email('email', $admin->email, ['class' => 'form-control', 'placeholder' => 'Email'])}}
                                </div>
                            </div>
                            <br><br>
                            <div class="form-group">
                                <div class="col-10">
                                    {{Form::label('lbl', "Fill the Box's below in order to change password")}}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-10">
                                    {{Form::label('oldpass', 'Old password')}}
                                    {{Form::password('oldpassword', ['class' => 'form-control', 'placeholder' => 'Entre the old password'])}}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-10">
                                    {{Form::label('newpass', 'New Password')}}
                                    {{Form::password('password', ['class' => 'form-control', 'placeholder' => 'Entre the new password'])}}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-10">
                                    {{Form::label('confpass', 'Confirm Password')}}
                                    {{Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'confirm password'])}}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-12">
                                    {{Form::submit('Submit', ['class'=>'btn btn-light'])}}
                                    <a href="{{route('dashboard')}}"><button type="button" class="btn btn-success float-right" >Back</button></a>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection