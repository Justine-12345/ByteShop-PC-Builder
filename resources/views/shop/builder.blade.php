@php
use App\Star;
use App\Converter;

@endphp
@extends('layouts.master')
@section('title')
 Builder|{{ucwords($category)}}
@endsection
@section('content')

<link rel="stylesheet" type="text/css" href="{{URL::to('src/css/builder.css')}}">
{{-- {{dd($powersupplies)}} --}}
<body>
<div class="row">
  <div class="col-md-2 offset-md-4" style="position: fixed; border: 0px solid white;">
    <h2 class="animate__animated  animate__fadeInDown"> 
      @if($category == 'operatingsystem')
      OS
      @else
    {{ucwords($category)}}
    @endif </h2>
  </div>

<div class="wrapper col-md-2 offset-md-6" style="position:fixed;" >
<form action="{{route('pc.builder')}}" method="GET">
  @csrf
  <div class="searchBar" style="color: black;">

    <input id="searchQueryInput" type="text" name="searchQuery" placeholder="Search Item" value=""/>
    <button id="searchQuerySubmit" type="submit" name="searchQuerySubmit">
      <svg style="width:24px;height:20px" viewBox="0 0 24 24"><path fill="#666666" d="M9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.44,13.73L14.71,14H15.5L20.5,19L19,20.5L14,15.5V14.71L13.73,14.44C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3M9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5Z" />
      </svg>
    </button>    
  </div>
</form>

</div>
 {{--  {{dd($prevCategory)}} --}}
  <div class="col-md-2 offset-md-8" style="position: fixed; border: 0px solid white; ">

  @if($category != 'processor')
  <button class="custombtn button11">
    <a style="color: white; text-decoration: none;" href="{{URL::to('user/pc/back/'. $prevCategory)}}">
    Back</a>
  </button>
       <button class="custombtn button11">
       <a style="color: white; text-decoration: none;" href="{{URL::to('user/pc/skip/'. $category)}}">
 @if($category != 'operatingsystem')
      Skip
@else
    Finish
@endif
       </a>
      </button>
    @endif  
 
  


  </div>
</div>
<style type="text/css">
  b{
      font-size: 10px;

     }
    tr{
      font-size: 10px;
      padding: 0px;
      margin: 0px;
   
      height: 20px;
    }
    .frosted-glass{
      overflow: hidden;
    }

</style>

<div class="row" style="width: 100%">
	<div class="col-md-4 frosted-glass" style=" border-radius: 20px; margin-left: 20px; overflow: hidden;"  >
		<table class="table">
  <tbody>
 
    <tr>
      <td style="border: none; "><img src="{{asset('src/images/processor.png')}}" class="rounded float-left" alt="..." >Processor | {{Session::get('builder_cart_info')['processor_price']}}<br><span><b style="font-size:10px">{{     ucwords(Session::get('builder_cart_info')['processor'])}}
        @if(!Session::get('builder_cart_info')['processor'] == "" || !Session::get('builder_cart_info')['processor'] == 0)
        <i class="fas fa-check-circle"></i>
        @else
        Not Set <i class="fas fa-times-circle"></i>
        @endif
      </b></span><br></td>
   
      <td style="border: none;"><img src="{{asset('src/images/motherboard.png')}}" class="rounded float-left" alt="...">Motherboard | {{Session::get('builder_cart_info')['motherboard_price']}}<br><b style="font-size:10px">{{ucwords(Session::get('builder_cart_info')['motherboard'])}}
        @if(!Session::get('builder_cart_info')['motherboard'] == "" || !Session::get('builder_cart_info')['motherboard'] == 0)
        <i class="fas fa-check-circle"></i>
        @else
        Not Set <i class="fas fa-times-circle"></i>
        @endif
      </b></td>
      
    </tr>
    <tr>
 
      <td style="border: none;"><img src="{{asset('src/images/memory.png')}}" class="rounded float-left" alt="...">Memory | {{Session::get('builder_cart_info')['memory_price']}}<br><b style="font-size:10px">{{ucwords(Session::get('builder_cart_info')['memory'])}}
        @if(!Session::get('builder_cart_info')['memory'] == "")
        <i class="fas fa-check-circle"></i>
        @else
        Not Set <i class="fas fa-times-circle"></i>
        @endif
      </b></td>

      <td style="border: none;"><img src="{{asset('src/images/harddisk.png')}}" class="rounded float-left" alt="...">Hard drive | {{Session::get('builder_cart_info')['harddrive_price']}}<br><b style="font-size:10px">{{ucwords(Session::get('builder_cart_info')['harddrive'])}}
        @if(!Session::get('builder_cart_info')['harddrive'] == "")
        <i class="fas fa-check-circle"></i>
        @else
        Not Set <i class="fas fa-times-circle"></i>
        @endif
      </b></td>
    
    </tr>
    <tr>
     
      <td style="border: none;"><img src="{{asset('src/images/ssd.png')}}" class="rounded float-left" alt="...">SSD | {{Session::get('builder_cart_info')['soliddrive_price']}}<br><b style="font-size:10px">{{ucwords(Session::get('builder_cart_info')['soliddrive'])}}
        @if(!Session::get('builder_cart_info')['soliddrive'] == "")
        <i class="fas fa-check-circle"></i>
        @else
        Not Set <i class="fas fa-times-circle"></i>
        @endif
      </b></td>


      <td style="border: none;"><img src="{{asset('src/images/graphics-card.png')}}" class="rounded float-left" alt="...">Video Card | {{Session::get('builder_cart_info')['videocard_price']}}<br><b style="font-size:10px">{{ucwords(Session::get('builder_cart_info')['videocard'])}}
        @if(!Session::get('builder_cart_info')['videocard'] == "")
        <i class="fas fa-check-circle"></i>
        @else
        Not Set <i class="fas fa-times-circle"></i>
        @endif
      </b></td>
    
    </tr>
     <tr>
      <td style="border: none;"><img src="{{asset('src/images/server.png')}}" class="rounded float-left" alt="">Casing | {{Session::get('builder_cart_info')['casing_price']}}<br><b style="font-size:10px">{{ucwords(Session::get('builder_cart_info')['casing'])}}
        @if(!Session::get('builder_cart_info')['casing'] == "")
        <i class="fas fa-check-circle"></i>
        @else
        Not Set <i class="fas fa-times-circle"></i>
        @endif
      </b></td>


      <td style="border: none;"><img src="{{asset('src/images/psu.png')}}" class="rounded float-left" alt="...">Power supply | {{Session::get('builder_cart_info')['powersupply_price']}}<br><b style="font-size:10px">{{ucwords(Session::get('builder_cart_info')['powersupply'])}}
        @if(!Session::get('builder_cart_info')['powersupply'] == "")
        <i class="fas fa-check-circle"></i>
        @else
        Not Set <i class="fas fa-times-circle"></i>
        @endif
      </b></td>
    </tr>


    <tr>
      <td style="border: none;"><img src="{{asset('src/images/keyboard.png')}}" class="rounded float-left" alt="...">Keyboard | {{Session::get('builder_cart_info')['keyboard_price']}}<br><b style="font-size:10px">{{ucwords(Session::get('builder_cart_info')['keyboard'])}}
        @if(!Session::get('builder_cart_info')['keyboard'] == "")
        <i class="fas fa-check-circle"></i>
        @else
        Not Set <i class="fas fa-times-circle"></i>
        @endif
      </b></td>


      <td style="border: none;"><img src="{{asset('src/images/computer-mouse.png')}}" class="rounded float-left" alt="...">Mouse | {{Session::get('builder_cart_info')['mouse_price']}}<br><b style="font-size:10px">{{ucwords(Session::get('builder_cart_info')['mouse'])}}
        @if(!Session::get('builder_cart_info')['mouse'] == "")
        <i class="fas fa-check-circle"></i>
        @else
        Not Set <i class="fas fa-times-circle"></i>
        @endif
      </b></td>
    </tr>
    <tr>
      <td style="border: none;"><img src="{{asset('src/images/monitor.png')}}" class="rounded float-left" alt="...">Monitor | {{Session::get('builder_cart_info')['monitor_price']}}<br><b style="font-size:10px">{{ucwords(Session::get('builder_cart_info')['monitor'])}}
        @if(!Session::get('builder_cart_info')['monitor'] == "")
        <i class="fas fa-check-circle"></i>
        @else
        Not Set <i class="fas fa-times-circle"></i>
        @endif
      </b></td>


      <td style="border: none;"><img src="{{asset('src/images/headphones.png')}}" class="rounded float-left" alt="...">Headphone | {{Session::get('builder_cart_info')['headphone_price']}}<br><b style="font-size:10px">{{ucwords(Session::get('builder_cart_info')['headphone'])}}
        @if(!Session::get('builder_cart_info')['headphone'] == "")
        <i class="fas fa-check-circle"></i>
        @else
        Not Set <i class="fas fa-times-circle"></i>
        @endif
      </b></td>
    </tr>


    <tr>
      <td style="border: none;"><img src="{{asset('src/images/printer.png')}}" class="rounded float-left" alt="...">Printer | {{Session::get('builder_cart_info')['printer_price']}}<br><b style="font-size:10px">{{ucwords(Session::get('builder_cart_info')['printer'])}}
        @if(!Session::get('builder_cart_info')['printer'] == "")
        <i class="fas fa-check-circle"></i>
        @else
        Not Set <i class="fas fa-times-circle"></i>
        @endif
      </b></td>

      <td style="border: none;"><img src="{{asset('src/images/operating-system.png')}}" class="rounded float-left" alt="...">OS | {{Session::get('builder_cart_info')['operatingsystem_price']}}<br><b style="font-size:10px">{{ucwords(Session::get('builder_cart_info')['operatingsystem'])}}
        @if(!Session::get('builder_cart_info')['operatingsystem'] == "")
        <i class="fas fa-check-circle"></i>
        @else
        Not Set <i class="fas fa-times-circle"></i>
        @endif
      </b></td>
        
    
    </tr>
        <td style="border: none;"><b>Recomended PSU : <br><label style="font-size: 20px;">{{round(Session::get('builder_cart_info')['powerconsumption'])}} Watts <i class="fas fa-bolt"></i></label></b></td>
        <td style="border: none;"><b>Total Price :<br><label class="animate__animated  animate__flipInX" style="font-size:20px"> ₱ {{ number_format( Session::get('builder_cart_info')['total_price'],2,'.',",")}}</label></b></td>
    </tr>

   
  </tbody>
