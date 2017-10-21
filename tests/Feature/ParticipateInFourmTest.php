<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ParticipateInFourm extends TestCase
{
    use DatabaseMigrations;
    /** @test*/
    public function an_unauthinticated_user_may_not_participate_in_forum_threads(){
        
        $this->withExceptionHandling()
            ->post('threads/et/1/replies',[])
            ->assertRedirect('/login');
    } 

   /** @test*/
    public function an_authinticated_user_may_participate_in_forum_threads(){

        $this->SignIn();

        $thread = create('App\Thread');

        $reply = make('App\Reply');

        $this->post($thread->path().'/replies',$reply->toArray());

        $this->get($thread->path())
                ->assertSee($reply->body);
    }
}
