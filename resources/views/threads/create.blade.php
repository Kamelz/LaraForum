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
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" placeholder="Title" name="title"/>
                                <label for="body">Body</label>
                                <textarea id="body" name="body" id="body" class="form-control" placeholder="Add a reply" rows="5"></textarea>
                                <input type="submit" class="btn" value="Post"/>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
