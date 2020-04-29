@extends('layouts.auth')

@section('content')
    <div class="container">
        <a href="{{route('admins.create')}}"><button type="button" class="btn btn btn-success" style="margin-bottom: 10px;">Add Admin</button></a>
        <div class="card text-white bg-dark">
            <div class="card-header">Admins</div>
            <div class="card-body">
                @if(count($admins)>0)
                <table class="table table-hover table-dark">
                    <thead>
                        <tr>           
                            <th scope="col">name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Email verified</th>
                            <th scope="col">State</th>
                            <th scope="col">Created at</th>
                            <th scope="col">Updated at</th>
                            <th scope="col">Option</th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach($admins as $admin)
                                <tr>
                                    <th scope="row">{{$admin->name}}</th>
                                    <td>{{$admin->email}}</td>
                                    <td>
                                        @if (empty($admin->email_verified_at))
                                            No
                                        @else
                                            Yes
                                        @endif
                                    </td>
                                    <td>
                                        @if ($admin->active == 0)
                                            Not Activated
                                        @else
                                            Activated
                                        @endif
                                    </td>
                                    <td>{{$admin->created_at}}</td>
                                    <td>{{$admin->updated_at}}</td>
                                    <td>
                                        @if ($admin->active == 1)
                                            <a href="{{route('admins.activate',$admin->id)}}"><button type="button" class="btn btn-sm btn-secondary">Deactive</button></a>
                                        @else
                                            <a href="{{route('admins.activate',$admin->id)}}"><button type="button" class="btn btn-sm btn-success">Activate</button></a>
                                        @endif
                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#Modal{{$admin->id}}">Delete</button>

                                    <div class="modal fade" id="Modal{{$admin->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title text-dark" id="ModalLabel{{$admin->id}}">Delete admin <strong>{{$admin->name}}</strong></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body text-dark">
                                                        are you sure to delete this record?
                                                    </div>
                                                    <div class="modal-footer">
                                                        {!! Form::open(['route' => ['admins.destroy', $admin->id], 'method' => 'delete', 'enctype' => 'multipart/form-data']) !!}
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
                            <p align="center">No admins found</p>
                        @endif 
                    </tbody>
                </table>
            </div>
        </div>
        <br>
        <div class="d-flex justify-content-center">     
            @if(count($admins)>0)
                {{$admins->links()}}
            @endif
        </div>
    </div>
@endsection