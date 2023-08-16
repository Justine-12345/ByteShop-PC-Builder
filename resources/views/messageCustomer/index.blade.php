@php
use App\Star;
use App\Converter;

@endphp
@extends('layouts.master')
@section('title')
 Builder| Options
@endsection
@section('content')

<link rel="stylesheet" type="text/css" href="{{URL::to('src/css/shoppingIndex.css')}}"> 
<link rel="stylesheet" type="text/css" href="{{URL::to('src/css/buildOption.css')}}"> 
<link rel="stylesheet" type="text/css" href="{{URL::to('src/css/profile.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::to('src/css/createmessage.css')}}">
<div>
    <hr>
<div class="row text-left" style="width:100%; margin-left: ;position: static;">
    <div class="col-xl" style="margin-left:12%">
      <h3>Messages to Admin</h3>  
  
<form action="{{route('messagecustomer.index')}}">
    @csrf
     
    <button type="submit" value="{{auth()->user()->user_id}}" name="to_user" class="button  inbox" style="margin-bottom:10px;background:{{$tab == "Inbox"?"#0088ff":null}};">Inbox</button>
  
    <button type="submit" value="{{auth()->user()->user_id}}" name="user_id" class="button  sent" style="background:{{$tab == "Sent Message"?"#0088ff":null}};">Sent Messages</button>

     <a href="{{route('messagecustomer.create')}}"><button type="button" class="button  email" style="margin-bottom:10px;"> Send Message to Admin</button></a>
</form>

    </div>
</div>
@if($messages->first() === null)
<div class="row" style="width:100%">
    <div class="col-lg-6 offset-lg-1" style="margin-left: 160px">
        <h3>Empty {{$tab}} !!!</h3>
    </div>
</div>

@endif



<br>
@if($message = Session::get('success'))
<div class="alert alert-primary alert-dismissible fade show" role="alert" style="margin-right: 100px; margin-left: 100px">
  <strong style="color:darkblue;">{{$message}}</strong> 
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true" style="color: darkblue;">&times;</span>
  </button>
</div>
@endif        
     <div class="row" style="width:unset; max-width:100%" >   
           
                    @foreach($messages as $message)
                          <div class="col-lg justify-content-center" style="width: 80%; margin-bottom: 10px;margin-left: 12%;">
                            <a href="{{route('messagecustomer.show', $message->message_id)}}" style="text-decoration: none; margin-bottom: 5px;">
                            <div class="col glass" style="height: unset; width: 150vh; padding: 20px;padding-bottom: 30px;">
                            @if($message->message_label != "Cancel" && $tab == "Sent Message")
                                <form action="{{route('messagecustomer.destroy', $message->message_id)}}" method="post" style="float:right;"> 
                                    @csrf
                                   {{ method_field('DELETE') }}
                                    <button type="submit" style="background: inherit; border: 0px solid white; display: inline-block; "><i class="fas fa-times-circle" style="font-size: 16px;"></i></button>
                                </form> 
                            @endif

                            @if($message->is_seen === null && $tab === "Inbox")
                            <b> <i class="fas fa-inbox"></i>
                                {{$message->message_title === null? "No Title": ucwords($message->message_title)}}</b>
                                <br>
                            <span style="  white-space: nowrap;width:90%;display: inline-block;overflow: hidden;text-overflow: ellipsis; font-size: 13px;color: #fff; margin-left:20px"><b> {{$message->message_content}}</b></span>
                            @else
                        <div>
                            <span style="width: fit-content;">
                            @if($tab === "Inbox")
                            <i class="fas fa-inbox"></i>
                            @else
                                <i class="fas fa-paper-plane"></i> 
                            @endif

                                {{$message->message_title === null? "No Title": ucwords($message->message_title)}}</span>
                                <br>
                            <span style="  white-space: nowrap;width:90%;display: inline-block;overflow: hidden;text-overflow: ellipsis; font-size: 13px;color: #d7d9db;margin-left:20px">  {{$message->message_content}} 

                            </span>
                        </div>
                            @endif
                            <b style="float:right;"></b>


                            <small style="float: right; padding-bottom: 5px;">{{date_format(date_create($message->message_date),"M-d-Y h:i:s a")}}</small>
                                </div>
                            </a>
                         </div>   
                    @endforeach

                
            </div>

@endsection