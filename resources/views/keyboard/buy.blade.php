@php 
use App\Star;
use App\Converter;
$converter = new Converter;
@endphp
@extends('layouts.master')
@section('title')
 laravel shopping cart
@endsection
@section('content')

<link rel="stylesheet" type="text/css" href="{{URL::to('src/css/shoppingIndex.css')}}"> 

<body id="page-top">
    <div id="wrapper">
{{--      @include('partials.admin_header') --}}
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
  {{--   @include('partials.admin_header2') --}}
                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="mb-0"></h3>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-xl-12 offset-xl-0">
                            <div class="card shadow mb-4 glass" style="width:100%; height: unset; padding-top: 10px;">
                {{-- MODIFY START --}}
              
                                <div class="col">
                                <h1 class="col text-center" style="color: white;margin-top: 10px;">{{ucwords($keyboards[0]->title)}} <br>{!!Star::display($review->review_rating)!!}</h1>
                                </div>
                                <div class="col text-center"><img style="color: rgb(133, 135, 150);border-radius: 5%;width: 300px;height: 300px;border: 10px solid #031131 ; margin: 20px;" src="{{$keyboards[0]->image != "" || $keyboards[0]->image != null? asset('src/images/products/'.$keyboards[0]->image):url('/noImg.png') }}" onerror="this.src='{{url('/noImg.png')}}'">
                                </div>
                        <form action="{{ route('product.addToCart', ['id'=>$keyboards[0]->item_id]) }}" method="GET">
                    @if($fromBuilder == null)
                        <div class="row justify-content-center">
                            
                                @csrf
                                <div class=" form-group form-spinner">
                                <div class="spinner-control">
                                   <span style="margin-right: 5px">Qty: </span> 
                                        <button class="btn btn-primary btn-decrement" type="button"><i class="fas fa-minus"  ></i></button>
                                        <input type="text" name="quantity" data-type="number" step="1" max="{{$keyboards[0]->quantity}}" min="1" value="1"  id="spinner1">
                                        <button class="btn btn-primary btn-increment" type="button"><i class="fas fa-plus" ></i></button>
                                    </div>
                                </div>
                                
                                
                                   <button type="submit" class="btn-hover color-8" style="font-size: 10px; margin-top: unset; left: -80px; position: relative;"><i class="fas fa-cart-plus"></i> Add To Cart</button>
                           
                           </div>
                    @endif
                                 </form> 
                            
                            @include('number-spinner')
                                <br>
                     {{-- MODIFY END --}}
                        <div class="col">
                               @if($message = Session::get('success')) 

                                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="width: 100%">
                                  <strong style="color:red;">{{$message}} <i class="fas fa-exclamation-triangle" style="color: red;"></i></strong> 
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true" style="color: red;">&times;</span>
                                  </button>
                                </div>
                             @endif 
                                    <div class="table-responsive" style="text-align:;color: white;">
                                        <table class="table" style="text-align:center">
                                            <thead style="background: #031131;color: rgb(248,249,255);">
                                                <tr>
                                                    <th style="color: rgb(255,255,255);">Category</th>
                                                    <th style="color: rgb(255,255,255);">Specifications</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="color: white;">Brand</td>
                                                    <td style="color: white;">{{ $keyboards[0]->brand_name }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: white;">Category</td>
                                                    <td style="color: white;">{{ $keyboards[0]->category_name }}</td>
                                                </tr>
                                                 <tr>
                                                    <td style="color: white;">Sold</td>
                                                    <td style="color: white;">
                                                    @if($sold != null)
                                                        {!!Converter::thousand($sold->quantity)!!}
                                                    @else
                                                    0
                                                    @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="color: white;">Width</td>
                                                    <td style="color: white;">{{ $keyboards[0]->keyboard_width }}"</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: white;">Length</td>
                                                    <td style="color: white;">{{ $keyboards[0]->keyboard_length }}"</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: white;">Depth</td>
                                                    <td style="color: white;">{{ $keyboards[0]->keyboard_depth }}"</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: white;">Weight</td>
                                                    <td style="color: white;">{{ $keyboards[0]->keyboard_weight }} pounds</td>
                                                </tr> 
                                                <tr>
                                                    <td style="color: white;">Wired</td>
                                                    <td style="color: white;">{{ $keyboards[0]->keyboard_wired }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: white;">Style of Keys</td>
                                                    <td style="color: white;">{{ $keyboards[0]->style_keys }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: white;">Full Keyboard</td>
                                                    <td style="color: white;">{{ $keyboards[0]->full_keyboard }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: white;">Color</td>
                                                    <td style="color: white;">{{ $keyboards[0]->color }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: white;">Battery</td>
                                                    <td style="color: white;">{{ $keyboards[0]->battery }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: white;">Extra Features</td>
                                                    <td style="color: white;">{{ $keyboards[0]->extra_features }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: white;">Layout</td>
                                                    <td style="color: white;">{{ $keyboards[0]->keyboard_layout }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: white;">Description</td>
                                                    <td style="color: white;">{{ $keyboards[0]->keyboard_description }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: white;">Stocks</td>
                                                    <td style="color: white;">{{ $keyboards[0]->quantity }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: white;">Price</td>
                                                    <td style="color: white;">₱ {{ number_format($keyboards[0]->price, 2, '.', ',') }}</td>
                                                </tr>
                                            </tbody>
                                                                                {{-- REVIEW START --}}
                                     <thead style="background: #031131;color: rgb(248,249,255);">
                                                <tr>
                                                    <th colspan="2" style="color: rgb(255,255,255);"> @if($reviews->first() == null)
                                                                        No
                                                               @endif Reviews</th>
                                                </tr>
                                            </thead>                                        </table>
                                           <ul>
                                @foreach($reviews  as $rev)
                                <li class="glass" style="list-style: none; width: unset; height:unset; margin-bottom:10px; padding-bottom: 20px;">
                                    <div class="row" style="width:100%">
                                      <div class="col-lg-1" style="margin-left:50px">
                                          <img src="{{$rev->user->image != '' || $rev->user->image != null ? asset('storage/profilePic/'.$rev->user->image): url('/noImg.png') }}" onerror="this.src='{{url('/noImg.png')}}'" style="height: 11vh;width: 11vh; border-radius: 50%; margin-top:20px ">
                                      </div>

                                      <div class="col" style="padding-top:20px; padding-left: 30px;">
                                        <div class="row">
                                            <div class="col">
                                            {!!Star::display($rev->review_rating)!!}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                            <b style=" color:#031131 ;">{{ ucwords($rev->user->name)}}</b>
                                        </div>

                                        </div>
                                        <div class="row">
                                            <div class="col">
                                             <span style=" color:#031131 ;">{{$rev->review_content}}</span>
                                         </div>
                                             
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                            <small style="color: #3c5796">{{date_format(date_create($rev->review_date),"M-d-Y h:i a")}}</small>
                                        </div>
                                        </div>
                                      </div>
                                    </div>
                                  </li>
                                  @endforeach
                                            </ul>
                            {{-- REVIEW END --}} 
                                    </div>
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
        </div><a class="border rounded d-inline scroll-to-top" href="{{ url()->previous()}}"><i class="fas fa-arrow-left"></i></a>
    </div>
           
<script type="text/javascript">
    feather.replace();

document.querySelectorAll(".player__dock").forEach((el) => {
  el.addEventListener("click", (e) => {
    document.querySelector(".player").classList.toggle("player--docked");
  });
});



</script>
<script type="text/javascript">
  
  const toggleBtn = document.getElementsByClassName('togglebtn')[0]
const navbarLinks = document.getElementsByClassName('navbar-links')[0]

toggleBtn.addEventListener('click', () => {
    navbarLinks.classList.toggle('active')
})
</script>
<script type="text/javascript">
  
$(document).ready(function(){
    $("#search").focus(function() {
      $(".search-box").addClass("border-searching");
      $(".search-icon").addClass("si-rotate");
    });
    $("#search").blur(function() {
      $(".search-box").removeClass("border-searching");
      $(".search-icon").removeClass("si-rotate");
    });
    $("#search").keyup(function() {
        if($(this).val().length > 0) {
          $(".go-icon").addClass("go-in");
        }
        else {
          $(".go-icon").removeClass("go-in");
        }
    });
    $(".go-icon").click(function(){
      $(".search-form").submit();
    });
});


</script>
@endsection

