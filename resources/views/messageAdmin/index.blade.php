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
                <h3>Messages</h3>        
                    <form action="{{route('messageadmin.index')}}">
                        @csrf
                         
                        <button type="submit" value="inbox" name="tab" class="button  inbox" style="margin-bottom:10px;background:{{$tab == "Inbox"?"#0088ff":null}};">Inbox</button>
                      
                        <button type="submit" value="sent" name="tab" class="button  sent" style="background:{{$tab == "Sent Message"?"#0088ff":null}};">Sent Messages</button>

                         <a href="{{route('messageadmin.create')}}"><button type="button" class="button  email" style="margin-bottom:10px;"> Compose Message</button></a>
                    </form>

@if($message = Session::get('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-right: 100px; margin-left:">
  <strong style="color:darkblue;">{{$message}}</strong> 
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true" style="color: darkblue;">&times;</span>
  </button>
</div>
@endif 
  {{ $messages->links() }}    
  <div class="row" style="width:unset; max-width:100%" > 

                       @foreach($messages as $message)
                          <div class="col-lg justify-content-center" style="width: 80%; margin-bottom: 10px;">
                            <a href="{{route('messageadmin.show', $message->message_id)}}" style="text-decoration: none; margin-bottom: 5px;">
                            <div class="col" style="height: unset; width: 150vh; padding: 20px;padding-bottom: 30px; background: lightgray;">
                            @if($message->message_label != "Cancel" && $tab == "Sent Message")
                                <form action="{{route('messageadmin.destroy', $message->message_id)}}" method="post" style="float:right;"> 
                                    @csrf
                                   {{ method_field('DELETE') }}
                                    <button type="submit" style="background: inherit; border: 0px solid white; display: inline-block; "><i class="fas fa-times-circle" style="font-size: 16px;"></i></button>
                                </form> 
                            @endif

                            @if($message->is_seen === null && $tab === "Inbox")
                            <b style="font-weight: 900;"> <i class="fas fa-inbox"></i>
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
                            <span style="  white-space: nowrap;width:90%;display: inline-block;overflow: hidden;text-overflow: ellipsis; font-size: 13px;color:white;margin-left:20px">  {{$message->message_content}} 

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

{{ $messages->links() }}
 




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
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/theme.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>

</html>