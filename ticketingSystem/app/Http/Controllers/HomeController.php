<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\client_pages;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function display(){
      $users = client_pages::all();
      return view('home', ['users'=>$users]);
    }


    public function insert(Request $request){
      $user = new client_pages;

      $user->name = $request->name;
      $user->title = $request->title;
      $user->description = $request->description;
      $user->importance = $request->importance;
      $user->date = $request->date;
      $user->status = $request->status;

      $user->save();

    }

    public function update(Request $request){
      
      $id = $request->id;
      $title = $request->title;
      $description = $request->description;
      $importance = $request->importance;

      client_pages::where('ticket_number', $id)
                    ->update(['title' => $title, 'description' => $description, 'importance' => $importance]);

    }

}
