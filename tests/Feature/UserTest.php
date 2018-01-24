<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    /** @test*/
    public function it_can_see_users_threds(){
        $user=create('App\User');
        $thread=create('App\Thread',['user_id'=>$user->id]);

        $this->get('/user/'.$user->name)
            ->assertSee($thread->title);

    }

}
