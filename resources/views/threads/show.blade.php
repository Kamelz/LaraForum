@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    
                    <div class="panel-heading">
                        <div class="level">
                            <span class="flex">
                                
                        <a href="/profile/{{$thread->owner->name}}"> {{$thread->owner->name}} </a> Posted:
                        {{$thread->title}}
                            </span>
                            @can('update',$thread)
                                <form action="{{$thread->path()}}" method="POST">
                                    {{csrf_field()}}
                                    {{method_field('DELETE')}}
                                    <button class="btn btn-link" type="submit">Delete thread</button>
                                </form>
                            @endcan
                        </div>
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
                @foreach($replies as $reply)
                    <div class="panel panel-default">
                        @include('threads.reply')
            
                    </div>
                @endforeach
                {{$replies->links()}}
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
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <p>
                            This thread was publish at {{ $thread->created_at->diffForHumans() }} by <a href="#">{{$thread->owner->name}}</a>
                            , and it has {{ $thread->replies_count}} {{str_plural("comment",$thread->replies_count)}}.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
