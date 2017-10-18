@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$user->name}}</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{--<div class="threads">{{$user->threadsCount}}</div> TODO--}}
                        {{--<div class="replies">{{$user->repliesCount}}</div> TODO--}}
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Threads</div>

                    <div class="panel-body">
                        @foreach($user->threads as $thread)
                            <div class="panel-heading">{{$thread->title}}</div>
                            <div class="panel-body">
                                <div class="replies">{{$thread->body}}</div>
                                <hr>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
