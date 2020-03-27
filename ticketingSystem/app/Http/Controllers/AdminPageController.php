<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\client_pages;
use App\admin_pages;
use App\inprogress_tickets;
use App\closed_tickets;
use App\logs;

class AdminPageController extends Controller
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
      return view('admin_page', ['users'=>$users]);
    }

    public function delete($id){
      client_pages::where('ticket_number', $id)->delete();
      return redirect('admin');
    }

    public function status_inprogress(Request $request){

      $user = new inprogress_tickets;

      $user->ticket_number = $request->ticket_id;
      $user->name = $request->name;
      $user->title = $request->title;
      $user->description = $request->description;
      $user->importance = $request->importance;
      $user->date = $request->date;
      $user->status = $request->status;

      $user->save();

      $id = $request->ticket_id;

      client_pages::where('ticket_number', $id)->delete();

      $user = new logs;

      $user->date = $request->date_logs;
      $user->Action = $request->accpt_logs;

      $user->save();
    }
    public function display_inprogress_ticket(){
      $inprogress_tickets = inprogress_tickets::all();
      return view('inprogress_list_ticket', ['inprogress_tickets'=>$inprogress_tickets]);
    }
    public function inprogress_to_closed(Request $request){
      $user = new closed_tickets;

      $user->ticket_number = $request->ticket_id;
      $user->name = $request->name;
      $user->title = $request->title;
      $user->description = $request->description;
      $user->importance = $request->importance;
      $user->date = $request->date;
      $user->status = $request->status;

      $user->save();

      $id = $request->ticket_id;

      inprogress_tickets::where('ticket_number', $id)->delete();

      $user = new logs;

      $user->date = $request->date_logs;
      $user->Action = $request->closed_logs;

      $user->save();
    }


    public function status_closed(Request $request){

      $user = new closed_tickets;

      $user->ticket_number = $request->ticket_id;
      $user->name = $request->name;
      $user->title = $request->title;
      $user->description = $request->description;
      $user->importance = $request->importance;
      $user->date = $request->date;
      $user->status = $request->status;

      $user->save();

      $id = $request->ticket_id;

      client_pages::where('ticket_number', $id)->delete();

      $user = new logs;

      $user->date = $request->date_logs;
      $user->Action = $request->closed_logs;

      $user->save();



      // $id = $request->ticket_id;
      // $status = $request->resolved;

      // client_pages::where('ticket_number', $id)
      //               ->update(['status' => $status]);

    }
    public function display_closed_ticket(){
      $closed_tickets = closed_tickets::all();
      return view('closed_list_ticket', ['closed_tickets'=>$closed_tickets]);
    }
    public function closed_to_open(Request $request){
      $user = new client_pages;

      $user->ticket_number = $request->ticket_id;
      $user->name = $request->name;
      $user->title = $request->title;
      $user->description = $request->description;
      $user->importance = $request->importance;
      $user->date = $request->date;
      $user->status = $request->status;

      $user->save();

      $id = $request->ticket_id;

      closed_tickets::where('ticket_number', $id)->delete();

      $user = new logs;

      $user->date = $request->date_logs;
      $user->Action = $request->reopen_logs;

      $user->save();
    }


    public function display_logs(){
      $logs = Logs::all();
      // return view('/admin/display_logs', ['users'=>$users]);

      return $logs;
    }

}
