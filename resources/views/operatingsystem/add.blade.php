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
                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-dark mb-0">Add Operating System</h3>
                    </div>
                    <div style="background: rgb(230,247,236);padding: 11px;">
                        <h1 style="font-size: 23px;">Basic Info</h1>
            {{-- START --}}
                        <form method="post" action="{{ route('operatingsystem.store') }}" enctype="multipart/form-data">
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

                          <div class="col"><label style="color: rgb(0,0,0);">Recomended Processor Speed (GHz):</label>
                                <div class="form-group"><input class="form-control" type="number" name="processor_speed" min=".1" max="8" step=".1" placeholder="0.0"value="{{old('processor_speed')}}"></div>
                            </div>
                  
              
                            
                            <div class="col"><label style="color: rgb(0,0,0);">Memory Requirement:</label>
                                <div class="form-group">
                                    {{-- <input class="form-control" type="text" name="poll_rate" value="{{old('poll_rate')}}"> --}}

                                     <select name="memory_requirement" class="form-control" >
                                    <option value="">Select Memory Requirement</option>
                                    <option value=".125"> 128 MB </option>
                                    <option value=".25"> 256 MB </option>
                                    <option value=".5"> 520 MB </option>
                                    <option value="1"> 1 GB </option>
                                    <option value="2"> 2 GB </option>
                                    <option value="4"> 4 GB </option>
                                    <option value="8"> 8 GB </option>
                                    <option value="16"> 16 GB </option>
                                    <option value="32">32 GB </option>
                                    <option value="64"> 64 GB </option>
                                    <option value="128">128 GB </option>
                                    <option value="256"> 256 GB </option>
                                    <option value="500">500 GB </option>
                                    <option value="1000"> 1TB </option> 
                                       </select>
                                    @if($errors->has('memory_requirement'))
                                        <small><i style="color: red;">*{{ $errors->first('memory_requirement') }}</i></small>
                                    @endif
                                </div>
                            </div>
                    
                             <div class="col"><label style="color: rgb(0,0,0);">Space Requirement:</label>
                                <div class="form-group">
                                    {{-- <input class="form-control" type="text" name="poll_rate" value="{{old('poll_rate')}}"> --}}

                                     <select name="space_requirement" class="form-control" >
                                    <option value="">Select Space Requirement</option>
                                    <option value=".125"> 128 MB </option>
                                    <option value=".25"> 256 MB </option>
                                    <option value=".5"> 520 MB </option>
                                    <option value="1"> 1 GB </option>
                                    <option value="2"> 2 GB </option>
                                    <option value="4"> 4 GB </option>
                                    <option value="8"> 8 GB </option>
                                    <option value="16"> 16 GB </option>
                                    <option value="32">32 GB </option>
                                    <option value="64"> 64 GB </option>
                                    <option value="128">128 GB </option>
                                    <option value="256"> 256 GB </option>
                                    <option value="500">500 GB </option>
                                    <option value="1000"> 1TB </option>
                                       </select>

                                    @if($errors->has('space_requirement'))
                                        <small><i style="color: red;">*{{ $errors->first('space_requirement') }}</i></small>
                                    @endif
                                </div>
                            </div>
              
                    


                            <div class="col"><label style="color: rgb(0,0,0);">Graphic card Requirement:</label>
                                <div class="form-group">
                                    @if(old('graphiccard_requirement') == 'Microsoft DirectX 9')
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="graphiccard_requirement" id="inlineRadio1" value="Microsoft DirectX 9" checked="">
                                            <label class="form-check-label" for="inlineRadio1">Microsoft DirectX 9</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="graphiccard_requirement" id="inlineRadio1" value="Greater graphics device with WDDM Driver">
                                            <label class="form-check-label" for="inlineRadio1">Greater graphics device with WDDM Driver</label>
                                        </div>
                                    @elseif(old('graphiccard_requirement') == 'Greater graphics device with WDDM Driver')
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="graphiccard_requirement" id="inlineRadio1" value="Microsoft DirectX 9">
                                            <label class="form-check-label" for="inlineRadio1">Microsoft DirectX 9</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="graphiccard_requirement" id="inlineRadio1" value="Greater graphics device with WDDM Driver" checked="">
                                            <label class="form-check-label" for="inlineRadio1">Greater graphics device with WDDM Driver</label>
                                        </div>
                                    @else
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="graphiccard_requirement" id="inlineRadio1" value="Microsoft DirectX 9">
                                            <label class="form-check-label" for="inlineRadio1">Microsoft DirectX 9</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="graphiccard_requirement" id="inlineRadio1" value="Greater graphics device with WDDM Driver">
                                            <label class="form-check-label" for="inlineRadio1">Greater graphics device with WDDM Driver</label>
                                        </div>
                                    @endif

                                    <br>

                                    @if($errors->has('graphiccard_requirement'))
                                        <small><i style="color: red;">*{{ $errors->first('graphiccard_requirement') }}</i></small>
                                    @endif
                                </div>
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
        </div><a class="border rounded d-inline scroll-to-top" href="{{ route('operatingsystem.index') }}"><i class="fas fa-arrow-left"></i></a>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/Custom-File-Upload.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/theme.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>

</html>