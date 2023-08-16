<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard - Operating Systems</title>
    <link rel="stylesheet" href="{{asset('src/assets/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="{{asset('src/assets/fonts/fontawesome-all.min.css')}}">
    <link rel="stylesheet" href="{{asset('src/assets/fonts/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('src/assets/fonts/fontawesome5-overrides.min.css')}}">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

</head>

<body id="page-top">
    <div id="wrapper">
     @if(Auth::check() && auth()->user()->is_admin == 1)
     @include('partials.admin_header')
     @endif
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
               @include('partials.admin_header2')
               @if($message = Session::get('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-right: 30px; margin-left: 30px">
  <strong>{{$message}}</strong> 
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
@if(Auth::check() && auth()->user()->is_admin == 2)
<h2 style="text-align:center;">Rider Panel</h2>
<hr>
@endif
                <div class="container-fluid" style="font-size: 14px;">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-dark mb-0">Order Table</h3>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-xl-12 offset-xl-0">
                            <div class="card shadow mb-4">
                                <div class="card-body">

                                <form action="{{route('order.index')}}" method="GET" style="border:0px solid black;display: inline-block;">
                                    <input type="hidden" name="status" value="All">
                                    <div class="btn-group">
                                      <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style=" color: white; background: #24a0ed;">
                                        @if($oldStatus == "All")
                                       <u>
                                       @if(Auth::check() && auth()->user()->is_admin == 1)
                                       All
                                       @else
                                       Assigned
                                       @endif
                                       </u>
                                       @else
                                        @if(Auth::check() && auth()->user()->is_admin == 1)
                                       All
                                       @else
                                       Assigned
                                       @endif
                                       @endif
                                      </button>
                                      <div class="dropdown-menu">
                                        <button name="order" class="dropdown-item" type="submit" value="date_placed">All
                                        @if($oldStatus == "All")
                                         <i class="fas fa-caret-left"></i>
                                        @endif
                                        </button>
                                        <div class="dropdown-divider"></div>
                                        <button name="arrangement" class="dropdown-item" type="submit" value="ASC">Ascending
                                        @if($oldArrangement == 'ASC' && $oldStatus == "All") 
                                        <i class="fas fa-caret-left"></i>
                                        @endif
                                        </button>

                                        <button name="arrangement" class="dropdown-item" type="submit" value="DESC">Descending 
                                           
                                        @if($oldArrangement == 'DESC' && $oldStatus == "All")     
                                        <i class="fas fa-caret-left"></i>
                                        @endif
                                       </button>
                                      </div>
                                    </div>
                                </form>

                                @if(Auth::check() && auth()->user()->is_admin == 1)
                                <form action="{{route('order.index')}}" method="GET" style="border:0px solid black;display: inline-block;">
                                    <input type="hidden" name="status" value="New Order">
                                    <div class="btn-group">
                                      <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background:#24a0ed; color: white;"> 
                                       @if($oldStatus == "New Order")
                                       <u>New Order</u>
                                       @else
                                       New Order
                                       @endif
                                      </button>
                                      <div class="dropdown-menu">
                                        <button name="order" class="dropdown-item" type="submit" value="date_placed">All @if($oldStatus == "New Order")
                                         <i class="fas fa-caret-left"></i>
                                        @endif
                                        </button>
                                        <div class="dropdown-divider"></div>
                                        <button name="arrangement" class="dropdown-item" type="submit" value="ASC">Ascending
                                        @if($oldArrangement == 'ASC' && $oldStatus == "New Order") 
                                        <i class="fas fa-caret-left"></i>
                                        @endif
                                        </button>

                                        <button name="arrangement" class="dropdown-item" type="submit" value="DESC">Descending 
                                           
                                        @if($oldArrangement == 'DESC' && $oldStatus == "New Order")     
                                        <i class="fas fa-caret-left"></i>
                                        @endif
                                       </button>
                                      </div>
                                    </div>
                                </form>
                                @endif
                                @if(Auth::check() && auth()->user()->is_admin == 1)
                                <form action="{{route('order.index')}}" method="GET" style="border:0px solid black;display: inline-block;">
                                    <input type="hidden" name="status" value="Confirmed">
                                    <div class="btn-group">
                                      <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background:#24a0ed; color: white;">
                                       @if($oldStatus == "Confirmed")
                                       <u>Confirmed</u>
                                       @else
                                       Confirmed
                                       @endif
                                      </button>
                                      <div class="dropdown-menu">
                                        <button name="order" class="dropdown-item" type="submit" value="date_placed">All @if($oldStatus == "New Order")
                                         <i class="fas fa-caret-left"></i>
                                        @endif
                                        </button>
                                        <div class="dropdown-divider"></div>
                                        <button name="arrangement" class="dropdown-item" type="submit" value="ASC">Ascending
                                        @if($oldArrangement == 'ASC' && $oldStatus == "Confirmed") 
                                        <i class="fas fa-caret-left"></i>
                                        @endif
                                        </button>

                                        <button name="arrangement" class="dropdown-item" type="submit" value="DESC">Descending 
                                           
                                        @if($oldArrangement == 'DESC' && $oldStatus == "Confirmed")     
                                        <i class="fas fa-caret-left"></i>
                                        @endif
                                       </button>
                                      </div>
                                    </div>
                                </form>
                                @endif
                                @if(Auth::check() && auth()->user()->is_admin == 1)
                                <form action="{{route('order.index')}}" method="GET" style="border:0px solid black;display: inline-block;">
                                    <input type="hidden" name="status" value="Shipped">
                                    <div class="btn-group">
                                      <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background:#24a0ed; color: white;">
                                       @if($oldStatus == "Shipped")
                                       <u>Shipped</u>
                                       @else
                                       Shipped
                                       @endif
                                      </button>
                                      <div class="dropdown-menu">
                                        <button name="order" class="dropdown-item" type="submit" value="date_placed">All
                                        @if($oldStatus == "Shipped")
                                        <i class="fas fa-caret-left"></i>
                                        @endif
                                        </button>
                                        <div class="dropdown-divider"></div>
                                        <button name="arrangement" class="dropdown-item" type="submit" value="ASC">Ascending
                                        @if($oldArrangement == 'ASC' && $oldStatus == "Shipped") 
                                        <i class="fas fa-caret-left"></i>
                                        @endif
                                        </button>

                                        <button name="arrangement" class="dropdown-item" type="submit" value="DESC">Descending 

                                        @if($oldArrangement == 'DESC' && $oldStatus == "Shipped")     
                                        <i class="fas fa-caret-left"></i>
                                        @endif
                                       </button>
                                      </div>
                                    </div>
                                </form>
                                @endif
                                <form action="{{route('order.index')}}" method="GET" style="border:0px solid black;display: inline-block;">
                                    <input type="hidden" name="status" value="Completed">
                                    <div class="btn-group">
                                      <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background:#24a0ed; color: white;">
                                       @if($oldStatus == "Completed")
                                       <u>Completed</u>
                                       @else
                                       Completed
                                       @endif
                                      </button>
                                      <div class="dropdown-menu">
                                        <button name="order" class="dropdown-item" type="submit" value="date_placed">All
                                        @if($oldStatus == "Completed")
                                        <i class="fas fa-caret-left"></i>
                                        @endif
                                        </button>
                                        <div class="dropdown-divider"></div>
                                        <button name="arrangement" class="dropdown-item" type="submit" value="ASC">Ascending
                                        @if($oldArrangement == 'ASC' && $oldStatus == "Completed") 
                                        <i class="fas fa-caret-left"></i>
                                        @endif
                                        </button>

                                        <button name="arrangement" class="dropdown-item" type="submit" value="DESC">Descending 
                                           
                                        @if($oldArrangement == 'DESC' && $oldStatus == "Completed")     
                                        <i class="fas fa-caret-left"></i>
                                        @endif
                                       </button>
                                      </div>
                                    </div>
                                </form>

                                @if(Auth::check() && auth()->user()->is_admin == 1)
                                <form action="{{route('order.index')}}" method="GET" style="border:0px solid black;display: inline-block;">
                                    <input type="hidden" name="status" value="Dispute">
                                    <div class="btn-group">
                                      <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background:#24a0ed; color: white;">
                                       @if($oldStatus == "Dispute")
                                       <u>Dispute</u>
                                       @else
                                       Dispute
                                       @endif
                                      </button>
                                      <div class="dropdown-menu">
                                        <button name="order" class="dropdown-item" type="submit" value="date_placed">All 
                                        @if($oldStatus == "Dispute")
                                        <i class="fas fa-caret-left"></i>
                                        @endif
                                        </button>
                                        <div class="dropdown-divider"></div>
                                       <button name="arrangement" class="dropdown-item" type="submit" value="ASC">Ascending
                                        @if($oldArrangement == 'ASC' && $oldStatus == "Dispute") 
                                        <i class="fas fa-caret-left"></i>
                                        @endif
                                        </button>

                                        <button name="arrangement" class="dropdown-item" type="submit" value="DESC">Descending 
                                           
                                        @if($oldArrangement == 'DESC' && $oldStatus == "Dispute")     
                                        <i class="fas fa-caret-left"></i>
                                        @endif
                                       </button>
                                      </div>
                                    </div>
                                </form>
                                @endif
                                @if(Auth::check() && auth()->user()->is_admin == 1)
                                <form action="{{route('order.index')}}" method="GET" style="border:0px solid black;display: inline-block;">
                                    <input type="hidden" name="status" value="Cancelled">
                                    <div class="btn-group">
                                      <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background:#24a0ed; color: white;">
                                       @if($oldStatus == "Cancelled")
                                       <u>Cancelled</u>
                                       @else
                                       Cancelled
                                       @endif
                                      </button>
                                      <div class="dropdown-menu">
                                        <button name="order" class="dropdown-item" type="submit" value="date_placed">All 
                                        @if($oldStatus == "Cancelled")
                                        <i class="fas fa-caret-left"></i>
                                        @endif
                                        </button>
                                        <div class="dropdown-divider"></div>
                                       <button name="arrangement" class="dropdown-item" type="submit" value="ASC">Ascending
                                        @if($oldArrangement == 'ASC' && $oldStatus == "Cancelled") 
                                        <i class="fas fa-caret-left"></i>
                                        @endif
                                        </button>

                                        <button name="arrangement" class="dropdown-item" type="submit" value="DESC">Descending 
                                           
                                        @if($oldArrangement == 'DESC' && $oldStatus == "Cancelled")     
                                        <i class="fas fa-caret-left"></i>
                                        @endif
                                       </button>
                                      </div>
                                    </div>
                                </form>
                                @endif
                                <form action="{{route('order.index')}}" method="GET" style="border:0px solid black;display: inline-block;">
                                    @csrf
                                   <input class="form-control"  placeholder="Search Order Here..." type="text" name="search" required="" style="display:inline-block; width: fit-content;">
                                   <button class="btn btn-primary" type="submit" style="display:inline-block; margin-bottom:3px"><i class="fas fa-search"></i></button>
                                </form>




                                    <div class="table-responsive text-center">
                                        <table class="table">
                                            <thead style="background: #031131;">
                {{--  COLOMN NAME --}}
                                                <tr>
                                                    <th style="color: rgb(255,255,255);">Order Code</th>
                                                    <th style="color: rgb(255,255,255);">Date Placed</th>
                                                    <th style="color: rgb(255,255,255);">Date Shipped</th>
                                                    <th style="color: rgb(255,255,255);">Price</th>
                                                    <th style="color: rgb(255,255,255);">Cutomer</th>
                                                    <th style="color: rgb(255,255,255);">Status</th>
                                                    @if($oldStatus == "Shipped" || $oldStatus == null)
                                                    <th style="color: rgb(255,255,255); width: 200px;">Ship By</th>
                                                    @endif
                                                    <th style="color: rgb(255,255,255);width: 130px;">Action</th>
                                                </tr>

                                            </thead>
                                            <tbody>
                                            
                {{-- START LOOP HERE --}}
                                        @foreach($orders as $order)

                                            <tr>
                                             @php
                                                $price = 0;
                                                foreach ($order->items as $item) 
                                                
                                                    $price += $item->price * $item->pivot->quantity;
                                                
                                             @endphp
                                                <td style="color: rgb(0,0,0);">{{ $order->code}}</td>

                                                <td style="color: rgb(0,0,0);">
                                                    @php
                                                    $date=date_create($order->date_placed);
                                                    @endphp
                                                    {{date_format($date,"M-d-Y h:i:s a")}}</td>
                                                <td style="color: rgb(0,0,0);">
                                                    {{ $order->date_shipped != "" || $order->date_shipped != null? date_format(date_create($order->date_shipped),"M-d-Y h:i:s a"): "----"  }}</td>



                                                <td style="color: rgb(0,0,0);">₱ {{ number_format($price, 2, '.', ',') }}</td>

                                                <td style="color: rgb(0,0,0);">{{ $order->customer->fname}} {{$order->customer->lname}}</td>

                                                
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
                                                    if($order->status == "Confirmed"|| $order->status == "Reject Cancellation"){
                                                       $color ="#3ebf17";
                                                        }
                                                    if($order->status == "Shipped"){
                                                       $color ="#e08312";
                                                        }
                                                        if($order->status == "Dispute"){
                                                       $color ="Red";
                                                        }
                                                    if($order->status == "Completed" || $order->status == "Cancelled"){
                                                        $color ="#fff";
                                                        $text = "Black";
                                                        $border = "1px Solid Black";
                                                        $dropdown = "";
                                                        $dropdownContent = "";
                                                        }
                                                   if ($order->status == "Cancelled") {
                                                      $color ="#bdb9b9";
                                                   }


                                                    @endphp
                                            <form action="{{route('order.updateStatus', $order->orderinfo_id)}}" method="post">
                                                        @csrf

                                                 <input type="hidden" name="user_id" value="{{$order->customer->user_id}}">       
                                                

                                                    <div class="dropdown">
                                                      <button type="button" 
                                                      class="btn btn {{$dropdown}}" 
                                                      type="button" id="dropdownMenuButton" data-toggle="{{$dropdownContent}}" aria-haspopup="true" 
                                                      aria-expanded="false" 
                                                      style="background:{{$color}};
                                                      color: {{$text}}; 
                                                      border: {{$border}}; 
                                                      width: 115px">
                                                      {{ $order->status == "Reject Cancellation"?"Confirmed":$order->status }}
                                                      </button>
                                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    @if( $order->status == 'New Order')
                                                        <button type="submit" name="newStatus" class="dropdown-item" value="Confirmed">Confirmed</button>

                                                        <button type="submit" name="newStatus" class="dropdown-item" value="Shipped">Shipped</button>

                                                        <button type="submit" name="newStatus" class="dropdown-item" value="Completed">Completed</button>

                                                    @endif
                                                    @if( $order->status  == 'Confirmed' || $order->status  == 'Reject Cancellation')

                                                    @if(auth()->user()->is_admin == 1)                                                         
                                                          <label for="rider">Choose rider:</label>
                                                            <input list="riders" name="rider" id="rider" style="width:157px">

                                                            <datalist id="riders">
                                                        @foreach($users as $user)
                                                              <option value="{{$user->user_id}}">{{$user->name}}</option>
                                                        @endforeach
                                                            </datalist>


                                                          <button type="submit" class="btn btn-primary" name="newStatus" class="dropdown-item" value="Shipped" style="margin-top:5px">Ship Now</button>
                                                    @endif
                                                       
                                                    @endif
                                                    @if( $order->status  == 'Shipped')
                                                         <button type="submit" name="newStatus" class="dropdown-item" value="Completed">Completed</button>
                                                    @endif
                                                    @if( $order->status  == 'Dispute')
                                                         <button type="submit" name="newStatus" class="dropdown-item" value="Dispute">View Dispute</button>
                                                    @endif
                                                     @if( $order->status  == 'Completed')
                        
                                                    @endif
                                                       @if( $order->status  == 'Cancelled')
                        
                                                    @endif

                                                      </div>
                                                    </div>
                                                </form>

                                            </td>
                                            
                                           @if($oldStatus == "Shipped") 
                                                @php
                                                    $deliveryId = "";
                                                    $deliveryName = "";
                                                    foreach ($deliveryMan as $id => $name) {
                                                        if($order->delivery_id == $id){
                                                            $deliveryId = $id;
                                                            $deliveryName = $name;
                                                        }
                                                    }
                                                @endphp

                                                <td style="color: rgb(0,0,0);"> {{$deliveryId != ""? "#ID".$deliveryId." - ":null }} {{ $deliveryName}}</td> 
                                            @endif    
                                                                                   



                                                <td class="text-center">
                                        

                                                    <a href="{{route('order.show', $order->orderinfo_id )}}" class="btn btn-primary" type="button" style="color: rgb(255, 255, 255);background: #00674c;"><i class="fa fa-eye"></i>&nbsp;View</a>

                                                 
                                                </td>
                                             </tr>
                                        
                                        
                                        @endforeach
                {{-- END LOOP HERE --}}
  


                                            </tbody>
                                            
                                        </table>
                                       {{--  {{ $orders->links() }} --}}
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
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/theme.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>

</html>