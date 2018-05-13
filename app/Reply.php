<?php

namespace App;

use App\Favoritable;
use App\Favorite;
use App\RecordsActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Reply extends Model
{
	
    use Favoritable,RecordsActivity;
    
    protected $guarded = [];
    protected $with = ['owner','favorites'];
    

}
