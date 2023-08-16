@php
use App\Star;
@endphp
@extends('layouts.master')
@section('title')
 laravel shopping cart
@endsection
@section('content')


<link rel="stylesheet" type="text/css" href="{{URL::to('src/css/shoppingIndex.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::to('src/css/buildOption.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::to('src/css/profile.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::to('src/css/review.css')}}"> 


        <div class="row justify-content-center" style="width: 100%">
                <div class="glass" style="width: 80%; height: unset; border-radius: 5px; margin-bottom: 10px; padding: 10px; padding-left: 30px;">     
        <h3>Contact Form</h3> 
        <hr>  
                <form action="{{route('product.postContact')}}" method="post">
                    @csrf
                    <div class="form-group">
                    <label for="exampleFormControlTextarea1">Do you want to ask something? <i class="fas fa-pen-alt"></i></label>
                    <textarea name="message_content" class="form-control" id="exampleFormControlTextarea1" rows="5" required="" placeholder="Type here..."></textarea>
                  </div>
                  <input type="hidden" name="orderinfo_id" value="{{$order->orderinfo_id}}">
                  <input type="hidden" name="code" value="{{$order->code}}">
                  <div class="form-group text-center">
                      <button class="btn btn-primary" type="submit" style="margin-left: auto;">Submit</button>
                  </div>
                </form>        
                </div>

                  <div class="glass " style="width: 80%; height: unset; border-radius: 5px; margin-bottom: 30px; padding: 10px; padding-left: 30px; padding-bottom: 30px; top:unset;">
                <h3>Order List:</h3>
                <hr>
                  @php
                    $total=0;
                  @endphp


                  <div class="row" style="margin-bottom: 10px; display:block;">

                    <span class="orderCode" >Order Code: {{$order->code}}</span>
                    <span class="orderStatus" style="float:right; padding-right:30px;">Status: 
                      @if($order->status == "Dispute")
                      Requesting For Cancellation
                      @elseif($order->status == "Reject Cancellation")
                      {{$order->status}} Ready For Shipment
                      @else
                      {{$order->status}}
                      @endif
                    @if($order->status == "Completed") 
                      | Date Shipped: {{date_format(date_create($order->date_shipped),"M-d-Y h:i a")}}
                    @elseif($order->status == "Dispute")
                    @endif
                    </span>
                    
                  </div>
                        <div>
                          <ul class="list-group">
                            {{--dd($order->items)--}} 
                              @foreach ($order->items as $item)
                                  <li class="glass" style="list-style: none; width: 100%; height: 23vh; margin-bottom:10px;">
                                   <div class="row">
                                      <div class="col-xl-2">
                                     

                                          <img src="{{$item->image != '' || $item->image != null ? asset('src/images/products/'.$item->image): url('/noImg.png') }}" onerror="this.src='{{url('/noImg.png')}}'" style="height: 23vh; border-bottom-left-radius: 2rem; border-top-right-radius: 0rem; max-width:100%">
                                    
                                      </div>

                                      <div class="col-xl orderItems" style="padding-top:20px; padding-right: 50px; padding-left: 30px;">

                                        <div class="row">
                                            <b style="color:#031131; ">Name: {{ ucwords($item['title'])}}</b>

                                        </div>
                                        <div class="row">
                                            <b style="color:#031131; ">Price each: ₱ {{number_format( $item['price'],2,'.',"")}}</b>

                                        </div>
                                        <div class="row" style="border: 0px solid white; display: block;">
                                            <b style="color:#031131; ">Quantity: {{$item->pivot['quantity']}}</b>
                                            <br>
                                            <b class="total" style=" color: #031131;">Total: ₱ {{number_format($item->pivot['quantity'] * $item['price'],2,'.',",")}}</b>
                                        </div>
                                       
                                    
                                      </div>
                                      </div>
                                  </li>
                                  @php
                                  $total += $item['price']*$item->pivot['quantity'];
                                  @endphp
                              @endforeach
                          </ul>



                      </div>
                      <div class="row">
                        <small class="orderPlaced" style="display:inline-block;">Date Placed: {{date_format(date_create($order->date_placed),"M-d-Y h:i a")}} </small>
                          <b  style="margin-left: auto; margin-right: 30px;  display:inline-block;">Total Price: ₱ {{number_format( $total,2,'.',",")}}{{-- $order->cart->totalPrice --}} </b>
                      </div>
                      <br>
                    
                </div>
        </div>
    </div>
@endsection