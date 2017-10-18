@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$thread->title}}</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                            <div class="body">{{$thread->body}}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    @foreach($thread->replies as $reply)
                        <div class="panel-heading">
                            <a href="/user/{{$reply->owner->id}}">
                                {{$reply->owner->name}}
                            </a>
                            said {{$reply->created_at->diffforHumans()}}
                        </div>
                        <div class="panel-body">
                            <div class="replies">{{$reply->body}}</div>
                            <hr>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
