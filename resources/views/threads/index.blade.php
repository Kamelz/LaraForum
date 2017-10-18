@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Forum threads</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        @foreach($threads as $thread)
                            <article>
                                <h4>
                                    <a href="{{$thread->path()}}">
                                        {{$thread->title}}
                                    </a>
                                </h4>
                            </article>
                            <div class="body">{{$thread->body}}</div>
                                <hr>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
