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