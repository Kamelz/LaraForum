@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create a forum thread</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" action="/threads">
                            <div class="form-group">
                            {{ csrf_field() }}
                                <label for="channel_id">Channels</label>
                                <select class="form-control" name="channel_id" id="channel_id" required>
                                <option value=""> Choose one</option>
                                   @foreach($channels as $channel)
                                        <option value="{{$channel->id}}" {{ old('channel_id') == $channel->id? 'selected':''}} >{{$channel->name}}</option>
                                   @endforeach
                                </select>
                            </div>
                            <div class="form-group">    
                                <label for="title">Title</label>
                                <input type="text" required class="form-control" id="title" placeholder="Title" value="{{old('title')}}" name="title"/>
                            </div>
                            <div class="form-group">
                                <label for="body">Body</label>
                                <textarea id="body" required name="body" id="body" class="form-control" placeholder="Add a reply" rows="5">{{old('body')}}</textarea>
                             </div>
                                <input type="submit" class="btn" value="Post"/>
                            </div>
                        </form>
                        @if(count($errors))
                            @foreach($errors->all() as $error)
                                <ul class="alert alert-danger">
                                    <li>{{$error}}</li>
                                </ul>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
