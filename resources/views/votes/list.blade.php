@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="card text-white bg-dark">
            <div class="card-header"><h3>Votes</h3></div>
            <div class="card-body">
                <div class="card-deck">
                    <div class="card text-dark">
                        <div class="card-header">
                            <h4>Most voted Ctegories</h4>
                        </div>
                        @if(count($votes_categories)>0)
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">Votes count</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($votes_categories as $vote)
                                    @foreach ($categories as $category)
                                        @if ($vote->category_id == $category->id_category)
                                            <tr>
                                                <th scope="row">{{$category->name}}</th>
                                                <td>{{$vote->number}}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <p align="center">No Votes found</p>
                        @endif     
                    </div>
                    <div class="card text-dark">
                        <div class="card-header">
                            <h4>Most active Users</h4>
                        </div>
                        @if(count($votes_users)>0)
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Votes count</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($votes_users as $vote)
                                    @foreach ($users as $user)
                                        @if ($vote->user_id == $user->id)
                                            <tr>
                                                <th scope="row">{{$user->name}}</th>
                                                <td>{{$vote->number}}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <p align="center">No Votes found</p>
                        @endif   
                    </div>
                </div>
            </div>
        </div>
        <br>
    </div>
@endsection