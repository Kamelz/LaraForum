<?php

namespace Tests\Feature;

use App\Thread;
use Tests\TestCase;
use App\Filters\ThreadFilters;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadTest extends TestCase
{
    use DatabaseMigrations;

    protected $thread;

    public function setUp()
    {
        parent::setUp();
        $this->thread=create('App\Thread');

    }

    /** @test*/
    public function a_user_can_browse_threads()
    {
        $response = $this->get('/threads')
                ->assertSee($this->thread->title);

    }

    /** @test*/
    function a_user_can_grap_a_single_thread(){


        $this->get($this->thread->path())
                ->assertSee($this->thread->title);
    }

    /** @test*/
    function a_user_can_read_a_replies_that_are_associated_with_a_thread(){

        $reply = create('App\Reply',['thread_id'=>$this->thread->id]);
                

        $this->get($this->thread->path())
                ->assertSee($reply->body);
    }
        /** @test*/
    public function a_user_can_filter_threads_by_username(){

        $this->SignIn(create('App\User',['name'=>'kamel']));
        $threadByKamel=create('App\Thread',['user_id'=>Auth::user()->id]);
        $threadNotByKamel=create('App\Thread');

        $this->get('threads?by=kamel')
            ->assertSee($threadByKamel->title)
            ->assertDontSee($threadNotByKamel->title);
    }
        /** @test*/
    public function a_user_can_filter_threads_according_to_a_channel(){

            $channel = create('App\Channel');
            
            $threadInChannel = create('App\Thread',['channel_id'=>$channel->id]);
            
            $threadNotInChannel = create('App\Thread');
            
            $this->get('/threads/'.$channel->slug)
                ->assertSee($threadInChannel->title)
                ->assertDontSee($threadNotInChannel->title);
    }
        /** @test*/
    public function a_user_can_filter_threads_according_to_its_popularity(){

            // given we have 3 threads
            // 1 with 2 replies , 3 replies and 0 replies

            $twoRepliesThread = create('App\Thread');
            create('App\Reply',['thread_id'=>$twoRepliesThread->id],2);

            $threeRepliesThread = create('App\Thread');
            create('App\Reply',['thread_id'=>$threeRepliesThread->id],3);
            
            $zeroRepliesThread = $this->thread;

            // when I filter by popularity
            $response = $this->getJson('threads?popular=1')->json();
            // then they should be returned from most replies to least
            $this->assertEquals([3,2,0],array_column($response,'replies_count'));
    }

}
