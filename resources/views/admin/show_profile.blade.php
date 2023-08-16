<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard - Brand</title>
    <link rel="stylesheet" href="{{asset('src/assets/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="{{asset('src/assets/fonts/fontawesome-all.min.css')}}">
    <link rel="stylesheet" href="{{asset('src/assets/fonts/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('src/assets/fonts/fontawesome5-overrides.min.css')}}">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

</head>
<style type="text/css">
    option{
        color: black;
    }
    .row{
        width: 60%;

    }
</style>


<body id="page-top">
    <div id="wrapper">
    @if(auth()->user()->is_admin == 1)
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
               
  <div class="row justify-content-center" style="width: 100%">
<h1 style="padding-right: 35px;text-align: center; position: relative;">Profile</h1> 
        @if ($message = Session::get('success')) 
            <div class="alert alert-danger" style="margin-left: 60px; margin-right:60px"> 
            
                    <p style="color: red;">{{ $message }}</p> 
           
            </div>
        @endif  
<div class="row justify-content-center" style="position:relative; border: 0px solid white; width: 100%; padding-left: 160px;"> 


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

             <img id="blah" src="{{asset('storage/profilePic/'.$user->image)}}" alt="your image" width="150" height="150"  style="display: none; object-fit:cover; border-radius: 50%; border:5px solid #5bc0de;" onload="this.style.display=''"
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






  




  </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/theme.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>

</html>
