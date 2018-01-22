<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $threads = factory('App\Thread',10)->create();
        
        $threads->each(function($thread){factory('App\Reply',3)->create(['thread_id'=> $thread->id]);});
        
        // $this->call(UsersTableSeeder::class);
    }
}
