@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="card text-white bg-dark">
        <div class="card-header">
            <h4 class="panel-title">List of Products from Provider: {{$group->name}}</h4>
        </div>
    </div>
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
                                    <small class="text-muted">Best</small>
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
    <div class="d-flex justify-content-center">
        @if(count($products)>0)
        {{$products->links()}}
        @endif
    </div>
</div>
@endsection