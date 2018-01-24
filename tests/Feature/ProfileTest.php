<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProfileTest extends TestCase
{
    use DatabaseMigrations;


    public function setUp()
    {
        parent::setUp();

    }

    /** @test*/
    public function a_user_has_a_profile()
    {
        $user = create('App\User');
        $this->get("/profile/".$user->name)
        ->assertSee($user->name);
    }

    /** @test*/
    public function profiles_has_all_threads_created_by_the_user()
    {
        $user = create('App\User');
        $thread = create('App\Thread',['user_id'=>$user->id]);

        $this->get("/profile/".$user->name)
        ->assertSee($thread->title);
    }


}
