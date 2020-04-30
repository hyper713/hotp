@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card text-white bg-dark">
                    <div class="card-header">Create Group</div>
                    <div class="card-body">
                        {!! Form::open(['route' => 'groups.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                            <div class="form-group">
                                <div class="col-8">
                                    {{Form::label('name', "Group Name")}}
                                    {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => "Enter Name",'required'])}}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-8">
                                    {{Form::label('link', "Goup Link")}}
                                    {{Form::text('link', '', ['class' => 'form-control', 'placeholder' => "Enter Link",'required'])}}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-5">
                                    {{Form::label('provider', 'Choose Provider')}}
                                        <select name="provider" class="form-control">
                                            @foreach($providers as $elmt)
                                            <option value="{{$elmt->id_provider}}">{{$elmt->name}}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-5">
                                    {{Form::label('category', 'Choose Category')}}
                                        <select name="category" class="form-control">
                                            @foreach($categories as $elmt)
                                            <option value="{{$elmt->id_category}}">{{$elmt->name}}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-12">
                                    {{Form::submit('Submit', ['class'=>'btn btn-light'])}}
                                    <a href="{{route('groups.index')}}"><button type="button" class="btn btn-success float-right" >Back</button></a>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection