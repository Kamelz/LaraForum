<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Auth;
class CreateNewThreadsTest extends TestCase
{   
    use DatabaseMigrations;
    /** @test */
    public function an_authenticated_user_can_create_new_fourm_threads(){
          
          $this->SignIn();
          
          $thread = make('App\Thread');

          $response =$this->post('threads',$thread->toArray());
          
          $this->get($response->headers->get('location'))
                ->assertSee($thread->title)
                ->assertSee($thread->body);

    }


    /** @test */
    public function a_trhead_requires_a_title(){

        $this->publishThread(['title'=>null])
              ->assertSessionHasErrors('title');
    }
    /** @test */
    public function a_trhead_requires_a_body(){

        $this->publishThread(['body'=>null])
              ->assertSessionHasErrors('body');
    }

    /** @test */
    public function a_trhead_requires_a_valid_channel(){
        factory('App\Channel',2)->create();

        $this->publishThread(['channel_id'=>null])
              ->assertSessionHasErrors('channel_id');

        $this->publishThread(['channel_id'=>9999])
              ->assertSessionHasErrors('channel_id');
    }

    protected function publishThread($attributes=[]){
        $this->withExceptionHandling()->SignIn();
        $thread= make('App\Thread',$attributes);
        return $this->post('threads',$thread->toArray());
    }

    /** @test */
    public function guest_cannot_create_threads(){
        
        $this->withExceptionHandling();
        $this->get("/threads/create")    
        ->assertRedirect('/login');
        
        $this->post("/threads")    
        ->assertRedirect('/login');     
    }

        /** @test */
    public function unauthorized_users_cannot_delete_threads(){
            $this->withExceptionHandling();
            
            $thread = create('App\Thread');
            
            $this->delete($thread->path())->assertRedirect('/login');
            $this->SignIn();
            $this->delete($thread->path())->assertStatus(403);   
    }
        /** @test */

    public function authorized_users_can_delete_a_thread(){
            $this->withExceptionHandling();
            
            $this->SignIn();
            $thread = create('App\Thread',['user_id' => auth()->id()]);

            $reply = create('App\Reply',['thread_id'=>$thread->id]);    
            
            $response = $this->json('DELETE',$thread->path());

            $response->assertStatus(204);
            
            $this->assertDatabaseMissing("threads",["id"=>$thread->id]);
            $this->assertDatabaseMissing("replies",["id"=>$reply->id]);

    }

}
