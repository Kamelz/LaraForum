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
        $user=factory('App\User')->create();
        $thread=factory('App\Thread')->create(['user_id'=>$user->id]);

        $this->get('/user/'.$user->id)
            ->assertSee($thread->title);

    }

}
