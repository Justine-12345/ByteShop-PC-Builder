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


            <div class="row justify-content-center  text-center" style="width: 100%;">
            
                 <div class="col-md-4 glass" style="padding-top: 40px;">

                <form action="{{route('pc.getNew')}}" method="post">
                    @csrf
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Build Name <i class="fas fa-pen-alt"></i></label>
                    <input name="build_name" class="form-control" id="exampleFormControlTextarea1" required="">
                </div>
                  <div class="form-group text-center">
                      <button class="btn btn-primary" type="submit" style="margin-left: auto;">Submit</button>
                  </div>
                </form> 
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