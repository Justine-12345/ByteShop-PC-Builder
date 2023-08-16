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
                        <h3 class="text-dark mb-0">Add Mouses</h3>
                    </div>
                    <div style="background: rgb(230,247,236);padding: 11px;">
                        <h1 style="font-size: 23px;">Basic Info</h1>
            {{-- START --}}
                        <form method="post" action="{{ route('mouse.store') }}" enctype="multipart/form-data">
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

                            
                            <div class="col"><label style="color: rgb(0,0,0);">Sensor:</label>
                             <div class="form-group">
                                    @if(old('sensor') == 'Optical')
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="sensor" id="inlineRadio1" value="Optical" checked="">
                                            <label class="form-check-label" for="inlineRadio1">Optical</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="sensor" id="inlineRadio1" value="Laser">
                                            <label class="form-check-label" for="inlineRadio1">Laser</label>
                                        </div>
                                    @elseif(old('sensor') == 'Laser')
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="sensor" id="inlineRadio1" value="Optical">
                                            <label class="form-check-label" for="inlineRadio1">Optical</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="sensor" id="inlineRadio1" value="Laser" checked="">
                                            <label class="form-check-label" for="inlineRadio1">Laser</label>
                                        </div>
                                    @else
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="sensor" id="inlineRadio1" value="Optical">
                                            <label class="form-check-label" for="inlineRadio1">Optical</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="sensor" id="inlineRadio1" value="Laser">
                                            <label class="form-check-label" for="inlineRadio1">Laser</label>
                                        </div>
                                    @endif

                                    <br>

                                    @if($errors->has('sensor'))
                                        <small><i style="color: red;">*{{ $errors->first('sensor') }}</i></small>
                                    @endif
                                </div>
                                </div>
                  

                            <div class="col"><label style="color: rgb(0,0,0);">DPI:</label>
                                <div class="form-group">
                                    <input class="form-control" type="text" name="dpi" value="{{old('dpi')}}">

                                    @if($errors->has('dpi'))
                                        <small><i style="color: red;">*{{ $errors->first('dpi') }}</i></small>
                                    @endif
                                </div>
                            </div>

                            <div class="col"><label style="color: rgb(0,0,0);">Poll Rate:</label>
                                <div class="form-group">
                                    {{-- <input class="form-control" type="text" name="poll_rate" value="{{old('poll_rate')}}"> --}}

                                     <select name="poll_rate" class="form-control" >
                                    <option value="">Select Poll Rate</option>
                                    <option value="8000Hz">8000Hz</option>
                                    <option value="4000Hz">4000Hz</option>
                                    <option value="1000Hz">1000Hz</option>
                                      <option value="500Hz">500Hz</option>
                                      <option value="250Hz">250Hz</option>
                                      <option value="125hz">125Hz</option>
                                       </select>

                                    @if($errors->has('poll_rate'))
                                        <small><i style="color: red;">*{{ $errors->first('poll_rate') }}</i></small>
                                    @endif
                                </div>
                            </div>


                            <div class="col"><label style="color: rgb(0,0,0);">Tracking Speed:</label>
                                <div class="form-group">
                                

                                     <select name="tracking_speed" class="form-control" >
                                    <option value="">Select Tracking Speed</option>
                                  
                                    <option value="150 IPS">150 IPS</option>
                                      <option value="250 IPS">250 IPS</option>
                                      <option value="450 IPS">450 IPS</option>
                                      <option value="650 IPS">650 IPS</option>
                                       </select>

                                    @if($errors->has('tracking_speed'))
                                        <small><i style="color: red;">*{{ $errors->first('tracking_speed') }}</i></small>
                                    @endif
                                </div>
                            </div>


                                         <div class="col"><label style="color: rgb(0,0,0);">Build Type:</label>
                                <div class="form-group">
                                

                                     <select name="build_type" class="form-control" >
                                    <option value="">Select Build Type</option>
                                  
                                    <option value="Grip">Grip</option>
                                      <option value="Claw">Claw</option>
                                      <option value="Fingertips">Fingertips</option>
                               
                                       </select>

                                    @if($errors->has('build_type'))
                                        <small><i style="color: red;">*{{ $errors->first('build_type') }}</i></small>
                                    @endif
                                </div>
                            </div>

                         
                            <div class="col"><label style="color: rgb(0,0,0);">Wired:</label>
                                <div class="form-group">
                                    @if(old('mouse_wired') == 'Yes')
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="mouse_wired" id="inlineRadio1" value="Yes" checked="">
                                            <label class="form-check-label" for="inlineRadio1">Yes</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="mouse_wired" id="inlineRadio1" value="No">
                                            <label class="form-check-label" for="inlineRadio1">No</label>
                                        </div>
                                    @elseif(old('mouse_wired') == 'No')
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="mouse_wired" id="inlineRadio1" value="Yes">
                                            <label class="form-check-label" for="inlineRadio1">Yes</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="mouse_wired" id="inlineRadio1" value="No" checked="">
                                            <label class="form-check-label" for="inlineRadio1">No</label>
                                        </div>
                                    @else
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="mouse_wired" id="inlineRadio1" value="Yes">
                                            <label class="form-check-label" for="inlineRadio1">Yes</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="mouse_wired" id="inlineRadio1" value="No">
                                            <label class="form-check-label" for="inlineRadio1">No</label>
                                        </div>
                                    @endif

                                    <br>

                                    @if($errors->has('mouse_wired'))
                                        <small><i style="color: red;">*{{ $errors->first('mouse_wired') }}</i></small>
                                    @endif
                                </div>
                            </div>

                            <div class="col"><label style="color: rgb(0,0,0);">Programmable Buttons:</label>
                                <div class="form-group">
                                    @if(old('programmable_button') == 'Yes')
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="programmable_button" id="inlineRadio1" value="Yes" checked="">
                                            <label class="form-check-label" for="inlineRadio1">Yes</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="programmable_button" id="inlineRadio1" value="No">
                                            <label class="form-check-label" for="inlineRadio1">No</label>
                                        </div>
                                    @elseif(old('programmable_button') == 'No')
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="programmable_button" id="inlineRadio1" value="Yes">
                                            <label class="form-check-label" for="inlineRadio1">Yes</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="programmable_button" id="inlineRadio1" value="No" checked="">
                                            <label class="form-check-label" for="inlineRadio1">No</label>
                                        </div>
                                    @else
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="programmable_button" id="inlineRadio1" value="Yes">
                                            <label class="form-check-label" for="inlineRadio1">Yes</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="programmable_button" id="inlineRadio1" value="No">
                                            <label class="form-check-label" for="inlineRadio1">No</label>
                                        </div>
                                    @endif

                                    <br>

                                    @if($errors->has('programmable_button'))
                                        <small><i style="color: red;">*{{ $errors->first('programmable_button') }}</i></small>
                                    @endif
                                </div>
                            </div>

                               <div class="col"><label style="color: rgb(0,0,0);">Weight:</label>
                                <div class="form-group"><input class="form-control" type="text" name="weight_customization" value="{{old('weight_customization')}}"></div>
                            </div>


                        <div class="col"><label style="color: rgb(0,0,0);">Lift Off Distance:</label>
                                <div class="form-group">
                                    @if(old('liftoff_distance') == 'High')
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="liftoff_distance" id="inlineRadio1" value="High" checked="">
                                            <label class="form-check-label" for="inlineRadio1">High</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="liftoff_distance" id="inlineRadio1" value="Low">
                                            <label class="form-check-label" for="inlineRadio1">Low</label>
                                        </div>
                                    @elseif(old('liftoff_distance') == 'Low')
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="liftoff_distance" id="inlineRadio1" value="High">
                                            <label class="form-check-label" for="inlineRadio1">High</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="liftoff_distance" id="inlineRadio1" value="Low" checked="">
                                            <label class="form-check-label" for="inlineRadio1">Low</label>
                                        </div>
                                    @else
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="liftoff_distance" id="inlineRadio1" value="High">
                                            <label class="form-check-label" for="inlineRadio1">High</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="liftoff_distance" id="inlineRadio1" value="Low">
                                            <label class="form-check-label" for="inlineRadio1">Low</label>
                                        </div>
                                    @endif

                                    <br>

                                    @if($errors->has('liftoff_distance'))
                                        <small><i style="color: red;">*{{ $errors->first('liftoff_distance') }}</i></small>
                                    @endif
                                </div>
                            </div>


                         <div class="col"><label style="color: rgb(0,0,0);">Angle Snapping:</label>
                                <div class="form-group">
                                    @if(old('angle_snapping') == 'Yes')
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="angle_snapping" id="inlineRadio1" value="Yes" checked="">
                                            <label class="form-check-label" for="inlineRadio1">Yes</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="angle_snapping" id="inlineRadio1" value="No">
                                            <label class="form-check-label" for="inlineRadio1">No</label>
                                        </div>
                                    @elseif(old('angle_snapping') == 'No')
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="angle_snapping" id="inlineRadio1" value="Yes">
                                            <label class="form-check-label" for="inlineRadio1">Yes</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="angle_snapping" id="inlineRadio1" value="No" checked="">
                                            <label class="form-check-label" for="inlineRadio1">No</label>
                                        </div>
                                    @else
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="angle_snapping" id="inlineRadio1" value="Yes">
                                            <label class="form-check-label" for="inlineRadio1">Yes</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="angle_snapping" id="inlineRadio1" value="No">
                                            <label class="form-check-label" for="inlineRadio1">No</label>
                                        </div>
                                    @endif

                                    <br>

                                    @if($errors->has('angle_snapping'))
                                        <small><i style="color: red;">*{{ $errors->first('angle_snapping') }}</i></small>
                                    @endif
                                </div>
                            </div>

                    

                            <div class="col"><label style="color: rgb(0,0,0);">Description:</label>
                                <div class="form-group"><input class="form-control" type="text" name="mouse_description" value="{{old('mouse_description')}}"></div>
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
        </div><a class="border rounded d-inline scroll-to-top" href="{{ route('mouse.index') }}"><i class="fas fa-arrow-left"></i></a>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/Custom-File-Upload.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/theme.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>

</html>