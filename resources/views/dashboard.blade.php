@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3">
            <div class="card">
                <img class="card-img-top" src="{{ asset('img/box.png') }}" data-holder-rendered="true"  height="256">
                <div class="card-body">
                    <h3 class="card-text">Products: <strong>{{$var['products']}}</strong></h3>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <a href="{{route('products.index')}}"><button type="button" class="btn btn-sm btn-outline-secondary">View</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <img class="card-img-top" src="{{ asset('img/category.png') }}" data-holder-rendered="true"  height="256">
                <div class="card-body">
                    <h3 class="card-text">Categories: <strong>{{$var['categories']}}</strong></h3>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <a href="{{route('categories.index')}}"><button type="button" class="btn btn-sm btn-outline-secondary">View</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <img class="card-img-top" src="{{ asset('img/provider.png') }}" data-holder-rendered="true"  height="256">
                <div class="card-body">
                    <h3 class="card-text">Providers: <strong>{{$var['providers']}}</strong></h3>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <a href="{{route('providers.index')}}"><button type="button" class="btn btn-sm btn-outline-secondary">View</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <img class="card-img-top" src="{{ asset('img/group.png') }}" data-holder-rendered="true"  height="256">
                <div class="card-body">
                    <h3 class="card-text">Groups: <strong>{{$var['groups']}}</strong></h3>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <a href="{{route('groups.index')}}"><button type="button" class="btn btn-sm btn-outline-secondary">View</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-3">
            <div class="card">
                <img class="card-img-top" src="{{ asset('img/feedback.png') }}" data-holder-rendered="true"  height="256">
                <div class="card-body">
                    <h3 class="card-text">FeedBacks: <strong>{{$var['feedbacks']}}</strong></h3>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <a href="{{route('feedbacks.index')}}"><button type="button" class="btn btn-sm btn-outline-secondary">View</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <img class="card-img-top" src="{{ asset('img/vote.png') }}" data-holder-rendered="true"  height="256">
                <div class="card-body">
                    <h3 class="card-text">Votes: <strong>{{$var['votes']}}</strong></h3>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <a href=""><button type="button" class="btn btn-sm btn-outline-secondary">View</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <img class="card-img-top" src="{{ asset('img/user.png') }}" data-holder-rendered="true"  height="256">
                <div class="card-body">
                    <h3 class="card-text">Clients: <strong>{{$var['users']}}</strong></h3>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <a href=""><button type="button" class="btn btn-sm btn-outline-secondary">View</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <img class="card-img-top" src="{{ asset('img/admin.png') }}" data-holder-rendered="true"  height="256">
                <div class="card-body">
                    <h3 class="card-text">Admins: <strong>{{$var['admins']}}</strong></h3>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            @if (Auth::guard('admin-web')->user()->id == 1)
                                <a href="{{route('admins.index')}}"><button type="button" class="btn btn-sm btn-outline-secondary">View</button></a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