</table>
	</div>
	</td>
	<td>


<div class="col-md-5 offset-md-4 partPicker" style="height: 450px; margin-top: 50px; overflow-y:auto; overflow-x:hidden;">

{{-- FOR PROCESSOR --}}

@if($category == 'processor')
@if($processors->all()==null)
<h2>No Processors Found</h2>
@endif
  @foreach($processors as $processor)

          <div class="card mb-3 frosted-glass animate__animated animate__fadeInLeft" style="max-width: 540px; min-width: 540px; max-height: 150px; position:relative; top: 0px;">
            <div class="row no-gutters">
              <div class="col-md-4">
                <img class="proPic" src="{{$processor->item->image != '' || $processor->item->image != null?asset('src/images/products/'.$processor->item->image):url('/noImg.png') }}" alt="..." style=" height: 150px; width: 200px; border: none; object-fit: cover;" onerror="this.src='{{url('/noImg.png')}}'">
              </div>
              <div class="col-md-8">
                <div class="card-body offset-md-1">
                  <h6 class="card-title">{{$processor->item->title}}</h6>

              <div class="row">
                <div class="col-md-6">
                 <label  style="font-size: 12px;">Price: ₱ {{$processor->item->price}}</label>
                 </div>
                 <div class="col-md-6">
                 <label  style="font-size: 12px;">Cores: {{$processor->core_count}}</label>
                 </div>
               </div> 
               <div class="row">
                 <div class="col-md-6">
                 <label  style="font-size: 12px;">Base speed: {{$processor->base_speed}} GHz</label>
                 </div>
                 <div class="col-md-6">
                 <label  style="font-size: 12px;">Max speed: {{$processor->base_speed}} GHz</label>
                 </div>
                </div>

                <a href="{{route('pc.'.$category,$processor->item->item_id)}}" class="kave-btn" style="padding: 5px 20px 5px 20px; text-decoration: none;">
              <span class="kave-line"></span>
              ADD
              </a>

              {{-- START STAR --}}
              <small style="margin-left: 10px;">
              @php
              $hasrate = false;
              @endphp
              @foreach($reviews as $review)
              @if($review->item_id == $processor->item_id)
              {!!Star::display($review->review_rating)!!}
              @php
              $hasrate = true;
              @endphp
              @endif
              @endforeach
              @if($hasrate == false)
                No Ratings
              @endif
              </small>
              {{-- END STAR --}}

              <a href="{{route('product.showTobuy',['0'=>$processor->item_id, '1'=>"processor", '3' => 'fromBuilder'])}}"  style=" text-decoration: none; border: none; border-radius: 10; float: right;">  
                  <i class="fas fa-info-circle showMore"></i>
              </a> 

                </div>
              </div>
            </div>
          </div>

  @endforeach
@endif







{{-- FOR MOTHERBOARD --}}

@if($category == 'motherboard')


