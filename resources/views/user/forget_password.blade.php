@extends('layouts.master')
@section('content')
<div class="row" style="position:relative; border: 0px solid white; width: 100%;">
    <div class="col-md offset-md-4">
        <h1 style="padding: 20px">Forget Password</h1> 
       
        <form action="{{route('validate.email')}}" method="get" style="width: 400px; padding: 20px"> 
        @csrf

         @if (count($errors) > 0) 
            <div class="alert alert-danger"> 
                @foreach ($errors->all() as $error)
                    <p style="color: red;">{{ $error }}</p> 
                @endforeach
            </div>
        @endif

        @if ($message = Session::get('error')) 
            <div class="alert alert-danger"> 
            
                    <p style="color: red;">{{ $message }}</p> 
           
            </div>
        @endif

        @if ($message = Session::get('send')) 
            <div class="alert alert-success"> 
            
                    <p style="color: Green;">{{ $message }}</p> 
           
            </div>
        @endif

            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" class="form-control"> 
            </div>
            <button type="submit" class='btn btn-success'>Send Password Reset Link</button> 
            
        </form> 
    </div> 
</div>
@endsection