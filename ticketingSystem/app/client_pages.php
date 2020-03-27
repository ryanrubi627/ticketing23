<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class client_pages extends Model
{
     function comments(){
    	 return $this->hasMany('App\comments');
    }
}