@if($motherboards->all()==null)
<h2>No Compatible Motherboard Found</h2>
@endif
  @foreach($motherboards as $motherboard)
          <div class="card mb-3 frosted-glass animate__animated animate__fadeInLeft" style="max-width: 540px; min-width: 550px; max-height: 180px; position:relative; top: 0px;">
            <div class="row no-gutters">
              <div class="col-md-4">
                <img class="proPic" src="{{$motherboard->item->image != '' || $motherboard->item->image != null?asset('src/images/products/'.$motherboard->item->image):url('/noImg.png') }}" alt="..." style=" height: 180px; width: 200px; border: none; object-fit: cover;" onerror="this.src='{{url('/noImg.png')}}'">
              </div>
              <div class="col-md-8">
                <div class="card-body offset-md-1">
                  <h6 class="card-title">{{$motherboard->item->title}}</h6>
                
                  <div class="row">
                <div class="col-md-6">
                 <label  style="font-size: 12px;">Price: ₱ {{$motherboard->item->price}}</label>
                 </div>
                 <div class="col-md-6">
                 <label  style="font-size: 12px;">Form Factor: {{$motherboard->form_factor}}</label>
                 </div>
               </div> 
               <div class="row">
                 <div class="col-md-6">
                 <label  style="font-size: 12px;">CPU socket: {{$motherboard->cpu_socket}}</label>
                 </div>
                 <div class="col-md-6">
                 <label  style="font-size: 12px;">RAM slot: {{$motherboard->ram_slot}}</label>
                 </div>
                </div>

                <a href="{{route('pc.'.$category,$motherboard->item->item_id)}}" class="kave-btn" style="padding: 5px 20px 5px 20px; text-decoration: none;">
              <span class="kave-line"></span>
              ADD
              </a>
               {{-- START STAR --}}
              <small style="margin-left: 10px;">
              @php
              $hasrate = false;
              @endphp
              @foreach($reviews as $review)
              @if($review->item_id == $motherboard->item_id)
              {!!Star::display($review->review_rating)!!}
              @php
              $hasrate = true;
              @endphp
              @endif
              @endforeach
              @if($hasrate == false)
                No Ratings
              @endif
              </small>
              {{-- END STAR --}}

              <a href="{{route('product.showTobuy',['0'=>$motherboard->item_id, '1'=>"motherboard", '3' => 'fromBuilder'])}}"  style=" text-decoration: none; border: none; border-radius: 10; float: right;">  
                  <i class="fas fa-info-circle showMore"></i>
              </a> 

                </div>
              </div>
            </div>
          </div>
  @endforeach
@endif



{{-- FOR MEMORY --}}

@if($category == 'memory')

@if($memories->all()==null)
<h2>No Compatible Memory Found</h2>
@endif
  @foreach($memories as $memory)
          <div class="card mb-3 frosted-glass animate__animated animate__fadeInLeft" style="max-width: 540px; min-width: 540px; max-height: 150px; position:relative; top: 0px;">
            <div class="row no-gutters">
              <div class="col-md-4">
                 <img class="proPic" src="{{$memory->item->image != '' || $memory->item->image != null?asset('src/images/products/'.$memory->item->image):url('/noImg.png') }}" alt="..." style=" height: 150px; width: 200px; border: none; object-fit: cover;" onerror="this.src='{{url('/noImg.png')}}'">
              </div>
              <div class="col-md-8">
                <div class="card-body offset-md-1">
                  <h6 class="card-title">{{$memory->item->title}}</h6>
                
                  <div class="row">
                <div class="col-md-6">
                 <label  style="font-size: 12px;">Price: ₱ {{$memory->item->price}}</label>
                 </div>
                 <div class="col-md-6">
                 <label  style="font-size: 12px;">Size: {{$memory->memory_size}}</label>
                 </div>
               </div> 
               <div class="row">
                 <div class="col-md-6">
                 <label  style="font-size: 12px;">Type: {{$memory->memory_type}}</label>
                 </div>
                 <div class="col-md-6">
                 <label  style="font-size: 12px;">Frequency: {{$memory->frequency}} MHz</label>
                 </div>
                </div>

                <a href="{{route('pc.'.$category,$memory->item->item_id)}}" class="kave-btn" style="padding: 5px 20px 5px 20px; text-decoration: none;">
              <span class="kave-line"></span>
              ADD
              </a>

              {{-- START STAR --}}
              <small style="margin-left: 10px;">
              @php
              $hasrate = false;
              @endphp
              @foreach($reviews as $review)
              @if($review->item_id == $memory->item_id)
              {!!Star::display($review->review_rating)!!}
              @php
              $hasrate = true;
              @endphp
              @endif
              @endforeach
              @if($hasrate == false)
                No Ratings
              @endif
              </small>
              {{-- END STAR --}}

              <a href="{{route('product.showTobuy',['0'=>$memory->item_id, '1'=>"memory", '3' => 'fromBuilder'])}}"  style=" text-decoration: none; border: none; border-radius: 10; float: right;">  
                  <i class="fas fa-info-circle showMore"></i>
              </a> 

                </div>
              </div>
            </div>
          </div>
  @endforeach
@endif





{{-- FOR HARD DRIVE--}}

@if($category == 'harddrive')

@if($harddrives->all()==null)
<h2>No Hard drive Available</h2>
@endif
  @foreach($harddrives as $harddrive)
          <div class="card mb-3 frosted-glass animate__animated animate__fadeInLeft" style="max-width: 540px; min-width: 550px; max-height: 150px; position:relative; top: 0px;">
            <div class="row no-gutters">
              <div class="col-md-4">

               <img class="proPic" src="{{$harddrive->item->image != '' || $harddrive->item->image != null?asset('src/images/products/'.$harddrive->item->image):url('/noImg.png') }}" alt="..." style=" height: 150px; width: 200px; border: none; object-fit: cover;" onerror="this.src='{{url('/noImg.png')}}'">
             </div>
              <div class="col-md-8">
                <div class="card-body offset-md-1">
                  <h6 class="card-title">{{$harddrive->item->title}}</h6>
                  <div class="row">
                <div class="col-md-6">
                 <label  style="font-size: 12px;">Price: ₱ {{$harddrive->item->price}}</label>
                 </div>
                 <div class="col-md-6">
                 <label  style="font-size: 12px;">Size: {{Converter::translateS($harddrive->capacity)}}</label>
                 </div>
               </div> 
               <div class="row">
                 <div class="col-md-6">
                 <label  style="font-size: 12px;">Rotational: {{$harddrive->rotational_speed}}</label>
                 </div>
                 <div class="col-md-6">
                 <label  style="font-size: 12px;">Transfer Rate: {{$harddrive->transfer_rate}} MBps</label>
                 </div>
                </div>

                <a href="{{route('pc.'.$category,$harddrive->item->item_id)}}" class="kave-btn" style="padding: 5px 20px 5px 20px; text-decoration: none;">
              <span class="kave-line"></span>
              ADD
              </a>
              {{-- START STAR --}}
              <small style="margin-left: 10px;">
              @php
              $hasrate = false;
              @endphp
              @foreach($reviews as $review)
              @if($review->item_id == $harddrive->item_id)
              {!!Star::display($review->review_rating)!!}
              @php
              $hasrate = true;
              @endphp
              @endif
              @endforeach
              @if($hasrate == false)
                No Ratings
              @endif
              </small>
              {{-- END STAR --}}

              <a href="{{route('product.showTobuy',['0'=>$harddrive->item_id, '1'=>"harddrive", '3' => 'fromBuilder'])}}"  style=" text-decoration: none; border: none; border-radius: 10; float: right;">  
                  <i class="fas fa-info-circle showMore"></i>
              </a> 

                </div>
              </div>
            </div>
          </div>
  @endforeach
