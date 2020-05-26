@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="card text-white bg-dark">
            <div class="card-header">Users</div>
            <div class="card-body">
                @if(count($users)>0)
                <table class="table table-hover table-dark">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">email</th>
                            <th scope="col">Eamil verified</th>
                            <th scope="col">Created at</th>
                            <th scope="col">Updated at</th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <th scope="row">{{$user->name}}</th>
                                    <td>{{$user->email}}</td>
                                    <td>
                                        @if (empty($user->email_verified_at))
                                            No
                                        @else
                                            Yes
                                        @endif
                                    </td>
                                    <td>{{$user->created_at}}</td>
                                    <td>{{$user->updated_at}}</td>
                                </tr>
                            @endforeach
                        @else
                            <p align="center">No users found</p>
                        @endif 
                    </tbody>
                </table>
            </div>
        </div>
        <br>
        <div class="d-flex justify-content-center">     
            @if(count($users)>0)
                {{$users->links()}}
            @endif
        </div>
    </div>
@endsection