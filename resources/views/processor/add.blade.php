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
                        <h3 class="text-dark mb-0">Add Processors</h3>
                    </div>
                    <div style="background: rgb(230,247,236);padding: 11px;">
                        <h1 style="font-size: 23px;">Basic Info</h1>
                        <form action="{{route('processor.store')}}" method="post" enctype="multipart/form-data">
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
                                        <input class="form-control" type="number" name="price" value="{{old('price')}}" step="1" min="1" max="1000000">

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
                    {{-- OTHER INFO --}}
                            <div style="margin-bottom: 6px;">
                                <h1 style="font-size: 23px;">Other Info</h1>
                            </div>

                            <div class="col"><label style="color: rgb(0,0,0);">Base Speed (GHz)</label>
                               <div class="form-group"><input class="form-control" type="number" name="base_speed" min=".1" max="8" step=".1" placeholder="0.0"value="{{old('base_speed')}}"></div>
                               @if($errors->has('base_speed'))
                                            <small><i style="color: red;">*{{ $errors->first('base_speed') }}</i></small>
                                        @endif
                            </div>




                            <div class="col"><label style="color: rgb(0,0,0);">Max Speed (GHz)</label>
                               <div class="form-group"><input class="form-control" type="number" name="max_speed" min=".1" max="8" step=".1" placeholder="0.0"value="{{old('max_speed')}}"></div>
                                  @if($errors->has('max_speed'))
                                            <small><i style="color: red;">*{{ $errors->first('max_speed') }}</i></small>
                                        @endif
                            </div>


                            <div class="col"><label style="color: rgb(0,0,0);">Overclocking (GHz)</label>
                                <div class="form-group"><input class="form-control" type="number" name="overclocking" min=".1" max="8" step=".1" placeholder="0.0"value="{{old('overclocking')}}"></div>
                                 @if($errors->has('overclocking'))
                                            <small><i style="color: red;">*{{ $errors->first('overclocking') }}</i></small>
                                        @endif
                            </div>


                            <div class="col"><label style="color: rgb(0,0,0);">Core Count</label>
                                <div class="form-group"><input class="form-control" type="number" name="core_count" min="1" step="1" placeholder="0"value="{{old('core_count')}}"></div>
                                    @if($errors->has('core_count'))
                                            <small><i style="color: red;">*{{ $errors->first('core_count') }}</i></small>
                                        @endif
                            </div>


                            <div class="col"><label style="color: rgb(0,0,0);">Thread Count</label>
                                <div class="form-group"><input class="form-control" type="number" name="multi_threading" min="1" step="1" placeholder="0" value="{{old('multi_threading')}}"></div>
                                 @if($errors->has('multi_threading'))
                                            <small><i style="color: red;">*{{ $errors->first('multi_threading') }}</i></small>
                                        @endif
                            </div>


                            <div class="col"><label style="color: rgb(0,0,0);">Cache</label>
                                <div class="form-group"><input class="form-control" type="text" name="cache" value="{{old('cache')}}"></div>

                                @if($errors->has('cache'))
                                            <small><i style="color: red;">*{{ $errors->first('cache') }}</i></small>
                                        @endif
                            </div>


                            <div class="col"><label style="color: rgb(0,0,0);">Memory Type</label>
                                 <select name="memory_type" class="form-control" >
                                    @if(old('memory_type'))
                                    <option value="{{old('memory_type')}}" selected>{{old('memory_type')}}</option>
                                    @endif
                                    <option value="">Select Memory Type</option>
                                    <option value="SDRAM"> SDRAM</option>
                                    <option value="DDR1"> DDR1 </option>
                                    <option value="DDR2"> DDR2 </option>
                                    <option value="DDR3"> DDR3 </option>
                                    <option value="DDR4"> DDR4 </option> 
                                </select>
                                   @if($errors->has('memory_type'))
                                            <small><i style="color: red;">*{{ $errors->first('memory_type') }}</i></small>
                                        @endif
                            </div>


                            <div class="col"><label style="color: rgb(0,0,0);">Socket Type</label>
                                <div class="form-group">
                                    <select name="socket_type" class="form-control" >
                                    @if(old('socket_type'))
                                    <option value="{{old('socket_type')}}" selected>{{old('socket_type')}}</option>
                                    @endif  
                                    <option value="">Select CPU Socket</option>
                                    <option value="AMD Ryzen - AM3">AMD Ryzen - AM3</option>
                                    <option value="AMD Ryzen - AM4">AMD Ryzen - AM4</option>
                                    <option value="AMD Ryzen Threadripper - TR4">AMD Ryzen Threadripper - TR4</option>
                                    <option value="Intel - LGA775">Intel - LGA775</option>
                                    <option value="Intel - LGA1150">Intel - LGA1150 </option>
                                    <option value="Intel - LGA1151 v1">Intel - LGA1151 v1</option>
                                    <option value="Intel - LGA1151 v2">Intel - LGA1151 v2</option>
                                    <option value="Intel - LGA1156">Intel - LGA1156</option>
                                    <option value="Intel - LGA1200">Intel - LGA1200</option>
                                    <option value="Intel - LGA2011">Intel - LGA2011</option>
                                    <option value="Intel - LGA2011-3 ">Intel - LGA2011-3</option> 
                                    <option value="Intel - LGA2066">Intel - LGA2066</option>
                                    <option value="Intel - LGA3647">Intel - LGA3647</option> 
                                    <option value="Intel - LGA4189">Intel - LGA4189</option> 
                                       </select>
                                </div>
                                 @if($errors->has('socket_type'))
                                            <small><i style="color: red;">*{{ $errors->first('socket_type') }}</i></small>
                                        @endif
                            </div>


                            <div class="col"><label style="color: rgb(0,0,0);">TDP Rating (Watts)</label>
                               <div class="form-group"><input class="form-control" type="number" name="tdp_rating" min="1" step="1" placeholder="0"value="{{old('tdp_rating')}}"></div>
                                    @if($errors->has('tdp_rating'))
                                            <small><i style="color: red;">*{{ $errors->first('tdp_rating') }}</i></small>
                                        @endif
                            </div>


                            <div class="col"><label style="color: rgb(0,0,0);">Fabcrication (nm)</label>
                                 <div class="form-group"><input class="form-control" type="number" name="fabrication" min="1" step="1" placeholder="0"value="{{old('fabrication')}}"></div>
                                    @if($errors->has('fabrication'))
                                            <small><i style="color: red;">*{{ $errors->first('fabrication') }}</i></small>
                                        @endif
                            </div>


                            <div class="col"><label style="color: rgb(0,0,0);">Integrated Graphics&nbsp;</label>
                               <div class="form-group"><input class="form-control" type="text" name="ingrated_graphics" value="{{old('ingrated_graphics')}}"></div>

                                @if($errors->has('ingrated_graphics'))
                                            <small><i style="color: red;">*{{ $errors->first('ingrated_graphics') }}</i></small>
                                        @endif 
                            </div>



                            <div class="col"><label style="color: rgb(0,0,0);">Processor Wattage (Watts)</label>
                                <div class="form-group"><input class="form-control" type="number" name="processor_wattage" min="1" max="1000" step="1" placeholder="0"value="{{old('processor_wattage')}}"></div>
                                    @if($errors->has('processor_wattage'))
                                            <small><i style="color: red;">*{{ $errors->first('processor_wattage') }}</i></small>
                                        @endif
                            </div>



                            <div class="col"><label style="color: rgb(0,0,0);">Processor Score</label>
                                 <div class="form-group"><input class="form-control" type="number" name="processor_score" min="1" max="100" step="1" placeholder="0"value="{{old('processor_score')}}"></div>
                                    @if($errors->has('processor_score'))
                                            <small><i style="color: red;">*{{ $errors->first('processor_score') }}</i></small>
                                        @endif
                            </div>


                            <div class="col"><label style="color: rgb(0,0,0);">Processor Description</label>
                               <div class="form-group"><input class="form-control" type="text" name="processor_description" value="{{old('processor_description')}}"></div>

                                @if($errors->has('processor_description'))
                                            <small><i style="color: red;">*{{ $errors->first('processor_description') }}</i></small>
                                        @endif 
                            </div>


                            <div class="form-group" style="margin-top: 0px;padding: 0px;padding-top: 82px;text-align: center;"><button class="btn btn-primary text-center" type="submit" style="text-align: right;background: rgb(0,103,76);">SUBMIT</button></div>
                        </form>
                    </div>
                </div>
            </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © Brand 2021</span></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="{{route('processor.index')}}"><i class="fas fa-arrow-left"></i></a>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/Custom-File-Upload.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/theme.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>

</html>