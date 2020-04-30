@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="card text-white bg-dark">
            <div class="card-header">FeedBacks</div>
            <div class="card-body">
                @if(count($feedbacks)>0)
                    @foreach($feedbacks as $feedback)
                        <div class="card text-dark">
                            <div class="card-header">
                                <h4>Subject: {{$feedback->subject}}</h4>
                            </div>
                            <div class="card-body">
                                <blockquote class="blockquote mb-0">
                                <p>{{$feedback->text}}</p>
                                <footer class="blockquote-footer">Posted By: <cite title="Source Title">{{$feedback->name}} At {{$feedback->created_at}}</cite></footer>
                                </blockquote>
                            </div>
                        </div>
                        <br>
                    @endforeach
                @else
                    <p align="center">No feedbacks found</p>
                @endif 
            </div>
        </div>
        <br>
        <div class="d-flex justify-content-center">     
            @if(count($feedbacks)>0)
                {{$feedbacks->links()}}
            @endif
        </div>
    </div>
    @endsection