@endif




{{-- FOR SOLID DRIVE--}}

@if($category == 'soliddrive')

@if($soliddrives->all()==null)
<h2>No Solid drive Available</h2>
@endif
  @foreach($soliddrives as $soliddrive)
          <div class="card mb-3 frosted-glass animate__animated animate__fadeInLeft" style="max-width: 540px; min-width: 550px; max-height: 150px; position:relative; top: 0px;">
            <div class="row no-gutters">
              <div class="col-md-4">
 <img class="proPic" src="{{$soliddrive->item->image != '' || $soliddrive->item->image != null?asset('src/images/products/'.$soliddrive->item->image):url('/noImg.png') }}" alt="..." style=" height: 150px; width: 200px; border: none; object-fit: cover;" onerror="this.src='{{url('/noImg.png')}}'">
              </div>
              <div class="col-md-8">
                <div class="card-body offset-md-1">
                  <h6 class="card-title">{{$soliddrive->item->title}}</h6>
                
                  <div class="row">
                <div class="col-md-6">
                 <label  style="font-size: 12px;">Price: ₱ {{$soliddrive->item->price}}</label>
                 </div>
                 <div class="col-md-6">
                 <label  style="font-size: 12px;">Size: {{Converter::translateS($soliddrive->capacity)}}</label>
                 </div>
               </div> 
               <div class="row">
                 <div class="col-md-6">
                 <label  style="font-size: 11px;">Read Speed: {{$soliddrive->read_speed}} MBps</label>
                 </div>
                 <div class="col-md-6">
                 <label  style="font-size: 11px;">Write Speed: {{$soliddrive->write_speed}} MBps</label>
                 </div>
                </div>

                <a href="{{route('pc.'.$category,$soliddrive->item->item_id)}}" class="kave-btn" style="padding: 5px 20px 5px 20px; text-decoration: none;">
              <span class="kave-line"></span>
              ADD
              </a>
                 {{-- START STAR --}}
              <small style="margin-left: 10px;">
              @php
              $hasrate = false;
              @endphp
              @foreach($reviews as $review)
              @if($review->item_id == $soliddrive->item_id)
              {!!Star::display($review->review_rating)!!}
              @php
              $hasrate = true;
              @endphp
              @endif
              @endforeach
              @if($hasrate == false)
                No Ratings
              @endif
              </small>
              {{-- END STAR --}}

              <a href="{{route('product.showTobuy',['0'=>$soliddrive->item_id, '1'=>"soliddrive", '3' => 'fromBuilder'])}}"  style=" text-decoration: none; border: none; border-radius: 10; float: right;">  
                  <i class="fas fa-info-circle showMore"></i>
              </a> 

                </div>
              </div>
            </div>
          </div>
  @endforeach
@endif







{{-- FOR VIDEO CARDS--}}

@if($category == 'videocard')

@if($videocards->all()==null)
<h2>No Video Card Available</h2>
@endif
  @foreach($videocards as $videocard)
          <div class="card mb-3 frosted-glass animate__animated animate__fadeInLeft" style="max-width: 540px; min-width: 550px; max-height: 150px; position:relative; top: 0px;">
            <div class="row no-gutters">
              <div class="col-md-4">
                <img class="proPic" src="{{$videocard->item->image != '' || $videocard->item->image != null?asset('src/images/products/'.$videocard->item->image):url('/noImg.png') }}" alt="..." style=" height: 150px; width: 200px; border: none; object-fit: cover;" onerror="this.src='{{url('/noImg.png')}}'">
              </div>
              <div class="col-md-8">
                <div class="card-body offset-md-1">
                  <h6 class="card-title">{{$videocard->item->title}}</h6>
                
                  <div class="row">
                <div class="col-md-6">
                 <label  style="font-size: 12px;">Price: ₱ {{$videocard->item->price}}</label>
                 </div>
                 <div class="col-md-6">
                 <label  style="font-size: 12px;">GPU: {{$videocard->gpu_brand}}</label>
                 </div>
               </div> 
               <div class="row">
                 <div class="col-md-6">
                 <label  style="font-size: 11px;">Core: {{$videocard->core_count}}</label>
                 </div>
                 <div class="col-md-6">
                 <label  style="font-size: 11px;">Memory: {{$videocard->memory_size}}GB {{$videocard->memory_type}}</label>
                 </div>
                </div>

                <a href="{{route('pc.'.$category,$videocard->item->item_id)}}" class="kave-btn" style="padding: 5px 20px 5px 20px; text-decoration: none;">
              <span class="kave-line"></span>
              ADD
              </a>
                 {{-- START STAR --}}
              <small style="margin-left: 10px;">
              @php
              $hasrate = false;
              @endphp
              @foreach($reviews as $review)
              @if($review->item_id == $videocard->item_id)
              {!!Star::display($review->review_rating)!!}
              @php
              $hasrate = true;
              @endphp
              @endif
              @endforeach
              @if($hasrate == false)
                No Ratings
              @endif
              </small>
              {{-- END STAR --}}
              <a href="{{route('product.showTobuy',['0'=>$videocard->item_id, '1'=>"videocard", '3' => 'fromBuilder'])}}"  style=" text-decoration: none; border: none; border-radius: 10; float: right;">  
                  <i class="fas fa-info-circle showMore"></i>
              </a> 

                </div>
              </div>
            </div>
          </div>
  @endforeach
@endif




{{-- FOR CASINGS--}}

@if($category == 'casing')

@if($casings == null)
<h2>No Compatible Casing Found</h2>
@endif
  @foreach($casings as $casing)
          <div class="card mb-3 frosted-glass animate__animated animate__fadeInLeft" style="max-width: 540px; min-width: 540px; max-height: 160px; position:relative; top: 0px;">
            <div class="row no-gutters">
              <div class="col-md-4">
                 <img class="proPic" src="{{$casing->item->image != '' || $casing->item->image != null?asset('src/images/products/'.$casing->item->image):url('/noImg.png') }}" alt="..." style=" height: 160px; width: 200px; border: none; object-fit: cover;" onerror="this.src='{{url('/noImg.png')}}'">
              </div>
              <div class="col-md-8">
                <div class="card-body offset-md-1">
                  <h6 class="card-title">{{$casing->item->title}}</h6>
                
                  <div class="row">
                <div class="col-md-6">
                 <label  style="font-size: 12px;">Price: ₱ {{$casing->item->price}}</label>
                 </div>
                 <div class="col-md-6">
                 <label  style="font-size: 12px;">Type: {{$casing->type}}</label>
                 </div>
               </div> 
               <div class="row">
                 <div class="col-md-6">
                 <label  style="font-size: 11px;">Mobo: {{$casing->case_motherboards}}</label>
                 </div>
                 <div class="col-md-6">

                 <label  style="font-size: 11px;">Weight: {{$casing->case_weight}}</label>
                 </div>
                </div>

                <a href="{{route('pc.'.$category,$casing->item->item_id)}}" class="kave-btn" style="padding: 5px 20px 5px 20px; text-decoration: none;">
              <span class="kave-line"></span>
              ADD
              </a>
                 {{-- START STAR --}}
              <small style="margin-left: 10px;">
              @php
              $hasrate = false;
              @endphp
              @foreach($reviews as $review)
              @if($review->item_id == $casing->item_id)
              {!!Star::display($review->review_rating)!!}
              @php
              $hasrate = true;
              @endphp
              @endif
              @endforeach
              @if($hasrate == false)
                No Ratings
              @endif
              </small>
              {{-- END STAR --}}
              <a href="{{route('product.showTobuy',['0'=>$casing->item_id, '1'=>"casing", '3' => 'fromBuilder'])}}"  style=" text-decoration: none; border: none; border-radius: 10; float: right;">  
                  <i class="fas fa-info-circle showMore"></i>
              </a> 
                </div>
              </div>
            </div>
          </div>
  @endforeach
