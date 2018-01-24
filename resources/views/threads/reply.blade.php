<div class="panel-heading">
    <div class ="level">
        <h5 class="flex">
            <a href="/profile/{{$reply->owner->name}}">
                {{$reply->owner->name}}
            </a>
            said {{$reply->created_at->diffforHumans()}}
        </h5>
        <div>
            <form method="POST" action="/replies/{{$reply->id}}/favorites">
                <button type="submit" {{$reply->favorited()? "disabled":""}} class="btn btn-default">
                    {{$reply->favorites_count}} {{str_plural('Favorite',$reply->favorites_count)}}
                </button>
                {{csrf_field()}}
            </form>
        </div>
    </div>
</div>
<div class="panel-body">
    <div class="replies">{{$reply->body}}</div>
    <hr>
</div>