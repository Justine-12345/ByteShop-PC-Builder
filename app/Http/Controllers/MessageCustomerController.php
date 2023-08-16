<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Order;
use DB;
use Redirect;
class MessageCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

         if( $request->all() == null){
             $messages = Message::with('user')
                ->where('to_user', auth()->user()->user_id)
                ->orderBy('message_id','DESC')
                ->get();  
                $tab = "Inbox";
                return view('messageCustomer.index', compact('messages', 'tab'));
        }

        if($request->to_user == null || $request->to_user == ""){
             $messages = Message::with('user')
                ->where('user_id', auth()->user()->user_id)
                ->orderBy('message_id','DESC')
                ->get();
                $tab = "Sent Message";
        }
        else{
          $messages = Message::with('user')
                ->where('to_user', auth()->user()->user_id)
                ->orderBy('message_id','DESC')
                ->get();  
                $tab = "Inbox";  
        }


       

             return view('messageCustomer.index', compact('messages', 'tab'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('messageCustomer.create');
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
           $message->save();
           return Redirect::route('messagecustomer.index')->with('success', 'Message sent!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mess = Message::with('user')->with('recieve_user')
        ->where('message_id',$id)->first();
        if ($mess->to_user == auth()->user()->user_id) {
           $mess->is_seen = "1";
           $mess->save();
        }
       

        $order = Order::with('items')->where('orderinfo_id',$mess->orderinfo_id)->first();

       return view('messageCustomer.show', compact('mess','order'));
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
         DB::table('messages')->where('message_id', '=', $id)->delete();

        return Redirect::route('messagecustomer.index')->with('success','Message deleted!');
    }
}
