<?php

namespace App;

use App\Channel;
use App\RecordsActivity;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use RecordsActivity;

    protected $with = ['owner','channel'];
      /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('replyCount',function($builder){
            $builder->withCount('replies');
        });
        static::deleting(function($thread){
            $thread->replies()->delete();
        });
    }
    
    protected $guarded = [];

    public function replies(){

        return $this->hasMany(Reply::class);
    }

    public function scopeFilter($query,$filters){
        
        return $filters->apply($query);
    }

    public function channel(){

        return $this->belongsTo(Channel::class);
    }

    public function addReply($reply){

        return $this->replies()->create($reply);
    }


    public function owner(){

        return $this->belongsTo(User::class,'user_id');
    }

    public function path(){

        return "/threads/{$this->channel->slug}/{$this->id}";
    }
}
