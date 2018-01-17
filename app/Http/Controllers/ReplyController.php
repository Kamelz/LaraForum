<?php

namespace App\Http\Controllers;

use App\Reply;
use App\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
    }
    public function store($channelid, Thread $thread){

        $this->validate(request(),[
            "body" => "required",
        ]);

        $thread->addReply([

            'body' => request('body'),
            'user_id' => Auth::user()->id
        ]);
        return back();
    }

    public function favorite(Reply $reply){
        $this->validate(request(),[
            "reply" => "required",
        ]);

        $reply = Reply::findOrFail(request('reply'));
        $reply->setAsFavorite([
            'user_id' =>Auth::user()->id,
            'reply_id' => request('reply')
        ]);

        return back();
    }
}
