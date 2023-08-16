@php
use App\Star;
@endphp
@extends('layouts.master')
@section('title')
 laravel shopping cart
@endsection
@section('content')

<link rel="stylesheet" type="text/css" href="{{URL::to('src/css/shoppingIndex.css')}}"> 
<link rel="stylesheet" type="text/css" href="{{URL::to('src/css/review.css')}}"> 


        <div class="row justify-content-center" style="width: 100%">
                <div class="glass" style="width: 80%; height: unset; border-radius: 5px; margin-bottom: 10px; padding: 10px; padding-left: 30px;">    
                <h3>Review Form</h3>
                <hr>    
                <form action="{{route('product.postReview')}}" method="post">
                    @csrf
                    <div class="form-group">
                    <label for="exampleFormControlTextarea1">Write Your Review <i class="fas fa-pen-alt"></i></label>
                    <textarea name="review_content" class="form-control" id="exampleFormControlTextarea1" rows="5" required="" placeholder="Type your review here..."></textarea>
                  </div>

                  <div class="form-group">
                    

                            <div class="rating">
                              <input type="radio" name="rating" id="rating-5" value="5">
                              <label for="rating-5"></label>
                              
                              <input type="radio" name="rating" id="rating-4" value="4">
                              <label for="rating-4"></label>
                              
                              <input type="radio" name="rating" id="rating-3" value="3">
                              <label for="rating-3"></label>
                              
                              <input type="radio" name="rating" id="rating-2" value="2">
                              <label for="rating-2"></label>
                              
                              <input type="radio" name="rating" id="rating-1" value="1">
                              <label for="rating-1"></label>
                            </div>
                          <input type="hidden" name="item_id" value="{{$item_id}}">
                          <input type="hidden" name="orderinfo_id" value="{{$order->orderinfo_id}}">

                        @if($errors->has('rating'))
                        <div class="text-center">
                        <i style="color:red; ">* Star is {{$errors->first()}}</i>
                        </div>
                        @endif

                                                  
                  </div>
                  <div class="form-group text-center">
                      <button class="btn btn-primary" type="submit" style="margin-left: auto;">Submit</button>
                  </div>
                </form>        
                </div>

                <div class="glass" style="width: 80%; height: unset; border-radius: 5px; margin-bottom: 10px; padding: 10px; padding-left: 30px;">
                  @php
                    $total=0;
                  @endphp
                  <h3>Order List:</h3>
                  <hr>

                  <div class="row" style="margin-bottom: 10px; display:block;">
                    <b>Order Code: {{$order->code}}</b>
                    <b style="float:right; padding-right:30px">Status: {{$order->status}}
                    @if($order->status == "Completed") 
                      | Date Shipped: {{date_format(date_create($order->date_shipped),"M-d-Y h:i a")}}
                    @endif
                    </b>
                  </div>
                        <div>
                          <ul class="list-group">
                            {{--dd($order->items)--}} 
                              @foreach ($order->items as $item)
                                @if($item['item_id'] == $item_id)

                                  <li class="glass" style="list-style: none; width: unset; height: 23vh; margin-bottom:10px">
                                    <div class="row">
                                      <div class="col-md-3">
                                          <img src="{{$item->image != '' || $item->image != null ? asset('src/images/products/'.$item->image): url('/noImg.png') }}" onerror="this.src='{{url('/noImg.png')}}'" style="height: 23vh; border-bottom-left-radius: 2rem; border-top-right-radius: 0rem;">
                                      </div>
 
                                      <div class="col" style="padding-top:20px; ">
                                        <div class="row">
                                            <b style="color:#031131;">Name: {{ ucwords($item['title'])}}</b>

                                        </div>
                                        <div class="row">
                                            <b style="color:#031131;">Price each: ₱ {{number_format( $item['price'],2,'.',"")}}</b>

                                        </div>
                                        <div class="row" style="border: 0px solid white; display: block;">
                                            <b style="color:#031131;">Quantity: {{$item->pivot['quantity']}}</b>
                                            <b style="float: right; margin-right:30px;color:#031131;">Total: ₱ {{number_format($item->pivot['quantity'] * $item['price'],2,'.',"")}}</b>
                                        </div>
                                      </div>
                                    </div>
                                  </li>
                                  @php
                                  $total += $item['price']*$item->pivot['quantity'];
                                  @endphp
                                @endif
                              @endforeach
                          </ul>
                      </div>
                      <div class="row">
                        <strong style="  display:inline-block;">Date Placed: {{date_format(date_create($order->date_placed),"M-d-Y h:i a")}} </strong>
                      </div>
                </div>

           
        </div>



<script type="text/javascript">
    feather.replace();

document.querySelectorAll(".player__dock").forEach((el) => {
  el.addEventListener("click", (e) => {
    document.querySelector(".player").classList.toggle("player--docked");
  });
});

</script>
@endsection