<?php

namespace App\Http\Controllers;

use App\Thread;
use App\Channel;
use Illuminate\Http\Request;
use App\Filters\ThreadFilters;
use Illuminate\Support\Facades\Auth;

class ThreadsController extends Controller
{

    public function __construct(){
        $this->middleware('auth')->except(['index','show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Channel $channel,ThreadFilters $filters)
    {
        $threads=$this->getThreads($channel,$filters);
        
        if(request()->wantsJson()){
            return $threads;
        }
        return view('threads.index')->with(['threads'=>$threads]);
    }


    public function getThreads($channel,$filters){
        
        $threads = Thread::latest()->filter($filters);
        
        if($channel->exists){
            $threads->where('channel_id',$channel->id);
        }
        return $threads->get();
                
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('threads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            "title" => "required",
            "body" => "required",
            "channel_id" => "required|exists:channels,id"
        ]);
        $thread =Thread::create([
            'title'=> request('title'),
            'body'=> request('body'),
            'user_id'=> Auth::user()->id,
            'channel_id'=> request('channel_id'),
        ]);
        return redirect($thread->path());
    }

    

    /**
     * Display the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function show($channelid,Thread $thread)
    {
        // return $thread->replies;
        return view('threads.show')->with([
            'thread'=>$thread,
            'replies'=>$thread->replies()->paginate(5)
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function edit(Thread $thread)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Thread $thread)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function destroy($channel ,Thread $thread)
    {
        $this->authorize('update',$thread);
        
        if($thread->user_id != Auth::user()->id){
          abort(403,"You don't have permission to do this !!.");
        }
        $thread->delete();
        if(request()->wantsJson()){
            return response([],204);
        }
        return redirect('/threads');
    }
}
