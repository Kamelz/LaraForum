<?php

namespace App\Filters;

use App\User;


class ThreadFilters extends Filters{
    
    protected $filters = ['by','popular'];

    public function by($username){

        $user = User::where('name',$username)->firstOrFail();

        $this->query->where('user_id',$user->id);
    }
    
    public function popular(){
        $this->query->getQuery()->orders = []; 
        $this->query->orderBy('replies_count','desc');
    }

}