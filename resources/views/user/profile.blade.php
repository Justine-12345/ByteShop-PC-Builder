@extends('layouts.master')
@section('content')

<link rel="stylesheet" type="text/css" href="{{URL::to('src/css/shoppingIndex.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::to('src/css/buildOption.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::to('src/css/profile.css')}}">
<style type="text/css">
  .btn-label {position: relative;left: -12px;display: inline-block;padding: 6px 12px;background: rgba(0,0,0,0.15);border-radius: 3px 0 0 3px;}
.btn-labeled {padding-top: 0;padding-bottom: 0;}
.btn { margin-bottom:10px; }

</style>


<div class="row justify-content-center" style="width:100%">
  <div class="col-lg-2 ">
  <a class='{{$selectedBtn == "New Order" ? "holo-btn-fed" : "holo-btn"}} text-center' href='{{route('user.profile',['arrangement'=>'New Order'])}}' style="margin-bottom:10px">
    <span class='cta-d' style="margin-bottom: 5px;">  New Order</span>
    <span class='skew top' ></span>
    <span class='skew bottom'></span>
</a> 
  </div>
   <div class="col-lg-2 ">
  <a class='{{$selectedBtn == "Confirmed" ? "holo-btn-fed" : "holo-btn"}} text-center' href='{{route('user.profile',['arrangement'=>'Confirmed'])}}' style="margin-bottom:10px">
    <span class='cta-3' style="margin-bottom: 5px">  Confirmed</span>
    <span class='skew top'></span>
    <span class='skew bottom'></span>
</a> 
  </div>
  <div class="col-lg-2 ">
  <a class='{{$selectedBtn == "Shipped" ? "holo-btn-fed" : "holo-btn"}} text-center' href='{{route('user.profile',['arrangement'=>'Shipped'])}}' style="margin-bottom:10px">
    <span class='cta-3' style="margin-bottom: 5px">  Shipped</span>
    <span class='skew top'></span>
    <span class='skew bottom'></span>
</a> 
  </div>
</div>
<div class="row justify-content-center" style="width:100%">
   <div class="col-lg-2 ">
  <a class='{{$selectedBtn == "Completed" ? "holo-btn-fed" : "holo-btn"}} text-center' href='{{route('user.profile',['arrangement'=>'Completed'])}}' style="margin-bottom:10px">
    <span class='cta-3' style="margin-bottom: 5px">  Completed</span>
    <span class='skew top'></span>
    <span class='skew bottom'></span>
</a> 
  </div>
   <div class="col-lg-2 ">
  <a class='{{$selectedBtn == "Dispute" ? "holo-btn-fed" : "holo-btn"}} text-center' href='{{route('user.profile',['arrangement'=>'Dispute'])}}' style="margin-bottom:10px">
    <span class='cta-3' style="margin-bottom: 5px">  Dispute </span>
    <span class='skew top'></span>
    <span class='skew bottom'></span>
</a> 
  </div>
   <div class="col-lg-2 ">
  <a class='{{$selectedBtn == "Cancelled" ? "holo-btn-fed" : "holo-btn"}} text-center' href='{{route('user.profile',['arrangement'=>'Cancelled'])}}' style="margin-bottom:10px">
    <span class='cta-3' style="margin-bottom: 5px">  Cancelled</span>
    <span class='skew top'></span>
    <span class='skew bottom'></span>
</a> 
  </div>
</div>



<div class="row " style="width: 80%; margin: auto;">

         
 @if($message = Session::get('success')) 

<div class="alert alert-primary alert-dismissible fade show" role="alert" style="width: 100%">
  <strong style="color:darkblue;">{{$message}}</strong> 
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true" style="color: darkblue;">&times;</span>
  </button>
