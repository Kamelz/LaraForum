<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $guarded = [];
    
    public function owner(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function favorites(){
        return $this->hasMany('App\Favorite','reply_id');
    }

    public function setAsFavorite($favorite)
    {
        $this->favorites()->create($favorite);
    }
}
