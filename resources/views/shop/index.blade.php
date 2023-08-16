@php
use App\Star;
use App\Converter;
@endphp
@extends('layouts.master')
@section('title')
 laravel shopping cart
@endsection
@section('content')

<link rel="stylesheet" type="text/css" href="{{URL::to('src/css/shoppingIndex.css')}}"> 
<link rel="stylesheet" type="text/css" href="{{URL::to('src/css/buildOption.css')}}">
<style type="text/css">
</style>


<div class="col-sm-12">
<div class="searchbar">

<form action="{{route('product.index')}}" method="get">
    @csrf
  <input style="color: #8a8a8a" name="search" type="search" class="searchbar--input" value="{{$search}}" placeholder="Search...">
  <div class="searchbar--buttons">
    <input style="color:#8a8a8a; background: ##949292;" type="submit" class="searchbar--submit" value="Search">
    <div class="select-wrapper">
    <input type="hidden" name="sort" value="{{$sort}}">
     <input type="hidden" name="order" value="{{$orderby}}">
      <select class="searchbar--select" name="category">
    <option value="0" selected style="color:#8a8a8a">All Categories</option>
    @foreach($categories as $id => $name)
      @if($catSearch == $id)
      <option value="{{$id}}" style="color:#8a8a8a;" selected="">{{ucwords($name)}}</option>
      @else
       <option value="{{$id}}" style="color:#8a8a8a;">{{ucwords($name)}}</option>
      @endif
    @endforeach
    </select>
    </div>
  </div>
</form>


</div>
</div>
<br>

<div class="row justify-content-center" style="width:100%">
    <div class="col-lg-2 ">
  <a class='{{$sort == "" ? "holo-btn-fed" : "holo-btn"}} text-center' href='{{route('product.index',['sort'=>'','order'=>$orderby])}}' style="margin-bottom:10px">
    <span class='cta-d' style="margin-bottom: 5px;">  All 
        @if($orderby == "ASC" && $sort == "All")
        <i class="fas fa-sort-up"></i> 
        @elseif(($orderby == "DESC" && $sort == "All"))
        <i class="fas fa-sort-down"></i>
        @endif
    </span>
    <span class='skew top' ></span>
    <span class='skew bottom'></span>
</a> 
  </div>
  <div class="col-lg-2 ">

  <a class='{{$sort == "Rate" ? "holo-btn-fed" : "holo-btn"}} text-center' href='{{route('product.index',['sort'=>'Rate','order'=>$orderby, 'search'=>$search, 'category'=>$catSearch])}}' style="margin-bottom:10px">
    <span class='cta-d' style="margin-bottom: 5px;">  Rate 
    @if($sort === "Rate")
        @if($orderby == "ASC")
        <i class="fas fa-sort-up"></i> 
        @elseif($orderby == "DESC")
        <i class="fas fa-sort-down"></i>
        @endif
    @endif
    </span>
    <span class='skew top' ></span>
    <span class='skew bottom'></span>
</a> 
  </div>
   <div class="col-lg-2 ">
  <a class='{{$sort == "Price" ? "holo-btn-fed" : "holo-btn"}}  text-center' href='{{route('product.index',['sort'=>'Price','order'=>$orderby, 'search'=>$search, 'category'=>$catSearch])}}' style="margin-bottom:10px">
    <span class='cta-3' style="margin-bottom: 5px">  Price
          @if($orderby == "ASC" && $sort == "Price")
        <i class="fas fa-sort-up"></i> 
        @elseif($orderby == "DESC" && $sort == "Price")
        <i class="fas fa-sort-down"></i>
        @endif
    </span>
    <span class='skew top'></span>
    <span class='skew bottom'></span>
</a> 
  </div>
  <div class="col-lg-2 ">
  <a class='{{$sort == "Solds" ? "holo-btn-fed" : "holo-btn"}} text-center' href='{{route('product.index',['sort'=>'Solds','order'=>$orderby, 'search'=>$search, 'category'=>$catSearch])}}' style="margin-bottom:10px">
    <span class='cta-3' style="margin-bottom: 5px">  Solds
        @if($orderby == "ASC" && $sort == "Solds")
        <i class="fas fa-sort-up"></i> 
        @elseif($orderby == "DESC" && $sort == "Solds")
        <i class="fas fa-sort-down"></i>
        @endif
    </span>
    <span class='skew top'></span>
    <span class='skew bottom'></span>
</a> 
  </div>
</div>




@if($searchCount != "" && ($catSearch == null || $catSearch == "0"))
<div class="row justify-content-center" style="width:80%; margin-left:14%">
    <div class="col">
        <h4>{{$searchCount}}</h4>
    </div>
</div>
</br>
@elseif($searchCount != "" && ($catSearch != null && $catSearch != "0"))
    @php
    $categoryId = 0;
    $i = 0;
        foreach ($products as $product) {
                foreach($brands as $brand){
                     if($brand->brand_id == $product->item->brand_id){
                        $categoryId = $brand->category->category_id;
                     }
                }
                if ($catSearch == $categoryId) {
                    $i++;
                }

        }
    @endphp