@endif





{{-- FOR POWER SUPPLY--}}

@if($category == 'powersupply')
@if($powersupplies->first() == null)
<h2>No Compatible Power Supply Found</h2>
@endif
  @foreach($powersupplies as $powersupply)
          <div class="card mb-3 frosted-glass animate__animated animate__fadeInLeft" style="max-width: 540px; min-width: 550px; max-height: 160px; position:relative; top: 0px; padding-bottom: 10px;">
            <div class="row no-gutters">
              <div class="col-md-4">
                <img class="proPic" src="{{$powersupply->item->image != '' || $powersupply->item->image != null?asset('src/images/products/'.$powersupply->item->image):url('/noImg.png') }}" alt="..." style=" height: 160px; width: 200px; border: none; object-fit: cover;" onerror="this.src='{{url('/noImg.png')}}'">
              </div>
              <div class="col-md-8">
                <div class="card-body offset-md-1">
                  <h6 class="card-title">{{$powersupply->item->title}}</h6>
                
                  <div class="row">
                <div class="col-md-6">
                 <label  style="font-size: 12px;">Price: ₱ {{$powersupply->item->price}}</label>
                 </div>
                 <div class="col-md-6">
                 <label  style="font-size: 12px;">Wattage: {{$powersupply->wattage}}</label>
                 </div>
               </div> 
               <div class="row">
                 <div class="col-md-6">
                 <label  style="font-size: 11px;">Rails: {{$powersupply->rails}}</label>
                 </div>
                 <div class="col-md-6">

                 <label  style="font-size: 11px;">Form Factor: {{$powersupply->form_factor}}</label>
                 </div>
                </div>

                <a href="{{route('pc.'.$category,$powersupply->item->item_id)}}" class="kave-btn" style="padding: 5px 20px 5px 20px; text-decoration: none;">
              <span class="kave-line"></span>
              ADD
              </a>
                 {{-- START STAR --}}
              <small style="margin-left: 10px;">
              @php
              $hasrate = false;
              @endphp
              @foreach($reviews as $review)
              @if($review->item_id == $powersupply->item_id)
              {!!Star::display($review->review_rating)!!}
              @php
              $hasrate = true;
              @endphp
              @endif
              @endforeach
              @if($hasrate == false)
                No Ratings
              @endif
              </small>
              {{-- END STAR --}}

              <a href="{{route('product.showTobuy',['0'=>$powersupply->item_id, '1'=>"powersupply", '3' => 'fromBuilder'])}}"  style=" text-decoration: none; border: none; border-radius: 10; float: right;">  
                  <i class="fas fa-info-circle showMore"></i>
              </a> 

                </div>
              </div>
            </div>
          </div>
  @endforeach
@endif





{{-- FOR KEYBOARD--}}

@if($category == 'keyboard')
@if($keyboards->first() == null)
<h2>No Keyboards Available</h2>
@endif
  @foreach($keyboards as $keyboard)
          <div class="card mb-3 frosted-glass animate__animated animate__fadeInLeft" style="max-width: 540px; min-width: 550px; max-height: 150px; position:relative; top: 0px; padding-bottom: 10px;">
            <div class="row no-gutters">
              <div class="col-md-4">
 <img class="proPic" src="{{$keyboard->item->image != '' || $keyboard->item->image != null?asset('src/images/products/'.$keyboard->item->image):url('/noImg.png') }}" alt="..." style=" height: 150px; width: 200px; border: none; object-fit: cover;" onerror="this.src='{{url('/noImg.png')}}'">
              </div>
              <div class="col-md-8">
                <div class="card-body offset-md-1">
                  <h6 class="card-title">{{$keyboard->item->title}}</h6>
                
                  <div class="row">
                <div class="col-md-6">
                 <label  style="font-size: 12px;">Price: ₱ {{$keyboard->item->price}}</label>
                 </div>
                 <div class="col-md-6">
                 <label  style="font-size: 12px;">Width: {{$keyboard->keyboard_width}}"</label>
                 </div>
               </div> 
               <div class="row">
                 <div class="col-md-6">
                 <label  style="font-size: 11px;">Length: {{$keyboard->keyboard_length}}"</label>
                 </div>
                 <div class="col-md-6">
                 <label  style="font-size: 11px;">Color: {{$keyboard->color}}</label>
                 </div>
                </div>

                <a href="{{route('pc.'.$category,$keyboard->item->item_id)}}" class="kave-btn" style="padding: 5px 20px 5px 20px; text-decoration: none;">
              <span class="kave-line"></span>
              ADD
              </a>
                 {{-- START STAR --}}
              <small style="margin-left: 10px;">
              @php
              $hasrate = false;
              @endphp
              @foreach($reviews as $review)
              @if($review->item_id == $keyboard->item_id)
              {!!Star::display($review->review_rating)!!}
              @php
              $hasrate = true;
              @endphp
              @endif
              @endforeach
              @if($hasrate == false)
                No Ratings
              @endif
              </small>
              {{-- END STAR --}}
              <a href="{{route('product.showTobuy',['0'=>$keyboard->item_id, '1'=>"keyboard", '3' => 'fromBuilder'])}}"  style=" text-decoration: none; border: none; border-radius: 10; float: right;">  
                  <i class="fas fa-info-circle showMore"></i>
              </a> 

                </div>
              </div>
            </div>
          </div>
  @endforeach
@endif




{{-- FOR MOUSE--}}

