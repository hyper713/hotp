@extends('layouts.auth')

@section('content')
    <div class="container">
        <a href="{{route('groups.create')}}"><button type="button" class="btn btn btn-success" style="margin-bottom: 10px;">Add Group</button></a>
        <div class="card text-white bg-dark">
            <div class="card-header">groups</div>
            <div class="card-body">
                @if(count($groups)>0)
                <table class="table table-hover table-dark">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Link</th>
                            <th scope="col">Category</th>
                            <th scope="col">Provider</th>
                            <th scope="col">Updated at</th>
                            <th scope="col">Created by</th>
                            <th scope="col">Option</th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach($groups as $group)
                                <tr>
                                    <th scope="row">{{$group->grp_name}}</th>
                                    <td><a href="{{$group->grp_link}}" target="blank">Click to visit</a></td>
                                    <td>{{$group->cat_name}}</td>
                                    <td>{{$group->prov_name}}</td>
                                    <td>{{$group->updated_at}}</td>
                                    <td data-toggle="tooltip" data-placement="top" title="At {{$group->created_at}}">{{$group->admn_name}}</td>
                                    <td>
                                        <a href="{{route('groups.show',$group->id_group)}}"><button type="button" class="btn btn-sm btn-light">Show Products</button></a>
                                        <a href="{{route('groups.edit',$group->id_group)}}"><button type="button" class="btn btn-sm btn-warning">Edit</button></a>
                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#Modal{{$group->id_group}}">Delete</button>

                                    <div class="modal fade" id="Modal{{$group->id_group}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title text-dark" id="ModalLabel{{$group->id_group}}">Delete group <strong>{{$group->grp_name}}</strong></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body text-dark">
                                                        are you sure to delete this record?
                                                    </div>
                                                    <div class="modal-footer">
                                                        {!! Form::open(['route' => ['groups.destroy', $group->id_group], 'method' => 'delete', 'enctype' => 'multipart/form-data']) !!}
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
                            <p align="center">No groups found</p>
                        @endif 
                    </tbody>
                </table>
            </div>
        </div>
        <br>
        <div class="d-flex justify-content-center">     
            @if(count($groups)>0)
                {{$groups->links()}}
            @endif
        </div>
    </div>
@endsection