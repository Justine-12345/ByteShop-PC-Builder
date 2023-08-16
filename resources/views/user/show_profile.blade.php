
@extends('layouts.master')
@section('content')
<link rel="stylesheet" type="text/css" href="{{URL::to('src/css/signup.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::to('src/css/shoppingIndex.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::to('src/css/buildOption.css')}}">

<style type="text/css">
    option{
        color: black;
    }
    .row{
        width: 60%;
    }
</style>


<h1 style="padding-right: 35px;text-align: center; position: relative;">Profile</h1> 
        @if ($message = Session::get('success')) 
            <div class="alert alert-danger" style="margin-left: 60px; margin-right:60px"> 
            
                    <p style="color: red;">{{ $message }}</p> 
           
            </div>
        @endif  
<div class="row justify-content-center" style="position:relative; border: 0px solid white; width: 100%; padding-left: 200px;"> 


              @if (count($errors) > 0) 
            <div class="alert alert-danger"> 
                @foreach ($errors->all() as $error)
                    <p style="color:red">{{ $error }}</p> 
                @endforeach
             </div>
             @endif
<div class="row justify-content-center" style="border:0px solid white; padding-right: 200px; ">
    <div class="col-lg-12 text-center" style="border:0px solid white;">
        <div class="form-group" id="upload_button">

             <img id="blah" src="{{asset('storage/profilePic/'.$user->image)}}" alt="your image" width="100" height="150"  style="display: none; object-fit:cover; border-radius: 50%; border:5px solid #5bc0de;" onload="this.style.display=''"
                    /><br><br>
        </div>
    </div>
</div>

    <div class="row" >
        <div class="col-lg-6">
            <div class="form-group">
                <label for="fname">First Name : </label>
                <b>{{$user->customer->fname}} </b>
            </div> 
        </div>
        <div class="col-lg-6">
           <div class="form-group">
                <label for="lname">Last Name : </label>
                <b>{{$user->customer->lname}} </b>
           </div>
        </div>      
    </div>

    <div class="row" >
         <div class="col-lg-6">
            <div class="form-group">
                <label for="city">City : </label>
                <b>{{$user->customer->city}}</b>
            </div> 
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="phone">Phone : </label>
                <b>{{$user->customer->phone}}</b>
            </div> 
        </div>
    </div>

    <div class="row" >
        <div class="col-lg-6">
            <div class="form-group">
                <label for="addressline">Address Line : </label>
                <b>{{$user->customer->addressline}}</b>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="zipcode">Zipcode : </label>
                <b>{{$user->customer->zipcode}}</b>
            </div>
        </div>
    </div> 

</div>
<script type="text/javascript">
  
</script>
@endsection