</div>

 @endif 
            

          
            @foreach ($orders as $order)
                <div class="glass " style="width: 100%; height: unset; border-radius: 5px; margin-bottom: 30px; padding: 10px; padding-left: 30px; padding-bottom: 30px; top:unset;">
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


                              @php 
                                      $productBrand = "";

                                      if ($item != "" ||$item != null) {
                                            foreach($brands as $brand){
                                         if($brand->brand_id == $item->brand_id){
                                            $productBrand = $brand->category->category_name;
                                         }

                                      }
                      
                                      }
                              @endphp
                                  <li class="glass" style="list-style: none; width: 100%; height: 23vh; margin-bottom:10px;">
                                   <div class="row">
                                      <div class="col-xl-2">
                                      <a href="{{route('product.showTobuy',['0'=>$item->item_id, '1'=>$productBrand])}}" >

                                          <img src="{{$item->image != '' || $item->image != null ? asset('src/images/products/'.$item->image): url('/noImg.png') }}" onerror="this.src='{{url('/noImg.png')}}'" style="height: 23vh; border-bottom-left-radius: 2rem; border-top-right-radius: 0rem; max-width:100%">
                                        </a>
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
                                        <div class="row" style="border: 0px solid white; display: block;">
                                              @if($item->pivot->is_reviewed == 0 && $order->status == 'Completed')
                                              <a href="{{route('product.getReview', ['0'=> $order->orderinfo_id, '1'=>$item['item_id'] ])}}" style="float:right;">
                                             <button type="button" class="btn btn-labeled btn-primary btn-review" style="float:right; height: 30px; margin-right:10px">
                                                <span class="btn-label "  style="height: 28px;"><i class="fas fa-clipboard-list"></i></span>Review</button>
                                              </a> 
                                              @elseif($item->pivot->is_reviewed == 1 || $order->status == 'Cancelled')
                                              @php
                                              $padd = "10px";
                                              @endphp
                                              

                                                <a href="{{route('product.showTobuy',['0'=>$item->item_id, '1'=>$productBrand])}}">
                                                <button type="button" style="float:right; background-color:  #ffcb0d; height: 30px; margin-right: 10px;" class="btn btn-labeled btn-buy">
                                                <span class="btn-label" style="height: 28px;"><i class="fas fa-shopping-cart"></i></span>Buy Again</button>
                                                </a>
                                                  @if($order->status != 'Cancelled')
                                                  <b class="reviewed" style="float:right; color:#031131; margin-top:3px; margin-right:10px;">Reviewed <i class="fas fa-check" style="color:#031131;"></i></b>
                                                  @endif

                                                 @endif
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
                      <div class="row"  style="display: block; padding-right: 30px; border: 0px solid white;">
                           @if($order->status != 'Completed' && $order->status != 'Shipped' && $order->status != 'Dispute' &&  $order->status != 'Cancelled')
                                    @php
                                    $disable = "";
                                    $event = "";
                                    if ($order->status == 'Reject Cancellation') {
                                      $disable = "disabled";
                                       $event = "none";
                                    }
                                    @endphp
                                    
                                                <a href="{{route('product.getCancel',$order->orderinfo_id)}}" style="pointer-events:{{$event}};">


                                                <button type="button" style="float:right; background-color:#e40505; height: 30px; font-size:13px; margin-left: 10px; color: white;" class="btn btn-labeled" {{$disable}}>
                                                <span class="btn-label" style="height: 28px; padding-top: 3px;"><i class="fas fa-times-circle"></i></span>Cancel</button>
                                                </a>
                                @endif
                                                  <a href="{{route('product.getContact',$order->orderinfo_id)}}">
                                                <button type="button" style="float:right; background-color:#3dc504; height: 30px; font-size:13px; " class="btn btn-labeled ">
                                                <span class="btn-label" style="height: 28px; padding-top: 3px;"><i class="fas fa-phone-alt"></i></span>Contact Us</button>
                                                </a>
                      @if ($order->status == 'Reject Cancellation') 
                        <div style="float:left;">
                          <small><i>*You can only attempt 1 cancellation for each order</i></small>
                        </div>
                      @endif

                      </div>
                      <br>
                    
                </div>
            @endforeach
        </div>
    </div>
@endsection