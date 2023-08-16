@php
use App\Converter;
$converter = new Converter;
@endphp
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard - Operating System</title>
     <link rel="stylesheet" href="{{asset('src/assets/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="{{asset('src/assets/fonts/fontawesome-all.min.css')}}">
    <link rel="stylesheet" href="{{asset('src/assets/fonts/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('src/assets/fonts/fontawesome5-overrides.min.css')}}">
           <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
</head>

<body id="page-top">
    <div id="wrapper">
    @if(auth()->user()->is_admin == 1)
       @include('partials.admin_header')
    @endif
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
               @include('partials.admin_header2')
                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-dark mb-0"></h3>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-xl-12 offset-xl-0">
                            <div class="card shadow mb-4">
                                                               <div class="col">
                                    <h1 class="text-center" style="color: rgb(0,0,0);margin-top: 10px;">Order Info</b></h1>
                                </div>
                                <div class="col">
                                    <div class="table-responsive" style="text-align: center;color: rgb(0,0,0);">
                                        @php
                                        $price = 0;
                                        foreach ($order->items as $item) 
                                        $price += $item->price * $item->pivot->quantity;
                                        @endphp
                                        <table class="table">
                                            <thead style="background: #031131;color: rgb(248,249,255);">
                                                <tr>
                                                    <th colspan="2" style="color: rgb(255,255,255);">
                                                        <h4><span style="float: left;"> Order Code: <b>{{ $order->code}}</span>
                                                         <span style="float: right;">   
                                                            Total Price: <b>₱ {{ number_format($price, 2, '.', ',') }}</b>
                                                          </span>
                                                        </h4>
                                                    

                                                </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="color: rgb(0,0,0);">Order ID</td>
                                                    <td style="color: rgb(0,0,0);">{{ $order->orderinfo_id }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: rgb(0,0,0);">Date Placed</td>
                                                    <td style="color: rgb(0,0,0);">
                                                    @php
                                                    $date=date_create($order->date_placed);
                                                    @endphp
                                                    {{date_format($date,"M-d-Y h:i:s a")}}</td>
                                                </tr>

                                                <tr>
                                                    <td style="color: rgb(0,0,0);">Date Shipped</td>  
                                                    <td style="color: rgb(0,0,0);">
                                                    {{ $order->date_shipped != "" || $order->date_shipped != null? date_format(date_create($order->date_shipped),"M-d-Y h:i:s a"): "----"  }}</td>
                                                </tr>
                                                <tr>
                                                     <td style="color: rgb(0,0,0);">Status</td> 

                                                
                                                <td style="color: rgb(0,0,0);">
                                                    @php
                                                    $color = "";
                                                    $text = "white";
                                                    $border = "Unset";
                                                    $dropdown = "dropdown-toggle";
                                                    $dropdownContent = "dropdown";
                                                     if($order->status == "New Order"){
                                                       $color ="#bad600";
                                                        }
                                                    if($order->status == "Confirmed"){
                                                       $color ="#3ebf17";
                                                        }
                                                    if($order->status == "Shipped"){
                                                       $color ="#e08312";
                                                        }
                                                    if($order->status == "Completed"){
                                                        $color ="#fff";
                                                        $text = "Black";
                                                        $border = "1px Solid Black";
                                                        $dropdown = "";
                                                        $dropdownContent = "";
                                                        }


                                                    @endphp
                                                    <form action="{{route('order.updateStatus', $order->orderinfo_id)}}" method="post">
                                                        @csrf
                                                    <div class="dropdown">
                                                      <button type="button" class="btn btn {{$dropdown}}" type="button" id="dropdownMenuButton" data-toggle="{{$dropdownContent}}" aria-haspopup="true" aria-expanded="false" style="background:{{$color}};color: {{$text}}; border: {{$border}}; width: 115px">
                                                        {{ $order->status }}
                                                      </button>
                                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    @if( $order->status == 'New Order')
                                                        <button type="submit" name="newStatus" class="dropdown-item" value="Confirmed">Confirmed</button>

                                                        <button type="submit" name="newStatus" class="dropdown-item" value="Shipped">Shipped</button>

                                                        <button type="submit" name="newStatus" class="dropdown-item" value="Completed">Completed</button>

                                                    @endif
                                                    @if( $order->status  == 'Confirmed')
                                                          <button type="submit" name="newStatus" class="dropdown-item" value="Shipped">Shipped</button>

                                                         <button type="submit" name="newStatus" class="dropdown-item" value="Completed">Completed</button>
                                                    @endif
                                                    @if( $order->status  == 'Shipped')
                                                         <button type="submit" name="newStatus" class="dropdown-item" value="Completed">Completed</button>
                                                    @endif
                                                     @if( $order->status  == 'Completed')
                        
                                                    @endif

                                                      </div>
                                                    </div>
                                                    </form>

                                                    </td>
                                                </tr>
                                            </tbody>
                                             <thead style="background: #031131;color: rgb(248,249,255);">
                                                <tr>
                                                    <th colspan="2" style="color: rgb(255,255,255);">Customer Info</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                <td style="color: rgb(0,0,0);">Name</td>
                                                <td style="color: rgb(0,0,0);">{{$order->customer->fname}} {{$order->customer->lname}}</td>   
                                                </tr>
                                                <tr>
                                                 <td style="color: rgb(0,0,0);">Addressline</td><td style="color: rgb(0,0,0);">{{$order->customer->addressline}}</td>   
                                                </tr>
                                                <tr>
                                                  <td style="color: rgb(0,0,0);">City</td>
                                                  <td style="color: rgb(0,0,0);">{{$order->customer->city}}</td>  
                                                </tr>
                                                 <tr>
                                                  <td style="color: rgb(0,0,0);">Zipcode</td>
                                                  <td style="color: rgb(0,0,0);">{{$order->customer->zipcode}}</td>  
                                                </tr>
                                                <tr>
                                                  <td style="color: rgb(0,0,0);">Mobile Number</td>
                                                  <td style="color: rgb(0,0,0);">{{$order->customer->phone}}</td>  
                                                </tr>
                                            </tbody>
                                              <thead style="background: #031131;color: rgb(248,249,255);">
                                                <tr>
                                                    <th colspan="2" style="color: rgb(255,255,255);">Item/s Ordered</th>
                                                </tr>
                                            </thead>
                                        </table>
                                        <table class="table">
                                                <thead style="background: #fff;color:black;">
                                                <tr>
                                                    <th style="color: black;">Name</th>
                                                    <th style="color: black;">Qty</th>
                                                    <th style="color: black;">Price</th>
                                                    <th style="color: black;">Total</th>
                                                </tr>
                                            </thead>

                                          @foreach($order->items as $item)  
                                             <tr>
                                                    <td style="color: black;">{{$item->title}}</td>
                                                    <td style="color: black;">{{$item->pivot->quantity}}</td>
                                                    <td style="color: black;">₱ {{ number_format($item->price, 2, '.', ',') }}</td>
                                                    <td style="color: black;">₱ {{ number_format($item->pivot->quantity*$item->price, 2, '.', ',') }}</td>

                                            </tr>
                                          @endforeach
                                        </table>
                                    </div>
                                </div>
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
        </div><a class="border rounded d-inline scroll-to-top" href="{{url()->previous()}}"><i class="fas fa-arrow-left"></i></a>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/theme.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>

</html>