<?php

namespace App;

use App\Favorite;
use App\Favoritable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use Favoritable;
    
    protected $guarded = [];
    protected $with = ['owner','favorites'];
    

}
