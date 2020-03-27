<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\comments;

class comment_section extends Controller
{
    public function insert(Request $request){
    	$cmmt = new comments;
    	$cmmt->name = $request->name;
      $cmmt->comments = $request->comment;
      $cmmt->save();
    }

    public function display(){
      $wews = comments::all();
      return view('comment_page', ['wews'=>$wews]);
    }
}
