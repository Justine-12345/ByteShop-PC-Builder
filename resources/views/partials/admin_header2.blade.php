@php
use App\Notification;
$messages = Notification::messages(9);
@endphp
<nav class="navbar navbar-light navbar-expand shadow mb-4 topbar static-top" style="border-top-color: rgb(133,;border-right-color: 135,;border-bottom-color: 150) ;border-left-color: 135,;background: #031131;">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle mr-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <form class="form-inline d-none d-sm-inline-block mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" method="POST" role="search" action="{{route('search')}}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    @if(Auth::check() && auth()->user()->is_admin == 2)
                        <img src="{{asset('src/assets/img/213649488_498516397910753_3283992471174574716_n%20(1).png')}}" style="width: 190px;text-align: left;">
                    @endif

                          
                        @if(Auth::check() && auth()->user()->is_admin == 1)
                            <div class="input-group">

                            <input class="bg-light form-control border-0 small" name="search" type="text" placeholder="Search Item ...">

                                <div class="input-group-append"><button class="btn btn-primary py-0" type="submit" style="background: #00674c;"><i class="fas fa-search"></i></button></div>
                            </div>
                        @endif 

                       {{--  <div class="input-group col-md-5" style="height:10px">
                            <select class="form-control" id="exampleFormControlSelect1" style="height:34px">
                            <option value="All" selected="">All Categories</option>
                            @foreach(Notification::categories() as $category)
                              <option value="{{$category->category_id}}">{{ucwords($category->category_name)}}</option>
                            @endforeach
                            </select>
                        </div> --}}
                   
                        </form>
                        <ul class="navbar-nav flex-nowrap ml-auto">
                            <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-toggle="dropdown" href="#"><i class="fas fa-search"></i></a>
                                <div class="dropdown-menu dropdown-menu-right p-3 animated--grow-in" aria-labelledby="searchDropdown">
                                    <form class="form-inline mr-auto navbar-search w-100">
                                        <div class="input-group">
                                            <input class="bg-light form-control border-0 small" type="text" placeholder="Search for ...">
                                            <div class="input-group-append"><button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i></button></div>
                                        </div>
                                    </form>
                                </div>
                            </li>
                           {{--  <li class="nav-item dropdown no-arrow mx-1">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-toggle="dropdown" href="#"><span class="badge badge-danger badge-counter">3+</span><i class="fas fa-bell fa-fw"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-list animated--grow-in">
                                        <h6 class="dropdown-header">alerts center</h6><a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="mr-3">
                                                <div class="bg-primary icon-circle"><i class="fas fa-file-alt text-white"></i></div>
                                            </div>
                                            <div><span class="small text-gray-500">December 12, 2019</span>
                                                <p>A new monthly report is ready to download!</p>
                                            </div>
                                        </a><a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="mr-3">
                                                <div class="bg-success icon-circle"><i class="fas fa-donate text-white"></i></div>
                                            </div>
                                            <div><span class="small text-gray-500">December 7, 2019</span>
                                                <p>$290.29 has been deposited into your account!</p>
                                            </div>
                                        </a><a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="mr-3">
                                                <div class="bg-warning icon-circle"><i class="fas fa-exclamation-triangle text-white"></i></div>
                                            </div>
                                            <div><span class="small text-gray-500">December 2, 2019</span>
                                                <p>Spending Alert: We've noticed unusually high spending for your account.</p>
                                            </div>
                                        </a><a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                                    </div>
                                </div>
                            </li>
 --}}
                            {{-- MESSAGES START--}}
                        @if(Auth::check() && auth()->user()->is_admin == 1)
                            <li class="nav-item dropdown no-arrow mx-1">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-toggle="dropdown" href="#">
                        @if(Notification::messagesUnseen() > 0)
                            <span class="badge badge-danger badge-counter">{{Notification::messagesUnseen()}}</span><i class="fas fa-envelope fa-fw"></i>
                        @else
                            <span class=""></span><i class="fas fa-envelope fa-fw"></i></a>
                        @endif
                            


                   
                                    <div class="dropdown-menu dropdown-menu-right dropdown-list animated--grow-in">
                                        <h6 class="dropdown-header">Messages</h6>

                     @foreach($messages as $message)
                                    <a class="dropdown-item d-flex align-items-center" href="{{route('messageadmin.show', $message->message_id)}}">
                                            <div class="dropdown-list-image mr-3"><img class="rounded-circle" height="30px" src="{{asset('storage/profilePic/'.$message->user->image)}}">
                                                <div class=""></div>
                                            </div>
                                            <div class="font-weight-bold">
                                                <div class="text-truncate"><span>{{ucwords($message->message_title)}}</span></div>
                                                <p class="small text-gray-500 mb-0">{{$message->user->name}} | {{date_format(date_create($message->message_date),"M-d-Y h:i a")}}</p>
                                            </div>
                                        </a>
                    @endforeach

                               <a class="dropdown-item text-center small text-gray-500" href="{{route('messageadmin.index')}}">Show All Messages</a>
                                    </div>
                                </div>



                                <div class="shadow dropdown-list dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown"></div>
                            </li>
                        @endif

                     {{-- MESSAGES END--}}

                            <div class="d-none d-sm-block topbar-divider"></div>
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-toggle="dropdown" href="#"><span class="d-none d-lg-inline mr-2 text-gray-600 small">{{ucwords(Auth::user()->name)}}</span><img class="border rounded-circle img-profile" src="{{asset('storage/profilePic/'.Auth::user()->image)}}"></a>
                                    <div class="dropdown-menu shadow dropdown-menu-right animated--grow-in">
                                    @if(auth()->user()->is_admin == 2)
                                         <a class="dropdown-item" href="{{route('order.index')}}"><i class="fas fa-truck mr-2 text-gray-400"></i>&nbsp;Orders</a>
                                    @endif
                                        <a class="dropdown-item" href="{{route('profile.show', auth()->user()->id)}}"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Profile</a>

                                        <a class="dropdown-item" href="{{route('user.edit',auth()->user()->user_id)}}"><i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Edit Profile</a>

                                        <div class="dropdown-divider"></div><a class="dropdown-item" href="{{route('user.logout')}}"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>