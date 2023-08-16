@extends('layouts.master')
@section('title')
 Builder|Finish
@endsection
@section('content')
<link rel="stylesheet" type="text/css" href="{{URL::to('src/css/builder.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::to('src/css/progressBar.css')}}">

<style type="text/css">
    .mt-0{
        font-size: 13px;
    }
    img{
        border-radius: 10px;
    }
</style>
<div class="row" >
    <div class="col-md frosted-glass" style=" border-radius: 0px; width:  70%; height:  85%; margin-left: 5px; ">
        <div class="row">
            <div class="col-md-4" style="margin: 5px;">
            <h5>Parts Summary</h5>
            </div>
        </div>

        <div class="row" style="font-size:10px;">

         @if($processor != null)
            <div class="col-md-3">
                <div class="media">
                  {{--   {{dd($processor->item->image)}} --}}



                  <img src="{{$processor->item->image != null || $processor->item->image != '' ? asset('src/images/products/'.$processor->item->image): url('/noImg.png')}}"  onerror="this.src='{{url('/noImg.png')}}'" class="mr-3" alt="..." style="height: 50px; width: 50px; object-fit: cover; background: white;">
                  <div class="media-body">
                    <h6 style="font-size: 13px">Processor</h6>
                    <p>
                        Name: {{$processor->item->title}}<br>
                        Core: {{$processor->core_count}}<br>
                        Base Speed: {{$processor->base_speed}} Ghz<br>
                        Max Speed: {{$processor->base_speed}} Ghz<br>
                        Price: ₱ {{$processor->item->price}}<br>
                    </p>
                  </div>
                </div> 
            </div>
        @endif

        @if($motherboard != null)
             <div class="col-md-3">
                <div class="media">
                  <img src="{{$motherboard->item->image != null || $motherboard->item->image != ""? asset('src/images/products/'.$motherboard->item->image): url('/noImg.png')}}"  onerror="this.src='{{url('/noImg.png')}}'" class="mr-3" alt="..." style="height: 50px; width: 50px; object-fit: cover; background: white;">
                  <div class="media-body">
                    <h6 style="font-size: 13px">Motherboard</h6>
                    <p>
                        Name: {{$motherboard->item->title}}<br>
                        Form Factor: {{$motherboard->form_factor}}<br>
                        CPU Socket: {{$motherboard->cpu_socket}}<br>
                        RAM Slot:  {{$motherboard->ram_slot}}<br>
                        Price: ₱ {{$motherboard->item->price}}<br>
                    </p>
                  </div>
                </div> 
            </div>
        @endif

        @if($memory != null)
            <div class="col-md-3">
                <div class="media">
                  <img src="{{$memory->item->image != null || $memory->item->image != ""? asset('src/images/products/'.$memory->item->image): url('/noImg.png')}}"  onerror="this.src='{{url('/noImg.png')}}'" class="mr-3" alt="..." style="height: 50px; width: 50px; object-fit: cover; background: white;">
                  <div class="media-body">
                    <h6 class="mt-0">Memory</h6>
                    <p>
                        Name: {{$memory->item->title}}<br>
                        Size: {{$memory->memory_size}} GB<br>
                        Type: {{$memory->memory_type}}<br>
                        Frequency: {{$memory->frequency}}<br>
                        Price: ₱ {{$memory->item->price}}<br>
                    </p>
                  </div>
                </div> 
            </div>
        @endif

        @if($harddrive != null)
             <div class="col-md-3">
                <div class="media">
                  <img src="{{$harddrive->item->image != null || $harddrive->item->image != ""? asset('src/images/products/'.$harddrive->item->image): url('/noImg.png')}}"  onerror="this.src='{{url('/noImg.png')}}'" class="mr-3" alt="..." style="height: 50px; width: 50px; object-fit: cover; background: white;">
                  <div class="media-body">
                    <h6 class="mt-0">Harddrive</h6>
                    <p>
                        Name: {{$harddrive->item->title}}<br>
                        Size: {{$harddrive->capacity}} GB<br>
                        Rotational:  {{$harddrive->rotational_speed}}<br>
                        Transfer Rate: {{$harddrive->trasnfer_rate}}<br>
                        Price: ₱ {{$harddrive->item->price}}<br>
                    </p>
                  </div>
                </div> 
            </div>
        @endif

        @if($soliddrive != null)
             <div class="col-md-3">
                <div class="media">
                  <img src="{{$soliddrive->item->image != null || $soliddrive->item->image != ""? asset('src/images/products/'.$soliddrive->item->image): url('/noImg.png')}}"  onerror="this.src='{{url('/noImg.png')}}'" class="mr-3" alt="..." style="height: 50px; width: 50px; object-fit: cover; background: white;">
                  <div class="media-body">
                    <h6 class="mt-0">Soliddrive</h6>
                    <p>
                        Name: {{$soliddrive->item->title}}<br>
                        Size: {{$soliddrive->capacity}}GB<br>
                        Read Speed: {{$soliddrive->read_speed}}<br>
                        Write Speed: {{$soliddrive->write_rate}}<br>
                        Price: ₱ {{$soliddrive->item->price}}<br>
                    </p>
                  </div>
                </div> 
            </div>
        @endif

        @if($videocard != null)
             <div class="col-md-3">
                <div class="media">
                  <img src="{{$videocard->item->image != null || $videocard->item->image != ""? asset('src/images/products/'.$videocard->item->image): url('/noImg.png')}}"  onerror="this.src='{{url('/noImg.png')}}'" class="mr-3" alt="..." style="height: 50px; width: 50px; object-fit: cover; background: white;">
                  <div class="media-body">
                    <h6 class="mt-0">Videocard</h6>
                    <p>
                        Name: {{$videocard->item->title}}<br>
                        GPU: {{$videocard->gpu_brand}}<br>
                        Core: {{$videocard->core_count}}<br>
                        Memory: {{$videocard->memory_size}} {{$videocard->memory_type}}<br>
                        Price:  ₱ {{$videocard->item->price}}<br>
                    </p>
                  </div>
                </div> 
            </div>
        @endif

        @if($casing != null)
             <div class="col-md-3">
                <div class="media">
                  <img src="{{$casing->item->image != null || $casing->item->image != ""? asset('src/images/products/'.$casing->item->image): url('/noImg.png')}}"  onerror="this.src='{{url('/noImg.png')}}'" class="mr-3" alt="..." style="height: 50px; width: 50px; object-fit: cover; background: white;">
                  <div class="media-body">
                    <h6 class="mt-0">Casing</h6>
                    <p>
                        Name: {{$casing->item->title}}<br>
                        Type: {{$casing->type}}<br>
                        Mobo: {{$casing->case_motherboards}}<br>
                        Weight: {{$casing->case_weight}}<br>
                        Price: ₱ {{$casing->item->price}}<br>
                    </p>
                  </div>
                </div> 
            </div>
        @endif  

        @if($powersupply != null)
             <div class="col-md-3">
                <div class="media">
                  <img src="{{$powersupply->item->image != null || $powersupply->item->image != ""? asset('src/images/products/'.$powersupply->item->image): url('/noImg.png')}}"  onerror="this.src='{{url('/noImg.png')}}'" class="mr-3" alt="..." style="height: 50px; width: 50px; object-fit: cover; background: white;">
                  <div class="media-body">
                    <h6 class="mt-0">Powersupply</h6>
                    <p>
                        Name: {{$powersupply->item->title}}<br>
                        Wattage: {{$powersupply->wattage}}<br>
                        Efficiency Rating: {{$powersupply->efficiency_rating}}<br>
                        Form Factor: {{$powersupply->form_factor}}<br>
                        Price: ₱ {{$powersupply->item->price}}<br>
                    </p>
                  </div>
                </div> 
            </div>
        @endif

        @if($keyboard != null)
             <div class="col-md-3">
                <div class="media">
                  <img src="{{$keyboard->item->image != null || $keyboard->item->image != ""? asset('src/images/products/'.$keyboard->item->image): url('/noImg.png')}}"  onerror="this.src='{{url('/noImg.png')}}'" class="mr-3" alt="..." style="height: 50px; width: 50px; object-fit: cover; background: white;">
                  <div class="media-body">
                    <h6 class="mt-0">Keyboard</h6>
                    <p>
                        Name: {{$keyboard->item->title}}<br>
                        Width: {{$keyboard->keyboard_width}}<br>
                        Length: {{$keyboard->keyboard_length}}<br>
                        Color: {{$keyboard->color}}<br>
                        Price: ₱ {{$keyboard->item->price}}<br>
                    </p>
                  </div>
                </div> 
            </div>
        @endif

         @if($mouse != null)
             <div class="col-md-3">
                <div class="media">
                  <img src="{{$mouse->item->image != null || $mouse->item->image != ""? asset('src/images/products/'.$mouse->item->image): url('/noImg.png')}}"  onerror="this.src='{{url('/noImg.png')}}'" class="mr-3" alt="..." style="height: 50px; width: 50px; object-fit: cover; background: white;">
                  <div class="media-body">
                    <h6 class="mt-0">Mouse</h6>
                    <p>
                        Name: {{$mouse->item->title}}<br>
                        Sensor: {{$mouse->sensor}}<br>
                        Wired: {{$mouse->mouse_wired}}<br>
                        Programmable: {{$mouse->programmable_button}}<br>
                        Price: ₱ {{$mouse->item->price}}<br>
                    </p>
                  </div>
                </div> 
            </div>
        @endif

        @if($monitor != null)
             <div class="col-md-3">
                <div class="media">
                  <img src="{{$monitor->item->image != null || $monitor->item->image != ""? asset('src/images/products/'.$monitor->item->image): url('/noImg.png')}}"  onerror="this.src='{{url('/noImg.png')}}'" class="mr-3" alt="..." style="height: 50px; width: 50px; object-fit: cover; background: white;">
                  <div class="media-body">
                    <h6 class="mt-0">Monitor</h6>
                    <p>
                        Name: {{$monitor->item->title}}<br>
                        Resolution: {{$monitor->minitor_resolution}}<br>
                        Aspect: {{$monitor->monitor_aspect}}<br>
                        Refresh Rate: {{$monitor->refresh_rate}}<br>
                        Price: ₱ {{$monitor->item->price}}<br>
                    </p>
                  </div>
                </div> 
            </div>
        @endif

        @if($headphone != null)
            <div class="col-md-3">
                <div class="media">
                  <img src="{{$headphone->item->image != null || $headphone->item->image != ""? asset('src/images/products/'.$headphone->item->image): url('/noImg.png')}}"  onerror="this.src='{{url('/noImg.png')}}'" class="mr-3" alt="..." style="height: 50px; width: 50px; object-fit: cover; background: white;">
                  <div class="media-body">
                    <h6 class="mt-0">Headphone</h6>
                    <p>
                        Name: {{$headphone->item->title}}<br>
                        Frequency: {{$headphone->frequency_response}}<br>
                        Driver Size: {{$headphone->driver_size}}<br>
                        Weight: {{$headphone->weight}}<br>
                        Price: ₱ {{$headphone->item->price}}<br>
                    </p>
                  </div>
                </div> 
            </div>
        @endif


        @if($printer != null)
            <div class="col-md-3">
                <div class="media">
                  <img src="{{$printer->item->image != null || $printer->item->image != ""? asset('src/images/products/'.$printer->item->image): url('/noImg.png')}}"  onerror="this.src='{{url('/noImg.png')}}'" class="mr-3" alt="..." style="height: 50px; width: 50px; object-fit: cover; background: white;">
                  <div class="media-body">
                    <h6 class="mt-0">Printer</h6>
                    <p>
                        Name: {{$printer->item->title}}<br>
                        Type: {{$printer->printer_type}}<br>
                        Ink: {{$printer->ink_type}}<br>
                        All in One: {{$printer->all_inOne}}<br>
                        Price: ₱ {{$printer->item->price}}<br>
                    </p>
                  </div>
                </div> 
            </div>
        @endif

        @if($operatingsystem != null)
              <div class="col-md-3">
                <div class="media">
                  <img src="{{$operatingsystem->item->image != null || $operatingsystem->item->image != ""? asset('src/images/products/'.$operatingsystem->item->image): url('/noImg.png')}}"  onerror="this.src='{{url('/noImg.png')}}'" class="mr-3" alt="..." style="height: 50px; width: 50px; object-fit: cover; background: white; ">
                  <div class="media-body">
                    <h6 class="mt-0">Operating System</h6>
                    <p>
                        Name: {{$operatingsystem->item->title}}<br>
                        Memory Need: {{$operatingsystem->memory_requirement}} GB <br>
                        Space Need: {{$operatingsystem->space_requirement}} GB<br>
                        Processor Speed: {{$operatingsystem->processor_speed}} GHz<br>
                        Price: ₱ {{$operatingsystem->item->price}}<br>
                    </p>
                  </div>
                </div> 
            </div>
        @endif

        </div>

    </div>
    <div class="col-md miniGlass" style=" border-radius: 0px; height: unset; padding-bottom: 20px; ">
    
            <div class="row">
                 <div class="col-md-"4 style="margin: 11px;">
                  <h5>Build Summary</h5>
                 </div>
            </div>
            <div class="row">
                 <div class="col-md">
                 
                    <h6>Description: {{$build_category}}</h6>
                         <p style="text-indent: 50px; font-size: 12px">{{$processor_speed_summary}}</p>
                 </div>
            </div>

            @if($notes != null)
            <div class="row">
                 <div class="col-md">
                 
                    <h6>Warning:</h6>
                        @foreach($notes as $note)
                             <label style="text-indent: 50px; font-size: 13px">- {{$note}}</label><br>
                        @endforeach
                        
                 </div>
            </div>
            @endif

            @php
            $task_size = 5;
            if($videocard == null){
                $task_size = 7;
            }
            @endphp
              <div class="row">
                 <div class="col-md-{{$task_size}}">
                 
                    <h6>Task Can Do:</h6>
                         <p style="text-indent: 50px; font-size: 12px">{{$processor_core_summary}} This benchmark execution is estimated in focuses in 0-100 range, higher is better.</p>
                 </div>

                    
                <div class="col-md-3">
                    <div class="progress-circle-container">
                    <div class="progress-circle progress-{{$processor->processor_score}}"><span>{{$processor->processor_score}} <label style="font-size:8px; color: black;">CPU</label></span></div> 
                    </div>
                </div>
                @if($videocard != null)
                <div class="col-md-3">
                    <div class="progress-circle-container">
                    <div class="progress-circle progress-{{$videocard->gpu_score}}"><span>{{$videocard->gpu_score}} <label style="font-size:8px; color: black;">GPU</label></span></div> 
                    </div>
                </div>
                @endif
            </div>
{{-- {{dd(Session::get('builder_cart_info'))}} --}}
            <div class="row">
               <div class="col-md-6"><b>Recomended PSU : <br><label style="font-size: 20px;">{{round(Session::get('builder_cart_info')['powerconsumption'])}} Watts <i class="fas fa-bolt"></i></label></b></div>

                <div class="col-md-5"><b>Total Price :<br><label class="animate__animated  animate__flipInX" style="font-size:20px"> ₱ {{ number_format( Session::get('builder_cart_info')['total_price'],2,'.',",")}}</label></b></div>
            </div>

            <div class="row">
                <div class="col-md-2">
                     <button class="custombtn button11">
                        <a style="color: white; text-decoration: none;" href="{{URL::to('user/pc/back/'. $prevCategory)}}">

                           
                    @if($noEdit == false)
                        Edit
                    @else
                        Back
                    @endif
                    </a>
                     </button>
                </div>
                <div class="col-md-5">
                     <button class="custombtn button11">
                        <a style="color: white; text-decoration: none;" href="{{route('pc.getSave')}}">Save Only</a>
                     </button>
                </div>
                @if(auth()->user()->is_admin == 0)
                 <div class="col-md-4">
                     <button class="custombtn button11">
                        <a style="color: white; text-decoration: none;" href="{{route('pc.addToCart')}}">Add To Cart</a>
                     </button>
                </div>
                @endif
            </div>

          
</div>


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