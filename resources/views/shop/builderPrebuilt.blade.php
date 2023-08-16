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



<div class="row" style="width: 100%;">
    <div class="col-md-6 offset-md-3" >
<a class='holo-btn-fed text-center' href='{{route('pc.getNew')}}' style="margin-bottom:10px">
    <span class='cta-d' style="margin-bottom: 5px"><i class="fas fa-tools"></i>  Build New PC</span>
    <span class='skew top'></span>
    <span class='skew bottom'></span>
<a> 
@if(auth()->user()->is_admin == 0)


@if($isPrebuilt == 1)
<a class='holo-btn-fed text-center' href='{{route('pc.builderOption')}}'>
    <span class='cta-d' style="margin-bottom: 5px">
 <i class="fas fa-user"></i> My Build  
  </span>
    <span class='skew top'></span>
    <span class='skew bottom'></span>
<a> 
@else
<a class='holo-btn-fed text-center' href='{{route('pc.getPrebuilt')}}'>
    <span class='cta-d' style="margin-bottom: 5px"> 
 <i class="fas fa-box-open"></i>  Pre-built PC
    </span>
    <span class='skew top'></span>
    <span class='skew bottom'></span>
<a> 
@endif


@endif

    </div>
</div>

<div>
    <hr>
<div class="row text-center" style="width: 100%">
    <div class="col">
      <h3>Pre-built PC List</h3>  
    </div>
</div>

@if($message = Session::get('success'))
<div class="alert alert-primary alert-dismissible fade show" role="alert" style="margin-right: 100px; margin-left: 100px">
  <strong style="color:darkblue;">{{$message}}</strong> 
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true" style="color: darkblue;">&times;</span>
  </button>
</div>
@endif
<div class="row justify-content-center" style="width: 100%;">
    @foreach($builds as $build)
            <a href="{{route('pc.show',$build->build_id )}}" style="text-decoration: none; margin-bottom: 5px;">
            <div class="col glass" style="height: unset; width: 150vh; padding: 20px;">
            @if(auth()->user()->is_admin == 1)
                <form action="{{route('pc.getDelete', $build->build_id)}}" style="float:left;"> 
                    <button type="submit" style="background: inherit; border: none;"><i class="fas fa-times-circle" style="font-size: 16px;"></i></button>
                </form>
            @endif
            <b>Name: {{$build->build_name}}</b>
            <b style="float:right;"> | ₱ {{number_format($build->total_price,2,'.',"")}}</b>
            <small style="float: right; padding-top: 3px;">{{date_format(date_create($build->build_date),"M-d-Y h:i:s a")}}</small>
                </div>
            </a>
            
    @endforeach

</div>

@endsection