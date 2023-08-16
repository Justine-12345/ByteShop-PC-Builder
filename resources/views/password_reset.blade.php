@extends('layouts.master')
@section('content')
<div class="row" style="position:relative; border: 0px solid white; width: 100%;">
    <div class="col-md offset-md-4">
        <h1 style="padding: 20px">Confirm Password</h1> 
       
          @if ($message = Session::get('error')) 
            <div class="alert alert-danger"> 
            
                    <p style="color: red;">{{ $message }}</p> 
           
            </div>
        @endif

        <form method="POST" action="{{ route('resetPassword') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group ">
                            <label for="email" class="col-md col-form-label text-md-left">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 col-form-label text-md-left">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-left">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0 text-md-left">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-success" style="margin-left:15px">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>



       </div> 
</div>
@endsection