@if($category == 'mouse')
@if($mouses->first() == null)
<h2>No Mouses Available</h2>
@endif
  @foreach($mouses as $mouse)
          <div class="card mb-3 frosted-glass animate__animated animate__fadeInLeft" style="max-width: 540px; min-width: 550px; max-height: 150px; position:relative; top: 0px; padding-bottom: 10px;">
            <div class="row no-gutters">
              <div class="col-md-4">
                 <img class="proPic" src="{{$mouse->item->image != '' || $mouse->item->image != null?asset('src/images/products/'.$mouse->item->image):url('/noImg.png') }}" alt="..." style=" height: 150px; width: 200px; border: none; object-fit: cover;" onerror="this.src='{{url('/noImg.png')}}'">
              </div>
              <div class="col-md-8">
                <div class="card-body offset-md-1">
                  <h6 class="card-title">{{$mouse->item->title}}</h6>
                
                  <div class="row">
                <div class="col-md-6">
                 <label  style="font-size: 12px;">Price: ₱ {{$mouse->item->price}}</label>
                 </div>
                 <div class="col-md-6">
                 <label  style="font-size: 12px;">Sensor: {{$mouse->sensor}}</label>
                 </div>
               </div> 
               <div class="row">
                 <div class="col-md-6">
                 <label  style="font-size: 11px;">Wired: {{$mouse->mouse_wired}}</label>
                 </div>
                 <div class="col-md-6">
                 <label  style="font-size: 11px;">Programmable: {{$mouse->programmable_button}}</label>
                 </div>
                </div>

                <a href="{{route('pc.'.$category,$mouse->item->item_id)}}" class="kave-btn" style="padding: 5px 20px 5px 20px; text-decoration: none;">
              <span class="kave-line"></span>
              ADD
              </a>
                 {{-- START STAR --}}
              <small style="margin-left: 10px;">
              @php
              $hasrate = false;
              @endphp
              @foreach($reviews as $review)
              @if($review->item_id == $mouse->item_id)
              {!!Star::display($review->review_rating)!!}
              @php
              $hasrate = true;
              @endphp
              @endif
              @endforeach
              @if($hasrate == false)
                No Ratings
              @endif
              </small>
              {{-- END STAR --}}
              <a href="{{route('product.showTobuy',['0'=>$mouse->item_id, '1'=>"mouse", '3' => 'fromBuilder'])}}"  style=" text-decoration: none; border: none; border-radius: 10; float: right;">  
                  <i class="fas fa-info-circle showMore"></i>
              </a> 

                </div>
              </div>
            </div>
          </div>
  @endforeach
@endif


{{-- FOR MONITOR--}}

@if($category == 'monitor')
@if($monitors->first() == null)
<h2>No Monitors Available</h2>
@endif
  @foreach($monitors as $monitor)
          <div class="card mb-3 frosted-glass animate__animated animate__fadeInLeft" style="max-width: 540px; min-width: 550px; max-height: 150px; position:relative; top: 0px; padding-bottom: 10px;">
            <div class="row no-gutters">
              <div class="col-md-4">
                 <img class="proPic" src="{{$monitor->item->image != '' || $monitor->item->image != null?asset('src/images/products/'.$monitor->item->image):url('/noImg.png') }}" alt="..." style=" height: 150px; width: 200px; border: none; object-fit: cover;" onerror="this.src='{{url('/noImg.png')}}'">
              </div>
              <div class="col-md-8">
                <div class="card-body offset-md-1">
                  <h6 class="card-title">{{$monitor->item->title}}</h6>
                
                  <div class="row">
                <div class="col-md-6">
                 <label  style="font-size: 12px;">Price: ₱ {{$monitor->item->price}}</label>
                 </div>
                 <div class="col-md-6">
                 <label  style="font-size: 12px;">Size: {{$monitor->minitor_size}}"</label>
                 </div>
               </div> 
               <div class="row">
                 <div class="col-md-6">
                 <label  style="font-size: 11px;">Aspect: {{$monitor->monitor_aspect}}</label>
                 </div>
                 <div class="col-md-6">
                 <label  style="font-size: 11px;">Refresh Rate: {{$monitor->refresh_rate}} Hz</label>
                 </div>
                </div>

                <a href="{{route('pc.'.$category,$monitor->item->item_id)}}" class="kave-btn" style="padding: 5px 20px 5px 20px; text-decoration: none;">
              <span class="kave-line"></span>
              ADD
              </a>
                 {{-- START STAR --}}
              <small style="margin-left: 10px;">
              @php
              $hasrate = false;
              @endphp
              @foreach($reviews as $review)
              @if($review->item_id == $monitor->item_id)
              {!!Star::display($review->review_rating)!!}
              @php
              $hasrate = true;
              @endphp
              @endif
              @endforeach
              @if($hasrate == false)
                No Ratings
              @endif
              </small>
              {{-- END STAR --}}
              <a href="{{route('product.showTobuy',['0'=>$monitor->item_id, '1'=>"monitor", '3' => 'fromBuilder'])}}"  style=" text-decoration: none; border: none; border-radius: 10; float: right;">  
                  <i class="fas fa-info-circle showMore"></i>
              </a> 

                </div>
              </div>
            </div>
          </div>
  @endforeach
@endif




{{-- FOR HEADPHONE--}}

@if($category == 'headphone')
@if($headphones->first() == null)
<h2>No Headphones Available</h2>
@endif
  @foreach($headphones as $headphone)
          <div class="card mb-3 frosted-glass animate__animated animate__fadeInLeft" style="max-width: 540px; min-width: 550px; max-height: 150px; position:relative; top: 0px; padding-bottom: 10px;">
            <div class="row no-gutters">
              <div class="col-md-4">
                 <img class="proPic" src="{{$headphone->item->image != '' || $headphone->item->image != null?asset('src/images/products/'.$headphone->item->image):url('/noImg.png') }}" alt="..." style=" height: 150px; width: 200px; border: none; object-fit: cover;" onerror="this.src='{{url('/noImg.png')}}'">
              </div>
              <div class="col-md-8">
                <div class="card-body offset-md-1">
                  <h6 class="card-title">{{$headphone->item->title}}</h6>
                
                  <div class="row">
                <div class="col-md-6">
                 <label  style="font-size: 12px;">Price: ₱ {{$headphone->item->price}}</label>
                 </div>
                 <div class="col-md-6">
                 <label  style="font-size: 12px;">Frequency: {{$headphone->frequency_response}} Hz</label>
                 </div>
               </div> 
               <div class="row">
                 <div class="col-md-6">
                 <label  style="font-size: 11px;">Driver Size: {{$headphone->driver_size}} mm</label>
                 </div>
                 <div class="col-md-6">
                 <label  style="font-size: 11px;">Weight: {{$headphone->weight}} grams</label>
                 </div>
                </div>

                <a href="{{route('pc.'.$category,$headphone->item->item_id)}}" class="kave-btn" style="padding: 5px 20px 5px 20px; text-decoration: none;">
              <span class="kave-line"></span>
              ADD
              </a>
                 {{-- START STAR --}}
              <small style="margin-left: 10px;">
              @php
              $hasrate = false;
              @endphp
              @foreach($reviews as $review)
              @if($review->item_id == $headphone->item_id)
              {!!Star::display($review->review_rating)!!}
              @php
              $hasrate = true;
              @endphp
              @endif
              @endforeach
              @if($hasrate == false)
                No Ratings
              @endif
              </small>
              {{-- END STAR --}}
              <a href="{{route('product.showTobuy',['0'=>$headphone->item_id, '1'=>"headphone", '3' => 'fromBuilder'])}}"  style=" text-decoration: none; border: none; border-radius: 10; float: right;">  
                  <i class="fas fa-info-circle showMore"></i>
              </a> 

                </div>
              </div>
            </div>
          </div>
  @endforeach
