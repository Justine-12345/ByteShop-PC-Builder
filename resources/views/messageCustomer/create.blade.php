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
        <h3>Compose Message To Admin</h3> 
        <hr>  
                <form action="{{route('messagecustomer.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                    <label for="exampleFormControlTextarea1"><h5>Title:</h5></label>
                    <input name="message_title" class="form-control" id="exampleFormControlTextarea1" placeholder="Type here...">
                    <br>

                    <label for="exampleFormControlTextarea1">Do you want to ask something? <i class="fas fa-pen-alt"></i></label>
                    <textarea name="message_content" class="form-control" id="exampleFormControlTextarea1" rows="5" required="" placeholder="Type here..."></textarea>
                  </div>
                  <div class="form-group text-center">
                      <button class="btn btn-primary" type="submit" style="margin-left: auto;">Send</button>
                  </div>
                </form>        
                </div>

                
        </div>
@endsection