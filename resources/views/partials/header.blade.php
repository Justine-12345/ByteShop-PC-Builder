@php
use App\Notification;
$messages = Notification::messagesToUser();
@endphp
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
 <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<header>
        <nav class="navbar">
            <div class="logo" style="position"><a href="{{URL::to('/')}}"> <img src="{{asset('src/images/logo.png')}}" style="width: 250px;height: 80px; border: none; margin: 0px; padding: 0px; background: inherit; "></a></div>
            <a class="togglebtn" href="#"><span class="line"></span>
                <span class="line"></span>
                <span class="line"></span></a>
            <div class="navbar-links">
  {{--    {{dd(Session::get('cart'))}} --}}

            @if(Auth::check() && auth()->user()->is_admin == 0)
                <ul>
                    <li style="padding-top: 8px;"><a href="{{ route('pc.builderOption') }}">Build Your PC</a></li>
                    <li style="padding-top: 8px;"><a href="{{URL::to('/')}}">Shopping</a></li>
                    <li style="padding-top: 8px;"><a href="{{URL::to('/forum')}}">Forum</a></li>
                    <li style="padding-top: 8px;"><a href="{{ route('product.shoppingCart') }}">Cart <span class="badge" style="background: white; color: brown;">{{ Session::has('cart') ? Session::get('cart')->totalQty : '' }}</span></a></li>
                      

                   {{--  <li style="; padding: 0px; margin-right: 0px; margin-left:20px;">

                        <a href="{{route('user.profile')}}" style="padding: 0px; margin:0px;background:inherit;"><img src="{{asset('storage/profilePic/'.Auth::user()->image)}}" class="mr-3" alt="..." style="height: 50px; width: 50px; object-fit: cover; border-radius: 50%; top: 10px; margin: 0px; padding: 0px"></a>
                    </li> --}}


                      <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-toggle="dropdown" href="#"><span class="d-none d-lg-inline mr-2 text-gray-600 small"></span><img class="border rounded-circle img-profile" src="{{asset('storage/profilePic/'.Auth::user()->image)}}" style="height:50px; width:50px; object-fit:cover;"></a>
                                    <div class="glass dropdown-menu shadow dropdown-menu-right animated--grow-in animate__animated animate__flipInX " style="height: 33vh; padding:8px; z-index: 5;position: absolute;">
                                        <a class="dropdown-item" href="{{route('profile.show', auth()->user()->id)}}" ><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400" ></i>&nbsp;Profile</a>

                                        <a class="dropdown-item" href="{{route('user.edit',auth()->user()->user_id)}}"><i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Edit Profile</a>

                                        <a class="dropdown-item" href="{{route('user.profile')}}"><i class="fas fa-shopping-bag text-gray-400"></i>&nbsp;&nbsp;&nbsp; Orders</a>

                                    @if($messages > 0)
                                        <a class="dropdown-item" href="{{route('messagecustomer.index')}}" ><span class="badge badge-danger" style="font-size: 10px; position: relative; bottom: 2px; left: -19px">{{$messages}}</span>
                                        <span style="border: 0px solid white; position: relative; right: 19px; ">
                                         <i class="fas fa-envelope text-gray-400"></i>&nbsp;&nbsp;&nbsp; Massage
                                         </span>
                                     </a>
                                     @else
                                     <a class="dropdown-item" href="{{route('messagecustomer.index')}}" >
                                        <span >
                                         <i class="fas fa-envelope text-gray-400"></i>&nbsp;&nbsp;&nbsp; Massage
                                         </span>
                                     </a>

                                     @endif

                                        <div class="dropdown-divider"></div>

                                        <a class="dropdown-item" href="{{route('user.logout')}}"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Logout</a>
                                    </div>
                                </div>
                            </li>



                   {{--  <li style="padding-top: 8px;"><a href="{{route('user.logout')}}">Log out</a></li> --}}
                </ul>
            @elseif(Auth::check() && auth()->user()->is_admin == 1)
                <h4>Build PC For Customer <a class="btn btn-primary" href="{{route('order.index')}}">Back To Panel</a></h4>

            @else
                   <ul>
                    <li><a href="{{ route('pc.builder') }}"><i class="fas fa-key"></i> Build Your PC</a></li>
                    <li><a href="{{URL::to('/')}}">Shopping</a></li>
                    <li><a href="{{route('user.signin')}}">Sign In</a></li>
                    <li><a href="{{route('user.signup')}}">Sign Up</a></li>
                </ul>
            @endif
            </div>
        </nav>
    </header>
    <script type="text/javascript">
    feather.replace();
document.querySelectorAll(".player__dock").forEach((el) => {
  el.addEventListener("click", (e) => {
    document.querySelector(".player").classList.toggle("player--docked");
  });
});

</script>


<script type="text/javascript">
  
  const toggleBtn = document.getElementsByClassName('togglebtn')[0]
const navbarLinks = document.getElementsByClassName('navbar-links')[0]

toggleBtn.addEventListener('click', () => {
    navbarLinks.classList.toggle('active')
})
</script>
<script type="text/javascript">
  
$(document).ready(function(){
    $("#search").focus(function() {
      $(".search-box").addClass("border-searching");
      $(".search-icon").addClass("si-rotate");
    });
    $("#search").blur(function() {
      $(".search-box").removeClass("border-searching");
      $(".search-icon").removeClass("si-rotate");
    });
    $("#search").keyup(function() {
        if($(this).val().length > 0) {
          $(".go-icon").addClass("go-in");
        }
        else {
          $(".go-icon").removeClass("go-in");
        }
    });
    $(".go-icon").click(function(){
      $(".search-form").submit();
    });
});


</script>
