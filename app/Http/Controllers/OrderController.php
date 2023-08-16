<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Message;
use App\Models\Customer;
use Auth;
use App\Events\OrderStatusChange;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   

         if($request->has('search') || $request->search != null){

            if(auth()->user()->is_admin == 2){
                $orders = Order::with('customer')->with('items')->where('code',$request->search)
                    ->where('delivery_id', auth()->user()->user_id)
                    ->get();
                $oldStatus = null;
                $oldArrangement = null;
                $users = User::where('is_admin', 2)->get();
                return view('order.index', compact('orders','users', 'oldStatus', 'oldArrangement'));
            }else{

                $orders = Order::with('customer')->with('items')->where('code',$request->search)
                    ->get();
                $oldStatus = null;
                $oldArrangement = null;
                $users = User::where('is_admin', 2)->get();
                return view('order.index', compact('orders','users', 'oldStatus', 'oldArrangement'));
            }
        }


        if(!$request->has('arrangement') || $request->arrangement == null){
            $request->request->add(['arrangement' => 'ASC']);
        }

        // dd(!$request->has('order') || $request->order==null);
        if(!$request->has('order') || $request->order==null){
           $request->request->add(['order' => 'orderinfo_id']);

        }

       // dd($request);

        if($request->status==null||$request->status == "All") 
        {      
               if(Auth::check() && auth()->user()->is_admin == 1){
              $orders = Order::with('customer')->orderBy($request->order,$request->arrangement)->with('items')
                ->get();
            } 
            elseif(Auth::check() && auth()->user()->is_admin == 2){
              $orders = Order::with('customer')
              ->where('status','Shipped')
              ->where('delivery_id', auth()->user()->user_id)
              ->orderBy($request->order,$request->arrangement)
              ->with('items')
                ->get();
            }


        }
        else{


            $orders = Order::with('customer')->where('status',$request->status)->orderBy($request->order,$request->arrangement)->with('items')
                ->orderBy('date_placed','DESC')->get();
            if($request->status == "Confirmed"){
                $orders = Order::with('customer')
                ->where('status',$request->status)
                ->orWhere('status',"Reject Cancellation")
                ->orderBy($request->order,$request->arrangement)->with('items')
                 ->get();
            }

            if(Auth::check() && auth()->user()->is_admin == 2){
              $orders = Order::with('customer')
              ->where('status',$request->status)
              ->where('delivery_id', auth()->user()->user_id)
              ->orderBy($request->order,$request->arrangement)
              ->with('items')
                ->get();
            }



        }
        
        



      if(!$request->has('status') || $request->status==null){
         $oldStatus = "All";
      }
      else{
         $oldStatus = $request->status;
      }
      if(!$request->has('arrangement') || $request->arrangement==null){
         $oldArrangement = "ASC";
      }
      else{
         $oldArrangement = $request->arrangement;
      }

      $users = User::where('is_admin', 2)->get();

      $deliveryMan = User::where('is_admin',2)->pluck('name', 'id');
             // dd($deliveryMan);

        return view('order.index', compact('orders', 'oldStatus', 'oldArrangement', 'users', 'deliveryMan'));

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $order = Order::with('customer')->with('items')->where('orderinfo_id', $id)
        ->first();
        return view('order.show', compact('order'));
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

     public function updateStatus(Request $request, $id)
    {   
        
        
        // dd($customer->email);
        date_default_timezone_set('Asia/Manila');
        if ($request->newStatus == "Cancelled" || $request->newStatus == "Reject Cancellation" ){
            $order = Order::where('orderinfo_id', $id)->first();
            $orderCode = $order->code;
            $order->status = $request->newStatus;
            $order->save();

            $customer = User::with('customer')->where('id', $request->user_id)->first();
            $allCurrentOrder = Order::with('items')->where('orderinfo_id', $id)->first();
         
            event(new OrderStatusChange($customer, $allCurrentOrder));
            return redirect()->route('order.index')->with('success','Order '.$orderCode.' has been '. $request->newStatus);
          }

        if ($request->newStatus == "Shipped") {
            // dd($request);
            $order = Order::where('orderinfo_id', $id)->first();
            $order->status = $request->newStatus;
            $orderCode = $order->code;
            $order->delivery_id = $request->rider;
            $order->save();
            $customer = User::with('customer')->where('id', $request->user_id)->first();
            $allCurrentOrder = Order::with('items')->where('orderinfo_id', $id)->first();
          
            event(new OrderStatusChange($customer, $allCurrentOrder));
            return redirect()->route('order.index')->with('success','Order '.$orderCode.' has been '. $request->newStatus);
        }


        if ($request->newStatus == "Dispute") {
           $order = Order::with('customer')->with('items')->where('orderinfo_id',$id)->first();
           $messageReq = Message::join('users', 'users.user_id', 'messages.user_id')
           ->where('orderinfo_id',$id)
           ->where('message_label', 'Cancel')
            ->first();
        // $customer = User::with('customer')->where('id', $request->user_id)->first();
        // $allCurrentOrder = Order::with('items')->where('orderinfo_id', $id)->first();
    
        // event(new OrderStatusChange($customer, $allCurrentOrder));
        return view('admin.cancel', compact('order', 'messageReq'));
        }

        $order = Order::where('orderinfo_id', $id)->first();
        $orderCode = $order->code;
        $order->status = $request->newStatus;

        if ($request->newStatus == "Completed") {
        $order->date_shipped = date("Y-m-d H:i:s",time());
        }

        $order->save();

        $customer = User::with('customer')->where('id', $request->user_id)->first();
        $allCurrentOrder = Order::with('items')->where('orderinfo_id', $id)->first();
    
        event(new OrderStatusChange($customer, $allCurrentOrder));
        return redirect()->back()->with('success','Order '.$orderCode.' has been '. $request->newStatus);
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
