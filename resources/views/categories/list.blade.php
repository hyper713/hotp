@extends('layouts.auth')

@section('content')
    <div class="container">
        <a href="{{route('categories.create')}}"><button type="button" class="btn btn btn-success" style="margin-bottom: 10px;">Add Category</button></a>
        <div class="card text-white bg-dark">
            <div class="card-header">Categories</div>
            <div class="card-body">
                @if(count($categories)>0)
                <table class="table table-hover table-dark">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Created at</th>
                            <th scope="col">Updated at</th>
                            <th scope="col">Created by</th>
                            <th scope="col">Option</th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <th scope="row">{{$category->cat_name}}</th>
                                    <td>{{$category->created_at}}</td>
                                    <td>{{$category->updated_at}}</td>
                                    <td>{{$category->admn_name}}</td>
                                    <td>
                                        <a href="{{route('categories.show',$category->id_category)}}"><button type="button" class="btn btn-sm btn-light">Show Products</button></a>
                                        <a href="{{route('categories.edit',$category->id_category)}}"><button type="button" class="btn btn-sm btn-warning">Edit</button></a>
                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#Modal{{$category->id_category}}">Delete</button>

                                    <div class="modal fade" id="Modal{{$category->id_category}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title text-dark" id="ModalLabel{{$category->id_category}}">Delete Category <strong>{{$category->cat_name}}</strong></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body text-dark">
                                                        are you sure to delete this record?
                                                    </div>
                                                    <div class="modal-footer">
                                                        {!! Form::open(['route' => ['categories.destroy', $category->id_category], 'method' => 'delete', 'enctype' => 'multipart/form-data']) !!}
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
                            <p align="center">No Categories found</p>
                        @endif 
                    </tbody>
                </table>
            </div>
        </div>
        <br>
        <div class="d-flex justify-content-center">     
            @if(count($categories)>0)
                {{$categories->links()}}
            @endif
        </div>
    </div>
@endsection