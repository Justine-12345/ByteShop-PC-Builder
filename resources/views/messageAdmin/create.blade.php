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
    <link rel="stylesheet" type="text/css" href="{{URL::to('src/css/createmessage.css')}}"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.3/css/bootstrap-select.css" />
     <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
</head>

<body id="page-top">
    <div id="wrapper">
       @include('partials.admin_header')
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
        @include('partials.admin_header2')
                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-dark mb-0"></h3>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-xl-12 offset-xl-0">

                            <div class="row justify-content-center" style="width: 100%">
                                <div class="glass" style="width: 80%; height: unset; border-radius: 5px; margin-bottom: 10px; padding: 10px; padding-left: 30px;">     
                        <h3>Compose Message</h3> 
                        <hr>  
                                <form action="{{route('messageadmin.store')}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                   
                                    @if($users != "")
                                     <label for="select"><h7>Send To:</h7></label>

                                          <select name="user_id" class="selectpicker form-control" id="select" data-show-subtext="true" data-live-search="true">
                                            @foreach($users as $user_id => $name)
                                                <option value="{{$user_id}}">#ID {{$user_id}} - {{ucwords($name)}}</option>
                                             @endforeach
                                          </select>
                                    @endif
                                    @if($user != "")
                                     <label for="select"><h7>Send To:</h7></label>
                                        {{$user->name}}
                                        <input type="hidden" name="user_id" value="{{$user->user_id}}">
                                    @endif
                                    <br>
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
                        </div>
                    </div>
                </div>
            </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © Brand 2021</span></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="{{ route('mouse.index') }}"><i class="fas fa-arrow-left"></i></a>
    </div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.3/js/bootstrap-select.js"></script>
  

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/theme.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>

</html>