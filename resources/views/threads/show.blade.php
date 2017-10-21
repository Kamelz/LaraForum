@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    
                    <div class="panel-heading">
                        <a href="#"> {{$thread->owner->name}} </a> Posted:
                        {{$thread->title}}
                    </div>

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
        @foreach($thread->replies as $reply)
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    
                        @include('threads.reply')
                  
                </div>
            </div>
        </div>
         @endforeach
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                  @if(auth::check())
                    <form method="POST" action="{{$thread->path().'/replies'}}">
                        <div class="form-group">
                           {{ csrf_field() }}
                            <textarea name="body" id="body" class="form-control" placeholder="Add a reply" rows="5"></textarea>
                            <input type="submit" class="btn" value="Post"/>
                        </div>
                    </form>
                  @else
                  <p class="text-center"> Please <a href="{{route('login')}}">sign in </a> to participate in this discussion.</p>
                  @endif

            </div>
        </div>
    </div>
@endsection
