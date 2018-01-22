<?php
namespace Tests\Feature;

use Psy\Exception\ErrorException;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class FavoriteTest extends TestCase
{
    use DatabaseMigrations;

    /** @test*/
    public function guest_cannot_favorite_a_reply(){
        $this->withExceptionHandling()
            ->post('replies/1/favorites')
            ->assertRedirect('login');
    }

    /** @test*/
    public function an_authenticated_user_can_favorite_a_reply(){
        $this->SignIn();
        $reply = create('App\Reply');
        $this->post('replies/'.$reply->id.'/favorites');
        $this->assertCount(1,$reply->favorites);
    }
    /** @test*/
    public function a_user_cannot_favor_reply_multiple_times(){

        $this->SignIn();
        $reply = create('App\Reply');
        try {
        $this->post('replies/'.$reply->id.'/favorites');
            $this->post('replies/' . $reply->id . '/favorites');
        }catch (\Exception $e){
            $this->fail("error");
        };
        $this->assertCount(1,$reply->favorites);

    }

}