@endif





{{-- FOR PRINTER--}}

@if($category == 'printer')
@if($printers->first() == null)
<h2>No Printers Available</h2>
@endif
  @foreach($printers as $printer)
          <div class="card mb-3 frosted-glass animate__animated animate__fadeInLeft" style="max-width: 540px; min-width: 550px; max-height: 160px; position:relative; top: 0px; padding-bottom: 10px;">
            <div class="row no-gutters">
              <div class="col-md-4">
                 <img class="proPic" src="{{$printer->item->image != '' || $printer->item->image != null?asset('src/images/products/'.$printer->item->image):url('/noImg.png') }}" alt="..." style=" height: 160px; width: 200px; border: none; object-fit: cover;" onerror="this.src='{{url('/noImg.png')}}'">
              </div>
              <div class="col-md-8">
                <div class="card-body offset-md-1">
                  <h6 class="card-title">{{$printer->item->title}}</h6>
                
                  <div class="row">
                <div class="col-md-6">
                 <label  style="font-size: 12px;">Price: ₱ {{$printer->item->price}}</label>
                 </div>
                 <div class="col-md-6">
                 <label  style="font-size: 12px;">Type: {{$printer->printer_type}}</label>
                 </div>
               </div> 
               <div class="row">
                 <div class="col-md-6">
                 <label  style="font-size: 11px;">Ink: {{$printer->ink_type}}</label>
                 </div>
                 <div class="col-md-6">
                 <label  style="font-size: 11px;">All in One: {{$printer->all_inOne}}</label>
                 </div>
                </div>

                <a href="{{route('pc.'.$category,$printer->item->item_id)}}" class="kave-btn" style="padding: 5px 20px 5px 20px; text-decoration: none;">
              <span class="kave-line"></span>
              ADD
              </a>
                 {{-- START STAR --}}
              <small style="margin-left: 10px;">
              @php
              $hasrate = false;
              @endphp
              @foreach($reviews as $review)
              @if($review->item_id == $printer->item_id)
              {!!Star::display($review->review_rating)!!}
              @php
              $hasrate = true;
              @endphp
              @endif
              @endforeach
              @if($hasrate == false)
                No Ratings
              @endif
              </small>
              {{-- END STAR --}}
              <a href="{{route('product.showTobuy',['0'=>$printer->item_id, '1'=>"printer", '3' => 'fromBuilder'])}}"  style=" text-decoration: none; border: none; border-radius: 10; float: right;">  
                  <i class="fas fa-info-circle showMore"></i>
              </a> 

                </div>
              </div>
            </div>
          </div>
  @endforeach
@endif


{{-- FOR OPERATING SYSTEM--}}

@if($category == 'operatingsystem')
@if($problemCounter == 0)
@if($operatingsystems->first() == null)
<h2>No Operating System Available</h2>
@endif
  @foreach($operatingsystems as $operatingsystem)
          <div class="card mb-3 frosted-glass animate__animated animate__fadeInLeft" style="max-width: 540px; min-width: 550px; max-height: 150px; position:relative; top: 0px; padding-bottom: 10px;">
            <div class="row no-gutters">
              <div class="col-md-4">
                <img class="proPic" src="{{$operatingsystem->item->image != '' || $operatingsystem->item->image != null?asset('src/images/products/'.$operatingsystem->item->image):url('/noImg.png') }}" alt="..." style=" height: 150px; width: 200px; border: none; object-fit: cover;" onerror="this.src='{{url('/noImg.png')}}'">
              </div>
              <div class="col-md-8">
                <div class="card-body offset-md-1">
                  <h6 class="card-title">{{$operatingsystem->item->title}}</h6>
                
                  <div class="row">
                <div class="col-md-5">
                 <label  style="font-size: 12px;">Price: ₱ {{$operatingsystem->item->price}}</label>
                 </div>
                 <div class="col-md-6">
                 <label  style="font-size: 12px;">Memory Need: {{$operatingsystem->memory_requirement}} GB</label>
                 </div>
               </div> 
               <div class="row">
                 <div class="col-md-5">
                 <label  style="font-size: 11px;">Space Need: {{$operatingsystem->space_requirement}} GB</label>
                 </div>
                 <div class="col-md-6">
                 <label  style="font-size: 11px;">Processor Speed: {{$operatingsystem->processor_speed}} GHz</label>
                 </div>
                </div>

                <a href="{{route('pc.'.$category,$operatingsystem->item->item_id)}}" class="kave-btn" style="padding: 5px 20px 5px 20px; text-decoration: none;">
              <span class="kave-line"></span>
              ADD
              </a>
                 {{-- START STAR --}}
              <small style="margin-left: 10px;">
              @php
              $hasrate = false;
              @endphp
              @foreach($reviews as $review)
              @if($review->item_id == $operatingsystem->item_id)
              {!!Star::display($review->review_rating)!!}
              @php
              $hasrate = true;
              @endphp
              @endif
              @endforeach
              @if($hasrate == false)
                No Ratings
              @endif
              </small>
              {{-- END STAR --}}
              <a href="{{route('product.showTobuy',['0'=>$operatingsystem->item_id, '1'=>"operatingsystem", '3' => 'fromBuilder'])}}"  style=" text-decoration: none; border: none; border-radius: 10; float: right;">  
                  <i class="fas fa-info-circle showMore"></i>
              </a> 

                </div>
              </div>
            </div>
          </div>
  @endforeach
  @else
  <h2>Opps!!! Problem Detected <i class="fas fa-exclamation-triangle"></i></h2>
    @foreach($problems as $problem)
      <ul style="list-style: none;">
        <li>{{$problem}}</li>
      </ul>
    @endforeach
  @endif
@endif


	</div>


<style type="text/css">
  li{
    margin-bottom: 10px;
    margin-top: 10px;
  }
  b{
    font-size: 13px;
  }
