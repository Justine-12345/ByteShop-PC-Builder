<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard - Operating Systems</title>
    <link rel="stylesheet" href="{{asset('src/assets/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="{{asset('src/assets/fonts/fontawesome-all.min.css')}}">
    <link rel="stylesheet" href="{{asset('src/assets/fonts/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('src/assets/fonts/fontawesome5-overrides.min.css')}}">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

</head>

<body id="page-top">
    <div id="wrapper">
     @include('partials.admin_header')
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
                <div class="container-fluid" style="font-size: 14px;">

                     <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-dark mb-0">User Table</h3>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-xl-12 offset-xl-0">
                            <div class="card shadow mb-4">
                                <div class="card-body">

                                <form action="{{route('useradmin.index')}}" method="GET" style="border:0px solid black;display: inline-block;">
                                    <input type="hidden" name="status" value="All">
                                    <div class="btn-group">
                                      <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style=" color: white;">
                                        @if($oldStatus == "All")
                                       <u>All</u>
                                       @else
                                       All
                                       @endif
                                      </button>
                                      <div class="dropdown-menu">
                                        <button name="order" class="dropdown-item" type="submit" value="user_id">All
                                        </button>

                                        <button name="order" class="dropdown-item" type="submit" value="user_id">ID
                                        @if($oldOrder == "user_id" && $oldStatus == "All")
                                         <i class="fas fa-caret-left"></i>
                                        @endif
                                        </button>


                                        <button name="order" class="dropdown-item" type="submit" value="name">Name
                                        @if($oldOrder == "name" && $oldStatus == "All")
                                         <i class="fas fa-caret-left"></i>
                                        @endif
                                        </button>

                                        <div class="dropdown-divider"></div>
                                        <button name="arrangement" class="dropdown-item" type="submit" value="ASC">Ascending
                                        @if($oldArrangement == 'ASC' && $oldStatus == "All") 
                                        <i class="fas fa-caret-left"></i>
                                        @endif
                                        </button>

                                        <button name="arrangement" class="dropdown-item" type="submit" value="DESC">Descending 
                                           
                                        @if($oldArrangement == 'DESC' && $oldStatus == "All")     
                                        <i class="fas fa-caret-left"></i>
                                        @endif
                                       </button>

                                        <input type="hidden" name="oldStatus" value="{{$oldStatus}}">
                                        <input type="hidden" name="oldOrder" value="{{$oldOrder}}">
                                        <input type="hidden" name="oldArrangement" value="{{$oldArrangement}}">

                                      </div>
                                    </div>
                                </form>

                                <form action="{{route('useradmin.index')}}" method="GET" style="border:0px solid black;display: inline-block;">
                                    <input type="hidden" name="status" value="0">
                                    <div class="btn-group">
                                      <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style=" color: white;">
                                        @if($oldStatus == "0")
                                       <u>Customers</u>
                                       @else
                                       Customers
                                       @endif
                                      </button>
                                     <div class="dropdown-menu">
                                        <button name="order" class="dropdown-item" type="submit" value="user_id">All
                                        </button>

                                        <button name="order" class="dropdown-item" type="submit" value="user_id">ID
                                        @if($oldOrder == "user_id" && $oldStatus == "0")
                                         <i class="fas fa-caret-left"></i>
                                        @endif
                                        </button>


                                        <button name="order" class="dropdown-item" type="submit" value="name">Name
                                        @if($oldOrder == "name" && $oldStatus == "0")
                                         <i class="fas fa-caret-left"></i>
                                        @endif
                                        </button>

                                        <div class="dropdown-divider"></div>
                                        <button name="arrangement" class="dropdown-item" type="submit" value="ASC">Ascending
                                        @if($oldArrangement == 'ASC' && $oldStatus == "0") 
                                        <i class="fas fa-caret-left"></i>
                                        @endif
                                        </button>

                                        <button name="arrangement" class="dropdown-item" type="submit" value="DESC">Descending 
                                           
                                        @if($oldArrangement == 'DESC' && $oldStatus == "0")     
                                        <i class="fas fa-caret-left"></i>
                                        @endif
                                       </button>

                                        <input type="hidden" name="oldStatus" value="{{$oldStatus}}">
                                        <input type="hidden" name="oldOrder" value="{{$oldOrder}}">
                                        <input type="hidden" name="oldArrangement" value="{{$oldArrangement}}">

                                      </div>
                                    </div>
                                </form>


                                <form action="{{route('useradmin.index')}}" method="GET" style="border:0px solid black;display: inline-block;">
                                    <input type="hidden" name="status" value="1">
                                    <div class="btn-group">
                                      <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style=" color: white;">
                                        @if($oldStatus == "1")
                                       <u>Admins</u>
                                       @else
                                       Admins
                                       @endif
                                      </button>
                                      <div class="dropdown-menu">
                                        <button name="order" class="dropdown-item" type="submit" value="user_id">All
                                        </button>

                                        <button name="order" class="dropdown-item" type="submit" value="user_id">ID
                                        @if($oldOrder == "user_id" && $oldStatus == "1")
                                         <i class="fas fa-caret-left"></i>
                                        @endif
                                        </button>


                                        <button name="order" class="dropdown-item" type="submit" value="name">Name
                                        @if($oldOrder == "name" && $oldStatus == "1")
                                         <i class="fas fa-caret-left"></i>
                                        @endif
                                        </button>

                                        <div class="dropdown-divider"></div>
                                        <button name="arrangement" class="dropdown-item" type="submit" value="ASC">Ascending
                                        @if($oldArrangement == 'ASC' && $oldStatus == "1") 
                                        <i class="fas fa-caret-left"></i>
                                        @endif
                                        </button>

                                        <button name="arrangement" class="dropdown-item" type="submit" value="DESC">Descending 
                                           
                                        @if($oldArrangement == 'DESC' && $oldStatus == "1")     
                                        <i class="fas fa-caret-left"></i>
                                        @endif
                                       </button>

                                        <input type="hidden" name="oldStatus" value="{{$oldStatus}}">
                                        <input type="hidden" name="oldOrder" value="{{$oldOrder}}">
                                        <input type="hidden" name="oldArrangement" value="{{$oldArrangement}}">

                                      </div>
                                    </div>
                                </form>

                                <form action="{{route('useradmin.index')}}" method="GET" style="border:0px solid black;display: inline-block;">
                                    <input type="hidden" name="status" value="2">
                                    <div class="btn-group">
                                      <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style=" color: white;">
                                        @if($oldStatus == "2")
                                       <u>Riders</u>
                                       @else
                                       Riders
                                       @endif
                                      </button>
                                      <div class="dropdown-menu">
                                        <button name="order" class="dropdown-item" type="submit" value="user_id">All
                                        </button>

                                        <button name="order" class="dropdown-item" type="submit" value="user_id">ID
                                        @if($oldOrder == "user_id" && $oldStatus == "2")
                                         <i class="fas fa-caret-left"></i>
                                        @endif
                                        </button>


                                        <button name="order" class="dropdown-item" type="submit" value="name">Name
                                        @if($oldOrder == "name" && $oldStatus == "2")
                                         <i class="fas fa-caret-left"></i>
                                        @endif
                                        </button>

                                        <div class="dropdown-divider"></div>
                                        <button name="arrangement" class="dropdown-item" type="submit" value="ASC">Ascending
                                        @if($oldArrangement == 'ASC' && $oldStatus == "2") 
                                        <i class="fas fa-caret-left"></i>
                                        @endif
                                        </button>

                                        <button name="arrangement" class="dropdown-item" type="submit" value="DESC">Descending 
                                           
                                        @if($oldArrangement == 'DESC' && $oldStatus == "2")     
                                        <i class="fas fa-caret-left"></i>
                                        @endif
                                       </button>

                                        <input type="hidden" name="oldStatus" value="{{$oldStatus}}">
                                        <input type="hidden" name="oldOrder" value="{{$oldOrder}}">
                                        <input type="hidden" name="oldArrangement" value="{{$oldArrangement}}">

                                      </div>
                                    </div>
                                </form>

                               
                                <form action="{{route('useradmin.index')}}" method="GET" style="border:0px solid black;display: inline-block;">
                                    @csrf
                                   <input class="form-control"  placeholder="Search User Here..." type="text" name="search" required="" style="display:inline-block; width: fit-content;">
                                   <button class="btn btn-primary" type="submit" style="display:inline-block; margin-bottom:3px"><i class="fas fa-search"></i></button>
                                </form>




                                    <div class="table-responsive text-center">
                                        <table class="table">
                                            <thead style="background: #031131;">
                {{--  COLOMN NAME --}}
                                                <tr>
                                                    <th style="color: rgb(255,255,255);">User ID</th>
                                                    <th style="color: rgb(255,255,255);">Name</th>
                                                    <th style="color: rgb(255,255,255);">Email</th>
                                                    <th style="color: rgb(255,255,255);">Role</th>
                                                    <th style="color: rgb(255,255,255);width: 300px;">Action</th>
                                                </tr>

                                            </thead>
                                            <tbody>
                                            
                {{-- START LOOP HERE --}}
                                        @foreach($users as $user)

                                            <tr>
                                                <td style="color: rgb(0,0,0);"><b>{{ $user->user_id}}</b></td>

                                                <td style="color: rgb(0,0,0);">{{ $user->name}}</td>

                                                <td style="color: rgb(0,0,0);">{{ $user->email}}</td>
                                                
                                                <td style="color: rgb(0,0,0);">
                                                    @php
                                                    $color = "";
                                                    $text = "white";
                                                    $border = "Unset";
                                                    $dropdown = "dropdown-toggle";
                                                    $dropdownContent = "dropdown";
                                                     if($user->is_admin == "1"){
                                                       $color =" #24a0ed";
                                                        }
                                                    if($user->is_admin == "0"){
                                                        $color ="#fff";
                                                        $text = "Black";
                                                        $border = "1px Solid Black";
                                                        }
                                                   if ($user->is_admin == "2") {
                                                      $color ="#e08312";
                                                   }


                                                    @endphp
                                                    <form action="{{route('useradmin.update', $user->user_id)}}" method="post">
                                                        @csrf
                                                        {{method_field('PATCH')}}
                                                    <div class="dropdown">
                                                      <button type="button" 
                                                      class="btn btn {{$dropdown}}" 
                                                      type="button" id="dropdownMenuButton" data-toggle="{{$dropdownContent}}" aria-haspopup="true" 
                                                      aria-expanded="false" 
                                                      style="background:{{$color}};
                                                      color: {{$text}}; 
                                                      border: {{$border}}; 
                                                      width: 115px">
                                                      @if($user->is_admin == 1)
                                                      Admin
                                                      @elseif($user->is_admin == 0)
                                                      Customer
                                                      @elseif($user->is_admin == 2)
                                                      Rider
                                                      @endif
                                                      </button>
                                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    
                                                        <button type="submit" name="is_admin" class="dropdown-item" value="1">Admin</button>

                                                        <button type="submit" name="is_admin" class="dropdown-item" value="0">Customer</button>

                                                        <button type="submit" name="is_admin" class="dropdown-item" value="2">Riders</button>

                                                      </div>
                                                    </div>
                                                    <input type="hidden" name="oldStatus" value="{{$oldStatus}}">
                                                    <input type="hidden" name="oldOrder" value="{{$oldOrder}}">
                                                    <input type="hidden" name="oldArrangement" value="{{$oldArrangement}}">
                                                    </form>

                                                    </td>                                                 
                                                <td class="text-center">
                                                    <a href="{{route('useradmin.show', $user->user_id )}}" class="btn btn-primary" type="button" style="color: rgb(255, 255, 255);background: #00674c;"><i class="fa fa-eye"></i>&nbsp;View</a>

                                                 
                                                </td>
                                             </tr>
                                        
                                        
                                        @endforeach
                {{-- END LOOP HERE --}}
  


                                            </tbody>
                                            
                                        </table>
                                        {{ $users->links() }}
                                    </div>
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
        </div><a class="border rounded d-inline scroll-to-top" href="{{ route('operatingsystem.create') }}"><i class="fas fa-plus"></i></a>
    </div>
    <script
src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
</script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/theme.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>

</html>