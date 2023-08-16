
@extends('layouts.master')
@section('content')
<link rel="stylesheet" type="text/css" href="{{URL::to('src/css/signup.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::to('src/css/shoppingIndex.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::to('src/css/buildOption.css')}}">

<style type="text/css">
    option{
        color: black;
    }
</style>


<h1 style="padding-right: 35px;text-align: center; position: relative;">Edit Profile</h1> 
        @if ($message = Session::get('error')) 
            <div class="alert alert-danger" style="margin-left: 60px; margin-right:60px"> 
            
                    <p style="color: red;">{{ $message }}</p> 
           
            </div>
        @endif  
<div class="row justify-content-center" style="position:relative; border: 0px solid white; width: 100%;"> 


<form action="{{ route('user.update') }}" method="POST" style="width: 80%; padding: 20px;" enctype="multipart/form-data" > 
            @csrf
              @if (count($errors) > 0) 
            <div class="alert alert-danger"> 
                @foreach ($errors->all() as $error)
                    <p style="color:red">{{ $error }}</p> 
                @endforeach
             </div>
             @endif
<div class="row justify-content-center" style="border:0px solid white;">
    <div class="col-lg-3 text-center" style="border:0px solid white;">
        <div class="form-group" id="upload_button">

             <img id="blah" src="{{asset('storage/profilePic/'.$user->image)}}" alt="your image" width="100" height="150"  style="display: none; object-fit:cover; border-radius: 50%; border:5px solid #5bc0de;" onload="this.style.display=''"
                    /><br><br>

                     <label>
              <input type="file" name="picture"  onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">

              <span class="btn btn-primary">Upload Profile</span>
            </label>
            @if($errors->has('picture'))
            <small class="form-text text-muted"><i>*{{ $errors->first('picture') }}</i></small>
            @endif
        </div>
    </div>
