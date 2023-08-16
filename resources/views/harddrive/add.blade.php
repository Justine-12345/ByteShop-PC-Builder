<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard - Hard Drive</title>
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
                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-dark mb-0">Add Hard Drive</h3>
                    </div>
                    <div style="background: rgb(230,247,236);padding: 11px;">
                        <h1 style="font-size: 23px;">Basic Info</h1>
            {{-- START --}}
                        <form method="post" action="{{ route('harddrive.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <div class="col"><label style="color: rgb(0,0,0);">Brand:</label>
                                    <div class="form-group">
                                        <select class="form-control" name="brand_id">
                                            <optgroup label="Brand Names">
                                                <option value="">Select Brand</option>

                                                @foreach($brands as $brand)
                                                    @if(old('brand_id') == $brand->brand_id)
                                                        <option value="{{ $brand->brand_id }}" selected="">{{ $brand->brand_name }}</option>
                                                    @else
                                                        <option value="{{ $brand->brand_id }}">{{ $brand->brand_name }}</option>
                                                    @endif
                                                @endforeach
                                            </optgroup>
                                        </select>

                                        @if($errors->has('brand_id'))
                                            <small><i style="color: red;">*{{ $errors->first('brand_id') }}</i></small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col"><label style="color: rgb(0,0,0);">Title:</label>
                                    <div class="form-group">
                                        <input class="form-control" type="text" name="title" value="{{old('title')}}">

                                        @if($errors->has('title'))
                                            <small><i style="color: red;">*{{ $errors->first('title') }}</i></small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col"><label style="color: rgb(0,0,0);">Stock:&nbsp;</label>
                                    <div class="form-group">
                                        <input class="form-control" type="number" min="1" max="1000000" step="1" placeholder="No. of Stocks" name="quantity" value="{{old('quantity')}}">

                                        @if($errors->has('quantity'))
                                            <small><i style="color: red;">*{{ $errors->first('quantity') }}</i></small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col"><label style="color: rgb(0,0,0);">Price:</label>
                                    <div class="form-group">
                                        <input class="form-control" type="number" name="price" value="{{old('price')}}">

                                        @if($errors->has('price'))
                                            <small><i style="color: red;">*{{ $errors->first('price') }}</i></small>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                   <div class="col"><label style="color: rgb(0,0,0);">Upload Image:</label>
                                    <div class="form-group"><input class="form-control-file" type="file" accept="image/*" name="image[]" required=""></div>
                                </div>
                            </div>

                            <div style="margin-bottom: 6px;">
                                <h1 style="font-size: 23px;">Other Info</h1>
                            </div>

        {{--  ADD ADDITIONAL INPUTS HERE --}}

                          
                            <div class="col"><label style="color: rgb(0,0,0);">Storage Type:</label>
                                <div class="form-group">
                                    {{-- <input class="form-control" type="text" name="poll_rate" value="{{old('poll_rate')}}"> --}}

                                     <select name="storage_type" class="form-control" >
                                    <option value="">Select Storage Type</option>
                                    <option value="Intrenal Hard Drive">Intrenal Hard Drive</option>
                                    <option value="External Hard Drive">External Hard Drive</option>
                                    
                                       </select>

                                    @if($errors->has('storage_type'))
                                        <small><i style="color: red;">*{{ $errors->first('storage_type') }}</i></small>
                                    @endif
                                </div>
                            </div>
                    
                             <div class="col"><label style="color: rgb(0,0,0);">Capacity:</label>
                                <div class="form-group">
                                    {{-- <input class="form-control" type="text" name="poll_rate" value="{{old('poll_rate')}}"> --}}

                                     <select name="capacity" class="form-control" >
                                    <option value="">Select capacity</option>
                                    <option value="16"> 16 GB </option>
                                    <option value="32">32 GB </option>
                                    <option value="64"> 64 GB </option>
                                    <option value="128">128 GB </option>
                                    <option value="256"> 256 GB </option>
                                    <option value="500">500 GB </option>
                                    <option value="1000"> 1TB </option>
                                    <option value="1500 ">1.5TB </option>
                                     <option value="2000">2TB </option>
                                    <option value="4000">4TB </option>
                                    <option value="6000"> 6TB </option>
                                    <option value="8000">8TB </option>
                                    <option value="12000">12TB </option>
                                       </select>

                                    @if($errors->has('capacity'))
                                        <small><i style="color: red;">*{{ $errors->first('capacity') }}</i></small>
                                    @endif
                                </div>
                            </div>
              
                    
                            <div class="col"><label style="color: rgb(0,0,0);">Rotational speed:</label>
                                <div class="form-group">
                                    @if(old('rotational_speed') == '4200 RPM')
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rotational_speed" id="inlineRadio1" value="4200 RPM" checked="">
                                            <label class="form-check-label" for="inlineRadio1" >4200 RPM</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rotational_speed" id="inlineRadio1" value="5200 RPM">
                                            <label class="form-check-label" for="inlineRadio1">5200 RPM</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rotational_speed" id="inlineRadio1" value="5400 RPM">
                                            <label class="form-check-label" for="inlineRadio1">5400 RPM</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rotational_speed" id="inlineRadio1" value="7200 RPM">
                                            <label class="form-check-label" for="inlineRadio1">7200 RPM</label>
                                        </div>

                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rotational_speed" id="inlineRadio1" value="10000 RPM">
                                            <label class="form-check-label" for="inlineRadio1">10000 RPM</label>
                                        </div>

                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rotational_speed" id="inlineRadio1" value="15000 RPM">
                                            <label class="form-check-label" for="inlineRadio1">15000 RPM</label>
                                        </div>


                                    @elseif(old('rotational_speed') == '5200 RPM')
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rotational_speed" id="inlineRadio1" value="4200 RPM">
                                            <label class="form-check-label" for="inlineRadio1">4200 RPM</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rotational_speed" id="inlineRadio1" value="5200 RPM" checked="">
                                            <label class="form-check-label" for="inlineRadio1">5200 RPM</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rotational_speed" id="inlineRadio1" value="5400 RPM">
                                            <label class="form-check-label" for="inlineRadio1">5400 RPM</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rotational_speed" id="inlineRadio1" value="7200 RPM">
                                            <label class="form-check-label" for="inlineRadio1">7200 RPM</label>
                                        </div>

                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rotational_speed" id="inlineRadio1" value="10000 RPM">
                                            <label class="form-check-label" for="inlineRadio1">10000 RPM</label>
                                        </div>

                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rotational_speed" id="inlineRadio1" value="15000 RPM">
                                            <label class="form-check-label" for="inlineRadio1">15000 RPM</label>
                                        </div>

                                    @elseif(old('rotational_speed') == '5400 RPM')
                                         <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rotational_speed" id="inlineRadio1" value="4200 RPM">
                                            <label class="form-check-label" for="inlineRadio1">4200 RPM</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rotational_speed" id="inlineRadio1" value="5200 RPM">
                                            <label class="form-check-label" for="inlineRadio1">5200 RPM</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rotational_speed" id="inlineRadio1" value="5400 RPM" checked="">
                                            <label class="form-check-label" for="inlineRadio1">5400 RPM</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rotational_speed" id="inlineRadio1" value="7200 RPM">
                                            <label class="form-check-label" for="inlineRadio1">7200 RPM</label>
                                        </div>

                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rotational_speed" id="inlineRadio1" value="10000 RPM">
                                            <label class="form-check-label" for="inlineRadio1">10000 RPM</label>
                                        </div>

                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rotational_speed" id="inlineRadio1" value="15000 RPM">
                                            <label class="form-check-label" for="inlineRadio1">15000 RPM</label>
                                        </div>

                                    @elseif(old('rotational_speed') == '7200 RPM')
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rotational_speed" id="inlineRadio1" value="4200 RPM">
                                            <label class="form-check-label" for="inlineRadio1">4200 RPM</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rotational_speed" id="inlineRadio1" value="5200 RPM">
                                            <label class="form-check-label" for="inlineRadio1">5200 RPM</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rotational_speed" id="inlineRadio1" value="5400 RPM">
                                            <label class="form-check-label" for="inlineRadio1">5400 RPM</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rotational_speed" id="inlineRadio1" value="7200 RPM" checked="">
                                            <label class="form-check-label" for="inlineRadio1">7200 RPM</label>
                                        </div>

                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rotational_speed" id="inlineRadio1" value="10000 RPM">
                                            <label class="form-check-label" for="inlineRadio1">10000 RPM</label>
                                        </div>

                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rotational_speed" id="inlineRadio1" value="15000 RPM">
                                            <label class="form-check-label" for="inlineRadio1">15000 RPM</label>
                                        </div>
                                    @elseif(old('rotational_speed') == '10000 RPM')
                                         <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rotational_speed" id="inlineRadio1" value="4200 RPM">
                                            <label class="form-check-label" for="inlineRadio1">4200 RPM</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rotational_speed" id="inlineRadio1" value="5200 RPM">
                                            <label class="form-check-label" for="inlineRadio1">5200 RPM</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rotational_speed" id="inlineRadio1" value="5400 RPM">
                                            <label class="form-check-label" for="inlineRadio1">5400 RPM</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rotational_speed" id="inlineRadio1" value="7200 RPM">
                                            <label class="form-check-label" for="inlineRadio1">7200 RPM</label>
                                        </div>

                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rotational_speed" id="inlineRadio1" value="10000 RPM" checked="">
                                            <label class="form-check-label" for="inlineRadio1">10000 RPM</label>
                                        </div>

                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rotational_speed" id="inlineRadio1" value="15000 RPM">
                                            <label class="form-check-label" for="inlineRadio1">15000 RPM</label>
                                        </div>
                                     @elseif(old('rotational_speed') == '15000 RPM')
                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rotational_speed" id="inlineRadio1" value="4200 RPM">
                                            <label class="form-check-label" for="inlineRadio1">4200 RPM</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rotational_speed" id="inlineRadio1" value="5200 RPM">
                                            <label class="form-check-label" for="inlineRadio1">5200 RPM</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rotational_speed" id="inlineRadio1" value="5400 RPM">
                                            <label class="form-check-label" for="inlineRadio1">5400 RPM</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rotational_speed" id="inlineRadio1" value="7200 RPM">
                                            <label class="form-check-label" for="inlineRadio1">7200 RPM</label>
                                        </div>

                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rotational_speed" id="inlineRadio1" value="10000 RPM">
                                            <label class="form-check-label" for="inlineRadio1">10000 RPM</label>
                                        </div>

                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rotational_speed" id="inlineRadio1" value="15000 RPM" checked="">
                                            <label class="form-check-label" for="inlineRadio1">15000 RPM</label>
                                        </div>
                                    @else
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rotational_speed" id="inlineRadio1" value="4200 RPM">
                                            <label class="form-check-label" for="inlineRadio1">4200 RPM</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rotational_speed" id="inlineRadio1" value="5200 RPM">
                                            <label class="form-check-label" for="inlineRadio1">5200 RPM</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rotational_speed" id="inlineRadio1" value="5400 RPM">
                                            <label class="form-check-label" for="inlineRadio1">5400 RPM</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rotational_speed" id="inlineRadio1" value="7200 RPM">
                                            <label class="form-check-label" for="inlineRadio1">7200 RPM</label>
                                        </div>

                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rotational_speed" id="inlineRadio1" value="10000 RPM">
                                            <label class="form-check-label" for="inlineRadio1">10000 RPM</label>
                                        </div>

                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rotational_speed" id="inlineRadio1" value="15000 RPM">
                                            <label class="form-check-label" for="inlineRadio1">15000 RPM</label>
                                        </div>
                                    @endif

                                    <br>

                                    @if($errors->has('rotational_speed'))
                                        <small><i style="color: red;">*{{ $errors->first('rotational_speed') }}</i></small>
                                    @endif
                                </div>
                            </div>

                            <div class="col"><label style="color: rgb(0,0,0);">Connectivity Type:</label>
                                <div class="form-group">
                                    {{-- <input class="form-control" type="text" name="poll_rate" value="{{old('poll_rate')}}"> --}}

                                    <select name="connectivity_type" class="form-control" >
                                    <option value="">Select Connectivity Type</option>
                                    <option value="IDE/PATA Cable">IDE/PATA Cable</option>
                                    <option value="SATA Cable">SATA Cable</option>
                                    <option value="SCSI Cable">SCSI Cable</option>
                                       </select>

                                    @if($errors->has('connectivity_type'))
                                        <small><i style="color: red;">*{{ $errors->first('connectivity_type') }}</i></small>
                                    @endif
                                </div>
                            </div>
                        
                        <div class="col"><label style="color: rgb(0,0,0);">Transfer rate(MBps):</label>
                                <div class="form-group"><input class="form-control" type="number" placeholder="0 MBps" min="1" name="transfer_rate" value="{{old('transfer_rate')}}"></div>
                            </div>
                        
                        <div class="col"><label style="color: rgb(0,0,0);">Cache Size:</label>
                                <div class="form-group">
                                    {{-- <input class="form-control" type="text" name="poll_rate" value="{{old('poll_rate')}}"> --}}

                                    <select name="cache_size" class="form-control" >
                                    <option value="">Select Cache size</option>
                                    <option value="8 MB">8 MB</option>
                                    <option value="16 MB">16 MB</option>
                                    <option value="32 MB">32 MB</option>
                                    <option value="64 MB">64 MB</option>
                                    <option value="128 MB">128 MB</option>
                                    <option value="256 MB">256 MB</option>
                                       </select>

                                    @if($errors->has('cache_size'))
                                        <small><i style="color: red;">*{{ $errors->first('cache_size') }}</i></small>
                                    @endif
                                </div>
                            </div>

                            <div class="col"><label style="color: rgb(0,0,0);">Power:</label>
                                <div class="form-group">
                                    @if(old('power') == '5 Volts')
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="power" id="inlineRadio1" value="5 Volts" checked="">
                                            <label class="form-check-label" for="inlineRadio1">5 Volts</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="power" id="inlineRadio1" value="12 Volts">
                                            <label class="form-check-label" for="inlineRadio1">12 Volts</label>
                                        </div>
                                    @elseif(old('power') == '12 Volts')
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="power" id="inlineRadio1" value="5 Volts">
                                            <label class="form-check-label" for="inlineRadio1">5 Volts</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="power" id="inlineRadio1" value="12 Volts" checked="">
                                            <label class="form-check-label" for="inlineRadio1">12 Volts</label>
                                        </div>
                                    @else
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="power" id="inlineRadio1" value="5 Volts">
                                            <label class="form-check-label" for="inlineRadio1">5 Volts</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="power" id="inlineRadio1" value="12 Volts">
                                            <label class="form-check-label" for="inlineRadio1">12 Volts</label>
                                        </div>
                                    @endif

                                    <br>

                                    @if($errors->has('power'))
                                        <small><i style="color: red;">*{{ $errors->first('power') }}</i></small>
                                    @endif
                                </div>
                            </div>

                            <div class="col"><label style="color: rgb(0,0,0);">Height:</label>
                                <div class="form-group">
                                    {{-- <input class="form-control" type="text" name="poll_rate" value="{{old('poll_rate')}}"> --}}

                                    <select name="height" class="form-control" >
                                    <option value="">Select height</option>
                                    <option value="1.8 inches">1.8 inches</option>
                                    <option value="2.5 inches">2.5 inches</option>
                                    <option value="3.5 inches">3.5 inches</option>
                                    
                                       </select>

                                    @if($errors->has('height'))
                                        <small><i style="color: red;">*{{ $errors->first('height') }}</i></small>
                                    @endif
                                </div>
                            </div>

                            <div class="col"><label style="color: rgb(0,0,0);">Depth:</label>
                                <div class="form-group"><input class="form-control" type="text" placeholder="inch/mm"name="depth" value="{{old('depth')}}"></div>
                            </div>

                            <div class="col"><label style="color: rgb(0,0,0);">Width:</label>
                                <div class="form-group">
                                    {{-- <input class="form-control" type="text" name="poll_rate" value="{{old('poll_rate')}}"> --}}

                                    <select name="width" class="form-control" >
                                    <option value="">Select width</option>
                                    <option value="H- 1.8 inches,  W-54 mm  ">H- 1.8 inches,W-54 mm </option>
                                    <option value="H-2.5 inches, W-69.85 mm">H-2.5 inches,  W-69.85 mm</option>
                                    <option value="H-3.5 inches, W-101.85 mm">H-3.5 inches,  W-101.85 mm</option>
                                    
                                       </select>

                                    @if($errors->has('width'))
                                        <small><i style="color: red;">*{{ $errors->first('width') }}</i></small>
                                    @endif
                                </div>
                            </div>

                            <div class="col"><label style="color: rgb(0,0,0);">Weight:</label>
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder=""name="weight" value="{{old('weight')}}"></div>
                            </div>

                            <div class="col"><label style="color: rgb(0,0,0);">Description:</label>
                                <div class="form-group"><input class="form-control" type="text" placeholder="Type here..."name="harddrive_description" value="{{old('harddrive_description')}}"></div>
                            </div>

                            <div class="form-group" style="margin-top: 0px;padding: 0px;padding-top: 82px;text-align: center;"><button type="submit" class="btn btn-primary text-center" type="button" style="text-align: right;background: rgb(0,103,76);">SUBMIT</button></div>
                        </form>
                      {{-- END --}}
                    </div>
                </div>
            </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © Brand 2021</span></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="{{ route('harddrive.index') }}"><i class="fas fa-arrow-left"></i></a>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/Custom-File-Upload.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/theme.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>

</html>