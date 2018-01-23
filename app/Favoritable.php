<?php

namespace App;


trait Favoritable{

    public function owner(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function favorites(){
        return $this->morphMany(Favorite::class,'favorited');
    }
    public function favorited(){
        
        return !! $this->favorites->where('user_id',auth()->id())->count();
    }

    public function favorite()
    {
            if(! $this->favorites()->where(['user_id'=>auth()->id()])->exists()){
            $this->favorites()->create([
                'user_id'=>auth()->id(),
            ]);
        }
    }
    public function getFavoritesCountAttribute(){
        
        return $this->favorites->count();
    }

}