<div class="row justify-content-center" style="width:80%; margin-left:14%">
    <div class="col">
        <h4>{{ $i > 1? $i." results found for '".$search."' ": $i." result found for '".$search."' "}}</h4>
    </div>
</div>
</br>
@endif







   @foreach ($products->chunk(5) as $productChunk)
        <div class="row justify-content-center" style="width:100%">
            @foreach ($productChunk as $product)
             @php 
                  $productBrand = "";
                  $categoryId = 0;
                  if ($product->item != "" ||$product->item != null) {
                        foreach($brands as $brand){
                  
                     if($brand->brand_id == $product->item->brand_id){
                        $productBrand = $brand->category->category_name;
                        $categoryId = $brand->category->category_id;
                     }
                  }
                  }
              @endphp
@if($catSearch != null && $categoryId == $catSearch)
<div class=" col-lg-2" style="border: 0px solid white;">
<a href="{{route('product.showTobuy',['0'=>$product->item->item_id, '1'=>$productBrand])}}" style="text-decoration: none;">
    <div class="glass" style="margin-bottom: 20px; min-width: 100%; max-width: 100%; max-height:100%">
        <div class="row">
            <div class="col-lg-12" style="width:200%">
               
                <img src="{{ $product->item->image != '' || $product->item->image != null ? asset('src/images/products/'.$product->item->image): url('/noImg.png') }}" onerror="this.src='{{url('/noImg.png')}}'" style="width:100%">
            </div> 
            <div class="col-lg">
                <h6 style="padding-left: 10px; font-size: 12px; margin-top: 5px;">{{ucwords($product->item->title)}}<br>
                    <span style="margin: 5px; display: block;"></span>
                    @if($productBrand != "")
                     <small style="font-size: 10px; border: 1px solid; padding: 2px; border-radius: 5px;" >{{ucwords($productBrand)}}</small>
                     @endif
                    @foreach($reviews as $review)
                        @if($product->item->item_id == $review->item_id)

                     <small style="margin-left: 5px;"> {!!Star::display($review->rating)!!}</small>
                     @endif
                    @endforeach
                </h6>     
            </div> 
        </div>

        <div class="row">
            <div class="col-lg">
            <h6 style="padding-left: 10px; color: #ffcb0d">₱ {{ number_format( $product->item->price,2,'.',",")}} <small style="float: right; margin-right: 8px"><i>Stocks: {!!Converter::thousand($product['quantity'])!!}</i><br>
           <i style="font-size: 11px">
            Sold:
            @php
                $i = 0;
            @endphp
            @foreach($solds as $sold)
                @if($sold->item_id == $product->item->item_id)
                @php
                $i = 1;
                @endphp
                 {!!Converter::thousand($sold->quantity)!!}   
                @endif
            @endforeach
             @if($i == 0)
                    0
                @endif
             </i>
            </small>
            </h6>
            </div>
        </div>
    </div>
</a>
</div>
@endif

@if($catSearch == null || $catSearch == "0")
<div class=" col-lg-2" style="border: 0px solid white;">
<a href="{{route('product.showTobuy',['0'=>$product->item->item_id, '1'=>$productBrand])}}" style="text-decoration: none;">
    <div class="glass" style="margin-bottom: 20px; min-width: 100%; max-width: 100%; max-height:100%">
        <div class="row">
            <div class="col-lg-12" style="width:200%">
               
                <img src="{{ $product->item->image != '' || $product->item->image != null ? asset('src/images/products/'.$product->item->image): url('/noImg.png') }}" onerror="this.src='{{url('/noImg.png')}}'" style="width:100%">
            </div> 
            <div class="col-lg">
                <h6 style="padding-left: 10px; font-size: 12px; margin-top: 5px;">{{ucwords($product->item->title)}}<br>
                    <span style="margin: 5px; display: block;"></span>
                    @if($productBrand != "")
                     <small style="font-size: 10px; border: 1px solid; padding: 2px; border-radius: 5px;" >{{ucwords($productBrand)}}</small>
                     @endif
                    @foreach($reviews as $review)
                        @if($product->item->item_id == $review->item_id)

                     <small style="margin-left: 5px;"> {!!Star::display($review->rating)!!}</small>
                     @endif
                    @endforeach
                </h6>     
            </div> 
        </div>

        <div class="row">
            <div class="col-lg">
            <h6 style="padding-left: 10px; color: #ffcb0d">₱ {{ number_format( $product->item->price,2,'.',",")}} <small style="float: right; margin-right: 8px"><i>Stocks: {!!Converter::thousand($product['quantity'])!!}</i><br>
           <i style="font-size: 11px">
            Sold:
            @php
                $i = 0;
            @endphp
            @foreach($solds as $sold)
                @if($sold->item_id == $product->item->item_id)
                @php
                $i = 1;
                @endphp
                 {!!Converter::thousand($sold->quantity)!!}   
                @endif
            @endforeach
             @if($i == 0)
                    0
                @endif
             </i>
            </small>
            </h6>
            </div>
        </div>
    </div>
</a>
</div>
@endif
                      @endforeach
                    </div>
                        @endforeach
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
