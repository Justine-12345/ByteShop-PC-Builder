<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Order;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Redirect;
class MessageAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
     
         if( $request->all() == null || !$request->has('tab')){
            $tab = session()->get('tab');
           


                if($tab == "Sent Message"){
                     $messages = Message::with('user')
                        ->whereNotNull('to_user')
                        ->orderBy('message_id','DESC')
                        ->Paginate(5); 
                        session()->put('tab','Sent Message');
                }
                 if($tab == "Inbox"||$tab == null){
                     $messages = Message::with('user')
                        ->where('to_user',null)
                        ->orderBy('message_id','DESC')
                        ->Paginate(5); 
                        session()->put('tab','Inbox');
                }
                return view('messageAdmin.index', compact('messages','tab'));
        }

        if ($request->has('tab')) {
                if($request->tab == "sent"){
                     $messages = Message::with('user')
                        ->whereNotNull('to_user')
                        ->orderBy('message_id','DESC')
                        ->Paginate(5); 
                        session()->put('tab','Sent Message');
                }
                 if($request->tab == "inbox"){
                     $messages = Message::with('user')
                        ->where('to_user',null)
                        ->orderBy('message_id','DESC')
                        ->Paginate(5); 
                        session()->put('tab','Inbox');
                }
                 $tab = session()->get('tab');
        return view('messageAdmin.index', compact('messages','tab'));
         }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {   

        $user ="";
        $users ="";

        if($request->has('user_id')){
        $user = User::where('user_id',$request->user_id)->first();
        }
        else{
        $users = User::where('is_admin',0)->pluck('name','user_id');
        }
   
        return view('messageAdmin.create', compact('user','users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
           $message = new Message;    
           $message->message_content = $request->message_content;
           date_default_timezone_set('Asia/Manila');
           if ( $request->message_title == "" ||  $request->message_title == null) {
            $message->message_title = "No Title";
           }
           else{
              $message->message_title = $request->message_title;
           }
           


           $message->message_date = date("Y-m-d H:i:s",time());
           $message->message_label = "Normal";
           $message->user_id = auth()->user()->user_id;   
           $message->to_user = $request->user_id;   
           $message->save();
           return Redirect::route('messageadmin.index')->with('success', 'Message sent!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $tab = "";
        $mess = Message::with('user')->with('recieve_user')
        ->where('message_id',$id)->first();

        if ($mess->to_user == null && $mess->user_id != null) {
          $mess->is_seen = "1"; 
          $tab = "Inbox";
        }
        
        $mess->save();
        $order = Order::with('items')->where('orderinfo_id',$mess->orderinfo_id)->first();

       return view('messageAdmin.show', compact('mess','order', 'tab'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