</div>

    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="fname">First Name</label>
                <input type="text" id="fname" name="fname" class="form-control"value="{{old('fname')? old('fname'): $user->customer->fname}}"> 
            </div> 
            @if($errors->has('fname'))
            <small class="form-text text-muted"><i>*{{ $errors->first('fname') }}</i></small>
            @endif
        </div>
        <div class="col-lg-6">
           <div class="form-group">
                <label for="lname">Last Name</label>
                <input type="text" id="lname" name="lname" class="form-control" value="{{old('lname')? old('lname'): $user->customer->lname}}"> 
            </div>
            @if($errors->has('lname'))
            <small class="form-text text-muted"><i>*{{ $errors->first('lname') }}</i></small>
            @endif
        </div>
    </div>      


    <div class="row">
         <div class="col-lg-6">
            <div class="form-group">
                <label for="city">City</label>
              <select  class="form-control" name="city" id="city">
                    @if(old('city'))
                    <option value="{{old('city')}}" selected="">{{old('city')}}</option>
                    @else
                    <option value="{{$user->customer->city}}" selected="">{{$user->customer->city}}</option>
                    @endif
                    <option value="Caloocan">Caloocan</option>
                    <option value="Las Piñas">Las Piñas</option>
                    <option value="Makati ">Makati </option>
                    <option value="Malabon">Malabon</option>
                    <option value="Mandaluyong">Mandaluyong</option>
                    <option value="Manila">Manila</option>
                    <option value="Marikina">Marikina</option>
                    <option value="Muntinlupa">Muntinlupa</option>
                    <option value="Navotas">Navotas</option>
                    <option value="Parañaque">Parañaque</option>
                    <option value="Pasay">Pasay</option>
                    <option value="Pasig ">Pasig </option>
                    <option value="Quezon City">Quezon City</option>
                    <option value="San Juan">San Juan</option>
                    <option value="Taguig">Taguig</option>
                    <option value="Valenzuela">Valenzuela</option>
                    <option value="Butuan">Butuan</option>
                    <option value="Cabadbaran">Cabadbaran</option>
                    <option value="Bayugan">Bayugan</option>
                    <option value="Legazpi">Legazpi</option>
                    <option value="Ligao">Ligao</option>
                    <option value="Tabaco">Tabaco</option>
                    <option value="Isabela">Isabela</option>
                    <option value="Lamitan">Lamitan</option>
                    <option value="Balanga">Balanga</option>
                    <option value="Batangas City">Batangas City</option>
                    <option value="Lipa">Lipa</option>
                    <option value="Tanauan">Tanauan</option>
                    <option value="Baguio">Baguio</option>
                    <option value="Tagbilaran">Tagbilaran</option>
                    <option value="Malaybalay">Malaybalay</option>
                    <option value="Valencia">Valencia</option>
                    <option value="Malolos">Malolos</option>
                    <option value="Meycauayan">Meycauayan</option>
                    <option value="San Jose del Monte">San Jose del Monte</option>
                    <option value="Tuguegarao">Tuguegarao</option>
                    <option value="Iriga">Iriga</option>
                    <option value="Naga">Naga</option>
                    <option value="Roxas">Roxas</option>
                    <option value="Bacoor">Bacoor</option>
                    <option value="Cavite City">Cavite City</option>
                    <option value="Dasmariñas">Dasmariñas</option>
                    <option value="Imus">Imus</option>
                    <option value="Tagaytay">Tagaytay</option>
                    <option value="Trece Martires">Trece Martires</option>
                    <option value="Bogo">Bogo</option>
                    <option value="Carcar">Carcar</option>
                    <option value="Cebu City">Cebu City</option>
                    <option value="Danao">Danao</option>
                    <option value="Lapu-Lapu">Lapu-Lapu</option>
                    <option value="Mandaue">Mandaue</option>
                    <option value="Naga">Naga</option>
                    <option value="Talisay">Talisay</option>
                    <option value="Toledo">Toledo</option>
                    <option value="Kidapawan">Kidapawan</option>
                    <option value="Panabo">Panabo</option>
                    <option value="Samal">Samal</option>
                    <option value="Tagum">Tagum</option>
                    <option value="Davao City">Davao City</option>
                    <option value="Digos">Digos</option>
                    <option value="Mati">Mati</option>
                    <option value="Borongan">Borongan</option>
                    <option value="Batac">Batac</option>    
                    <option value="Laoag">Laoag</option>    
                    <option value="Candon">Candon</option>  
                    <option value="Vigan">Vigan</option>    
                    <option value="Iloilo City">Iloilo City</option>
                    <option value="Passi">Passi</option>    
                    <option value="Cauayan">Cauayan</option>    
                    <option value="Ilagan">Ilagan</option>  
                    <option value="Santiago">Santiago</option>
                    <option value="Tabuk">Tabuk</option>    
                    <option value="San Fernando">San Fernando</option>  
                    <option value="Biñan">Biñan</option>    
                    <option value="Cabuyao">Cabuyao</option>    
                    <option value="Calamba">Calamba</option>
                    <option value="San Pablo">San Pablo</option>
                    <option value="Santa Rosa">Santa Rosa</option>
                    <option value="San Pedro">San Pedro</option>
                    <option value="Iligan">Iligan</option>  
                    <option value="Marawi">Marawi</option>  
                    <option value="Baybay">Baybay</option>  
                    <option value="Ormoc">Ormoc</option>    
                    <option value="Tacloban">Tacloban</option>  
                    <option value="Cotabato City">Cotabato City</option>
                    <option value="Masbate City">Masbate City</option>
                    <option value="Oroquieta">Oroquieta</option>
                    <option value="Ozamiz">Ozamiz</option>
                    <option value="Tangub">Tangub</option>
                    <option value="Cagayan de Oro">Cagayan de Oro</option>
                    <option value="El Salvador">El Salvador</option>
                    <option value="Gingoog">Gingoog</option>
                    <option value="Bacolod">Bacolod</option>
                    <option value="Bago">Bago</option>
                    <option value="Cadiz">Cadiz</option>
                    <option value="Escalante">Escalante</option>
                    <option value="Himamaylan">Himamaylan</option>
                    <option value="Kabankalan">Kabankalan</option>
                    <option value="La Carlota">La Carlota</option>
                    <option value="Sagay">Sagay</option>
                    <option value="San Carlos">San Carlos</option>
                    <option value="Silay">Silay</option>
                    <option value="Sipalay">Sipalay</option>
                    <option value="Talisay">Talisay</option>
                    <option value="Victorias">Victorias</option>
                    <option value="Bais">Bais</option>
                    <option value="Bayawan">Bayawan</option>
                    <option value="Canlaon">Canlaon</option>
                    <option value="Dumaguete">Dumaguete</option>
                    <option value="Guihulngan">Guihulngan</option>
                    <option value="Tanjay">Tanjay</option>
                    <option value="Cabanatuan">Cabanatuan</option>
                    <option value="Gapan">Gapan</option>
                    <option value="Muñoz">Muñoz</option>
                    <option value="Palayan">Palayan</option>
                    <option value="San Jose">San Jose</option>
                    <option value="Calapan  Oriental">Calapan   Oriental</option>
                    <option value="Puerto Princesa">Puerto Princesa</option>
                    <option value="Angeles">Angeles</option>
                    <option value="Mabalacat ">Mabalacat </option>
                    <option value="San Fernando">San Fernando</option>
                    <option value="Alaminos">Alaminos</option>
                    <option value="Dagupan">Dagupan</option>
                    <option value="San Carlos">San Carlos</option>
                    <option value="Urdaneta">Urdaneta</option>
                    <option value="Lucena">Lucena</option>
                    <option value="Tayabas">Tayabas</option>
                    <option value="Antipolo">Antipolo</option>
                    <option value="Calbayog">Calbayog</option>
                    <option value="Catbalogan">Catbalogan</option>
                    <option value="Sorsogon City">Sorsogon City</option>
                    <option value="General Santos">General Santos</option>
                    <option value="Koronadal">Koronadal</option>
                    <option value="Maasin">Maasin</option>
                    <option value="Tacurong">Tacurong</option>
                    <option value="Surigao City">Surigao City</option>
                    <option value="Bislig">Bislig</option>
                    <option value="Tandag">Tandag</option>
                    <option value="Tarlac City">Tarlac City</option>
                    <option value="Olongapo">Olongapo</option>
                    <option value="Dapitan">Dapitan</option>
                    <option value="Dipolog">Dipolog</option>
                    <option value="Pagadian">Pagadian</option>
                    <option value="Zamboanga City">Zamboanga City</option>
                </select> 
                @if($errors->has('city'))
                <small class="form-text text-muted"><i>*{{ $errors->first('city') }}</i></small>
                @endif
            </div> 
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" id="phone" name="phone" class="form-control" value="{{old('phone')? old('phone'): $user->customer->phone}}">
                @if($errors->has('phone'))
                <small class="form-text text-muted"><i>*{{ $errors->first('phone') }}</i></small>
                @endif 
            </div> 
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="addressline">Address Line</label>
                <input type="text" id="addressline" name="addressline" class="form-control" value="{{old('addressline')? old('addressline'): $user->customer->addressline}}">
                @if($errors->has('addressline'))
                <small class="form-text text-muted"><i>*{{ $errors->first('addressline') }}</i></small>
                @endif
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="zipcode">Zipcode</label>
                <input type="text" id="zipcode" name="zipcode" class="form-control" value="{{old('zipcode')? old('zipcode'): $user->customer->zipcode}}"> 
                @if($errors->has('zipcode'))
                <small class="form-text text-muted"><i>*{{ $errors->first('zipcode') }}</i></small>
                @endif
            </div>
        </div>
    </div> 
    <hr style="background: white;">
    <h3>Change Password (Optional)</h3>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="password">Current Password</label>
                <input type="password" id="password" name="current_password" class="form-control">
                @if($errors->has('current_password'))
                <small class="form-text text-muted"><i>*{{ $errors->first('current_password') }}</i></small>
                @endif  
            </div>
        </div>
     </div>
     <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="password">New Password</label>
                <input type="password" id="password" name="password" class="form-control">
                @if($errors->has('password'))
                <small class="form-text text-muted"><i>*{{ $errors->first('password') }}</i></small>
                @endif  
            </div>
        </div>
     </div>
     <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="password-confirm">Confirm Password</label>
                <input type="password" id="password-confirm" name="password_confirmation" class="form-control"> 
                @if($errors->has('password_confirmation'))
                <small class="form-text text-muted"><i>*{{ $errors->first('password_confirmation') }}</i></small>
                @endif 
            </div>
        </div>
     </div>



            <button type="submit" class='btn btn-success'>Update</button> 
            {{ csrf_field() }}
        </form> 
   
</div>
<script type="text/javascript">
  
</script>
@endsection