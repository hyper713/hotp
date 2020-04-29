@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card text-white bg-dark">
                    <div class="card-header">Create Provider</div>
                    <div class="card-body">
                        {!! Form::open(['route' => 'admins.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                            <div class="form-group">
                                <div class="col-8">
                                    {{Form::label('name', "Admin Name")}}
                                    {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => "Enter Name",'required'])}}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-8">
                                    {{Form::label('email', "Admin Email")}}
                                    {{Form::email('email', '', ['class' => 'form-control', 'placeholder' => "Enter Email",'required'])}}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-11">
                                    {{Form::label('password', "Password")}}
                                    {{Form::text('password', '', ['class' => 'form-control', 'placeholder' => "The password is the first part of the Email (The part befor '@')",'disabled'])}}
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <div class="col-12">
                                    {{Form::submit('Submit', ['class'=>'btn btn-light'])}}
                                    <a href="{{route('admins.index')}}"><button type="button" class="btn btn-success float-right" >Back</button></a>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection