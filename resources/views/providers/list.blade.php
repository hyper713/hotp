@extends('layouts.auth')

@section('content')
    <div class="container">
        <a href="{{route('providers.create')}}"><button type="button" class="btn btn btn-success" style="margin-bottom: 10px;">Add Provider</button></a>
        <div class="card text-white bg-dark">
            <div class="card-header">Providers</div>
            <div class="card-body">
                @if(count($providers)>0)
                <table class="table table-hover table-dark">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Link</th>
                            <th scope="col">Created at</th>
                            <th scope="col">Updated at</th>
                            <th scope="col">Created by</th>
                            <th scope="col">Option</th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach($providers as $provider)
                                <tr>
                                    <th scope="row">{{$provider->prov_name}}</th>
                                    <td>{{$provider->link}}</td>
                                    <td>{{$provider->created_at}}</td>
                                    <td>{{$provider->updated_at}}</td>
                                    <td>{{$provider->admn_name}}</td>
                                    <td>
                                        <a href="{{route('providers.show',$provider->id_provider)}}"><button type="button" class="btn btn-sm btn-light">Show Products</button></a>
                                        <a href="{{route('providers.edit',$provider->id_provider)}}"><button type="button" class="btn btn-sm btn-warning">Edit</button></a>
                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#Modal{{$provider->id_provider}}">Delete</button>

                                    <div class="modal fade" id="Modal{{$provider->id_provider}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title text-dark" id="ModalLabel{{$provider->id_provider}}">Delete provider <strong>{{$provider->prov_name}}</strong></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body text-dark">
                                                        are you sure to delete this record?
                                                    </div>
                                                    <div class="modal-footer">
                                                        {!! Form::open(['route' => ['providers.destroy', $provider->id_provider], 'method' => 'delete', 'enctype' => 'multipart/form-data']) !!}
                                                        <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                                                        {{Form::submit('Confirm', ['class'=>'btn btn-danger'])}}
                                                        {!! Form::close() !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>    
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <p align="center">No Providers found</p>
                        @endif 
                    </tbody>
                </table>
            </div>
        </div>
        <br>
        <div class="d-flex justify-content-center">     
            @if(count($providers)>0)
                {{$providers->links()}}
            @endif
        </div>
    </div>
@endsection