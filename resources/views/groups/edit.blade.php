@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card text-white bg-dark">
                    <div class="card-header">Edit Group</div>
                    <div class="card-body">
                        {!! Form::open(['route' => ['groups.update', $group->id_group], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}
                            <div class="form-group">
                                <div class="col-8">
                                    {{Form::label('name', "Group Name")}}
                                    {{Form::text('name', $group->name, ['class' => 'form-control', 'placeholder' => "Enter Name",'required'])}}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-8">
                                    {{Form::label('link', "Group Link")}}
                                    {{Form::text('link', $group->link, ['class' => 'form-control', 'placeholder' => "Enter Link",'required'])}}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-5">
                                    {{Form::label('provider', 'Provider')}}
                                    <select name="provider" class="form-control" >
                                        @foreach($providers as $elmt)
                                            @if($elmt->id_provider == $group->provider_id)
                                                <option value="{{$elmt->id_provider}}" selected>{{$elmt->name}}</option>
                                            @else
                                                <option value="{{$elmt->id_provider}}">{{$elmt->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-5">
                                    {{Form::label('category', 'Category')}}
                                    <select name="category" class="form-control" >
                                        @foreach($categories as $elmt)
                                            @if($elmt->id_category == $group->category_id)
                                                <option value="{{$elmt->id_category}}" selected>{{$elmt->name}}</option>
                                            @else
                                                <option value="{{$elmt->id_category}}">{{$elmt->name}}</option>
                                            @endif
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