</style>
<div class="col-md-3 miniGlass animate__animated animate__fadeInRight" style=" border-radius: 20px; margin-left: 20px; right: 0px; height: unset; margin-top: 70px; margin-right: 10px; margin-bottom: 0px; padding-bottom: 20px;"  >
  <h6 style="margin: 10px;">Guide:</h6>
   


   @if($category == 'processor')

    @if($processors->first() != null)
    <div class="row" style="font-size: 12px">
      <div class="col-md">
        The Processor determines how much data a computer can handle at one time and how quickly it can handle that data. The main things to consider when buying a CPU are the number of cores needed, what the computer will be used for, and the type of software to be run.
    
    <ul>
        <li><b>4 Cores</b> – General use, light browsing, and very light gaming.</li>

        <li><b>8 Cores</b> – Decent for gaming, moderate multi-tasking, and all general-use purposes.</li>

        <li><b>16 Cores</b> – Entry-level workstation CPU. Can handle moderately demanding tasks if coupled with good RAM and decent clock frequencies.</li>

        <li><b>32 Cores</b> – Mid-range workstation CPU. Handles fairly demanding tasks including rendering, CAD, and all kinds of streaming.</li>

        <li><b>64 Cores</b> – High-end workstation CPU. Handles the most demanding workstation tasks.</li>
    </ul>

      </div>
    </div>
    @endif

   @endif


    @if($category == 'motherboard')
    @if($motherboards->all()!=null)
    <div class="row" style="font-size: 13px">
      <div class="col-md">
       After picking a Processor, a complementary motherboard will typically be the next component you select for your build. Don't worry we automatically display in the list all of the compatible motherboards for your processor.

      </div>
    </div>
    <br>
     <div class="row" style="font-size: 13px">
      <div class="col-md">
       A Motherboard is a circuit board that connects all of your hardware to your processor, distributes electricity from your power supply, and defines the types of storage devices, memory modules, and graphics cards that can connect to your PC.

      </div>
    </div>
      @endif
   @endif



   @if($category == 'memory')

    @if($memories->all() != null)
    <div class="row" style="font-size: 12px">
      <div class="col-md">
        With the right amount of RAM on your computer the performance of your PC and the ability to support various types of software is optimized. It can be considered just as important as your processor, or hard drive. The best way to get the most out of your computer is by having a
    <ul>
        <li><b>4GB to 8GB</b>- Best for browsing, email, light gaming, and use text processing.</li>
        <li><b>16GB</b>- Best for professional work, gaming, and editing 4K videos. </li>
        <li><b>32GB</b>Best for VR games or latest high-end games.</li>
        <li><b>32GB to 64GB</b>- Best for running virtual machines.</li>
    </ul>

      </div>
    </div>
    @endif
   @endif
   

    @if($category == 'harddrive')
    @if($harddrives->all() != null)
    <div class="row" style="font-size: 12px">
      <div class="col-md">
        A hard drive is a piece of hardware that holds all of your digital files. Digital material on a hard disk includes documents, photos, music, videos, programs, application preferences, and the operating system. External or internal hard drives can be used to store data from several PCs.
    <ul>
        <li><b>250GB to 320GB</b> - Best for storing images or songs</li>
        <li><b>500GB to 1000GB</b> - Best for storing movies</li>
    </ul>

      </div>
    </div>
    @endif
   @endif

    @if($category == 'soliddrive')
    @if($soliddrives->all() != null)
    <div class="row" style="font-size: 12px">
      <div class="col-md">
        An SSD (solid-state drive) is a newer and more advanced type of hard drive that serves as a computer storage device. SSDs access and send data more fast than traditional drives because they have no moving parts. 
    <ul>
        <li><b>500GB or Below </b> - Best for booting your computer more quickly.</li>
        <li><b>1000GB/1TB</b> - Best for gaming.</li>
        <li><b>2000GB/2TB</b> - Best for photo and video editing.</li>
    </ul>

      </div>
    </div>
    @endif
   @endif


    @if($category == 'videocard')
    @if($videocards->all() != null)
    <div class="row" style="font-size: 12px">
      <div class="col-md">
        The GPU is more responsible than any other component in a PC for the quality of the graphics, or visual elements, that appear on your screen. In the beginning, CPUs were responsible for both processing and rendering graphics, but nowadays, almost every PC on the market comes with a graphics card of some sort. 
    <ul>
        <li>The latest version of the graphics card for the console is expected to have <b>4GB</b> of dedicated VRAM </li>
        <li>If you want a future-proof graphics card and/or a 1440p or 4K monitor, go for <b>8GB</b> of VRAM.</li>
    </ul>

      </div>
    </div>
    @endif
   @endif

   @if($category == 'casing')
    @if($casings != null)
    <div class="row" style="font-size: 14px">
      <div class="col-md">
       We use computer cases for a variety of reasons, the most obvious of which being protection. Dust, animals, toys, liquids, and other elements can all harm a computer's internal components if the hard shell of the case does not completely encapsulate them and keep them safe from the elements.
 

      </div>
    </div>
    @endif
   @endif

    @if($category == 'powersupply')
    @if($powersupplies->first() != null)
    <div class="row" style="font-size: 14px">
      <div class="col-md">
       The power supply is one of the least fascinating but most important PC components. Of course, PCs function on power, which isn't supplied straight from the wall to every component inside the casing. Instead, electricity travels from the power company's alternating current (AC) to the direct current (DC) needed by PC components at the required voltage. Don't worry we automatically display in the list all of the compatible power supply units for your pc build. We also provided you a recommended PSU wattage for your system. You can see it beside the "Total Price". 
      </div>
    </div>
    @endif
   @endif


    @if($category == 'keyboard')
    @if($keyboards->first() != null)
    <div class="row" style="font-size: 15px">
      <div class="col-md">
      A keyboard is used to enter data into your computer, such as letters, words, and numbers. When you type, you use the individual keys on the keyboard. The number keys that run across the top of a keyboard can also be located on the right side. They're utilized to locate the letter keys in the keyboard's center.
      </div>
    </div>
    @endif
   @endif

    @if($category == 'mouse')
    @if($mouses->first() != null)
    <div class="row" style="font-size: 15px">
      <div class="col-md">
     A computer mouse is a two-dimensional motion detection device that is held in the hand. This motion is usually translated into the movement of a pointer on a display, allowing for smooth control of a computer's graphical user interface.
      </div>
    </div>
    @endif
   @endif

    @if($category == 'monitor')
    @if($monitors->first() != null)
    <div class="row" style="font-size: 15px">
      <div class="col-md">
   A computer monitor displays text and images generated by computer programs and serves as a visual interface for computer users. Monitors resemble television sets and are connected to the main computer through a wire.
      </div>
    </div>
    @endif
   @endif

    @if($category == 'headphone')
    @if($headphones->first() != null)
    <div class="row" style="font-size: 15px">
      <div class="col-md">
   Headphones, often known as earphones, are a type of hardware output device that connects to a computer's line out or speakers port. Headphones allow you to listen to music or view a movie while without bothering others.
      </div>
    </div>
    @endif
   @endif

   @if($category == 'printer')
    @if($printers->first() != null)
    <div class="row" style="font-size: 15px">
      <div class="col-md">
   A printer's job is to take written text and visual pictures from a computer and convert them to paper. Printers come in a wide range of prices, speeds, sizes, and functions.
      </div>

      <ul>
        <li style="list-style: none;"><h6>Types of Printer</h6></li>
        <li><b>InkJet </b> - Is a printer that makes use of ink and sprays droplets onto the paper.</li>
        <li><b>Laser</b> -  This printers make use of toner. They melt the toner powder and print it onto the paper. </li>
    </ul>

    </div>
    @endif
   @endif


   @if($category == 'operatingsystem')
    @if($problemCounter == 0)
    @if($operatingsystems->first() != null)
    <div class="row" style="font-size: 15px">
      <div class="col-md">
An operating system's aim is to offer a platform for a user to run applications in a convenient and efficient way. An operating system is a piece of software that controls how computer hardware is allocated. Don't worry we automatically display in the list all of the compatible operating system for your pc build.
      </div>

    </div>
    @endif
    @endif
   @endif

</div>




</div>

</body>




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
@endsection