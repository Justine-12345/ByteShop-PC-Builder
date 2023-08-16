@extends('layouts.master')
@section('title')
    Laravel Shopping Cart
@endsection
@section('content')
    @if(Session::has('cart'))
<style type="text/css">
    .row{
        width: 100%;
    }
</style>
<link rel="stylesheet" type="text/css" href="{{URL::to('src/css/shoppingIndex.css')}}">
    {{-- {{ dd(Session::get('cart')) }} --}}
        <div class="row">
            <div class="col-xl-5" style="margin:auto">
                <ul class="list-group">
                    @php
                        $totalPrice = 0;
                    @endphp
                    @foreach($products as $product)
                           
                                {{-- {{dd($brands)}} --}}
                            <div class="row glass" style="list-style: none; width: unset; height: 23vh; margin-bottom:10px;">

                             @php 
                                      $productBrand = "";

                                      if ($product != "" ||$product != null) {
                                            foreach($brands as $brand){
                                         if($brand->brand_id == $product['item']['brand_id']){
                                            $productBrand = $brand->category->category_name;
                                         }

                                      }    
                                      }
                              @endphp
                            <div class="col-md-">
                                <a href="{{route('product.showTobuy',['0'=>$product['item']['item_id'], '1'=>$productBrand])}}" >
                                 <img src="{{$product['item']['image'] != '' || $product['item']['image'] != null ? asset('src/images/products/'.$product['item']['image']): url('/noImg.png') }}" onerror="this.src='{{url('/noImg.png')}}'" style="height: 23vh; border-bottom-left-radius: 2rem; border-top-right-radius: 0rem;">
                                        </a>
                             </div>
                   
                             <div class="info col-md-5" style="padding-top:20px;">
                                <div class="row">
                                    <div class="col-md">
                                     <strong style="color:#031131; font-size: 13px;">Name: {{ $product['item']['title'] }}</strong>
                                     </div>
                                </div>
                         
                                <div class="row">
                                    <div class="col-md">
                                     <strong style="color:#031131; font-size: 13px;">Quantity: {{ $product['qty'] }}</strong>
                                     </div>
                                </div>

                                 <div class="row">
                                    <div class="col-md">
                                     <strong style="color:#031131; font-size: 13px;">Price each: ₱ {{number_format($product['item']['price'] ,2,'.',",")}}</strong>
                                     </div>
                                </div>
                                 <div class="row">
                                    <div class="col-md">
                                     <strong style="color:#031131; font-size: 13px;">Total Price: ₱ {{number_format($product['item']['price']  * $product['qty'],2,'.',",")}}</strong>
                                     </div>
                                </div>
                           </div>
                   <div class="btn-mod">
                           <div class="btn-group" style="float: right; margin-right:0px; position: relative; left: -10px;">
                            <a href="{{ route('product.addByOne',['id'=>$product['item']['item_id']]) }}" style="border:0px solid white; height: 35px;"><button style="box-shadow: unset;" class="btn btn-default btn-circle"><i class="fas fa-plus-circle" style="font-size: 24px;"></i>
                            </button></a>
                            </div>

                             <div class="btn-group" style="float: right; margin-right:5px; position: relative; left:-10px">
                            <a href="{{ route('product.reduceByOne',['id'=>$product['item']['item_id']]) }}" style="height:35px"><button style="box-shadow: unset;" class="btn btn-default btn-circle"><i class="fas fa-minus-circle" style="font-size: 24px; margin-left"></i>
                            </button></a>
                            </div>

                            <div class="btn-group" style=" border: 0px solid white;">
                           <a class="close-button" href="{{ route('product.remove',['id'=>$product['item']['item_id']]) }}" style="right: unset; top: unset;bottom: unset;left: unset; margin-top: 7px; left:-10px">Close</a>
                            </div>

                    </div>
                        </div>
                                 @php
                                    $totalPriceItem = $product['item']['price'] * $product['qty'];
                                     $stock=$product['item']['stock']['quantity'];
                                     $stockText = "white";
                                     if ($stock <= 0) {
                                         $stockText = "red";
                                     }
                                @endphp
                           
                             @php
                $totalPrice = $totalPrice + $totalPriceItem;
                @endphp
                    @endforeach
                </ul>
            </div>
        </div>
    
        <div class="row">
            <div class="col-lg-5" style="margin:auto">
                <strong>Total: ₱ {{number_format( $totalPrice,2,'.',",")}}</strong>
            </div>
        </div>
        <hr>
        <div class="row">
         <div class="col-lg-5" style="margin:auto">
                <a href="{{ route('checkout') }}" type="button" class="btn btn-success">Checkout</a>
            </div>
        </div>
  
    @else
    <link rel="stylesheet" type="text/css" href="{{URL::to('src/css/shoppingIndex.css')}}">
        <div class="row text-center" style="width:100%">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <h2 style="margin: 10px">No Items in Cart!</h2>
            </div>
        </div>
    @endif
@endsection
