<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comments extends Model
{
    function client_pages(){
    	 return $this->belongsTo('App\client_pages');
    }
}
