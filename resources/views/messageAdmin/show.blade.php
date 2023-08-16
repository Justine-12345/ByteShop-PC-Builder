<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard - Brand</title>
     <link rel="stylesheet" href="{{asset('src/assets/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="{{asset('src/assets/fonts/fontawesome-all.min.css')}}">
    <link rel="stylesheet" href="{{asset('src/assets/fonts/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('src/assets/fonts/fontawesome5-overrides.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::to('src/css/createmessage.css')}}"> 

     <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
</head>

<body id="page-top">
    <div id="wrapper">
       @include('partials.admin_header')
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
        @include('partials.admin_header2')
                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-dark mb-0"></h3>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-xl-12 offset-xl-0">
                
      <div class="row justify-content-center" style="width: 100%">
                <div class="glass" style="width: 80%; height: unset; border-radius: 5px; margin-bottom: 10px; padding: 10px; padding-left: 30px;">  
            <h3>Message</h3>   
            <hr>
                <h4>Title: {{ucwords($mess->message_title)}}</h4>
                {{-- {{dd($messageReq )}} --}}
                <p>From: {{$mess->user->name}} {{$mess->recieve_user != null? "(You)":null}}</p>
                <p>To: {{$mess->recieve_user != null ? $mess->recieve_user->name : auth()->user()->name."(You)"}}</p>
                <p>Date: {{date_format(date_create($mess->message_date),"M-d-Y h:i a")}}</p>
                <p>
                  @if($mess->message_label == "Cancel")
                  Reason
                  @else
                  Message                  
                  @endif
                : {{$mess->message_content}} </p>

                @if($tab == "Inbox")
                <p>
                    <form action="{{route('messageadmin.create')}}" method="get">
                        @csrf
                        <input type="hidden" name="user_id" value="{{$mess->user->user_id}}">
                        <button type="submit" class="btn btn-success">Reply</button>
                    </form>
                </p>
                @endif

                </div>
@if($order !== null)
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


                        
                                  <li class="glass" style="list-style: none; width: unset; height: 23vh; margin-bottom:10px">
                                    <div class="row">
                                      <div class="col-md-4">
                              

                                          <img src="{{$item->image != '' || $item->image != null ? asset('src/images/products/'.$item->image): url('/noImg.png') }}" onerror="this.src='{{url('/noImg.png')}}'" style="height: 20vh; border-radius: 2rem; width: 30vh; object-fit: cover;">
                                       
                                      </div>

                                      <div class="col" style="padding-top:20px; padding-right: 50px">

                                        <div class="row">
                                            <b style="color:#031131; font-size: 13px;">Name: {{ ucwords($item['title'])}}</b>

                                        </div>
                                        <div class="row">
                                            <b style="color:#031131; font-size: 13px;">Price each: ₱ {{number_format( $item['price'],2,'.',"")}}</b>

                                        </div>
                                        <div class="row" style="border: 0px solid white; display: block;">
                                            <b style="color:#031131; font-size:13px">Quantity: {{$item->pivot['quantity']}}</b>
                                            <b style="float: right; color: #031131; font-size: 13px;">Total: ₱ {{number_format($item->pivot['quantity'] * $item['price'],2,'.',",")}}</b>
                                        </div>
                                      </div>
                                    </div>
                                    <hr>
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
@endif
        </div>



                          </div>
                        </div>
                    </div>
                </div>
                  <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © Brand 2021</span></div>
                </div>
            </footer>  
            </div>
        
        </div><a class="border rounded d-inline scroll-to-top" href="{{url()->previous() }}"><i class="fas fa-arrow-left"></i></a>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/theme.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>

</html>

            