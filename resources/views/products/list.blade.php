@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="card text-white bg-dark">
            <div class="card-header">
                <h4 class="panel-title">Search for Products</h4> 
            </div>
            <div class="card-body">
                {!! Form::open(['action' => 'web\ProductsController@search','class' => 'form-inline', 'method' => 'GET', 'enctype' => 'multipart/form-data']) !!}
                <div class="form-group">
                    <label for="category" style="margin-right: 10px;"> Category: </label>
                    <select name="category" class="form-control" id="clss">
                        @if (isset($input_category))
                            @foreach($categories as $elmt)
                                @if($elmt->id_category == $input_category)
                                    <option value="{{$elmt->id_category}}" selected>{{$elmt->name}}</option>
                                @else
                                    <option value="{{$elmt->id_category}}">{{$elmt->name}}</option>
                                @endif
                            @endforeach 
                        @else      
                            @foreach($categories as $category)
                                <option value="{{$category->id_category}}">{{$category->name}}</option>
                            @endforeach
                        @endif                 
                    </select>
                </div>
                <div class="form-group" style="margin-left: 20px;">
                    <label for="provider" style="margin-right: 10px;"> Provider: </label>
                    <select name="provider" class="form-control" id="clss">                    
                        @if (isset($input_provider))
                            @foreach($providers as $elmt)
                                @if($elmt->id_provider == $input_provider)
                                    <option value="{{$elmt->id_provider}}" selected>{{$elmt->name}}</option>
                                @else
                                    <option value="{{$elmt->id_provider}}">{{$elmt->name}}</option>
                                @endif
                            @endforeach 
                        @else      
                            @foreach($providers as $provider)
                                <option value="{{$provider->id_provider}}">{{$provider->name}}</option>
                            @endforeach
                        @endif   
                    </select>
                </div>
            {{Form::submit('Submit', ['class'=>'btn btn-primary', 'style'=>'margin-left: 30px;'])}}
            {!! Form::close() !!}
            </div>
        </div>
        @if (isset($products))
            <br>
            <div class="row">
                @if(count($products)>0)
                    @foreach ($products as $product)
                        <div class="col-md-3">
                            <div class="card mb-4 shadow-sm">
                                <img class="card-img-top" src="{{$product->image}}" alt="Card image cap">
                                <div class="card-body">
                                    <h3 class="card-title">{{$product->name}}</h3>
                                    <h5 class="card-title">{{$product->price}} $</h5>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a href="{{$product->link}}"><button type="button" class="btn btn-sm btn-outline-dark">View</button></a>
                                        </div>
                                        @if ($product->best==1)
                                            <small s="text-muted">Best</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>No Products found</p>
                @endif
            </div>
        @endif
    </div>
@endsection