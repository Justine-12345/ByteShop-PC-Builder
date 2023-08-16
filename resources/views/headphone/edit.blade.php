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
                        <h3 class="text-dark mb-0">Edit Headphone</h3>
                    </div>
                    <div style="background: rgb(230,247,236);padding: 11px;">
                        <h1 style="font-size: 23px;">Basic Info</h1>
                       
                         {{-- START --}}
                        <form method="post" action="{{ route('headphone.update', $headphones[0]->item_id) }}" enctype="multipart/form-data">
                            @csrf
                            {{ method_field('PATCH') }}
                            
                            <div class="form-row">
                                <div class="col"><label style="color: rgb(0,0,0);">Brand:</label>
                                    <div class="form-group">
                                        <select class="form-control" name="brand_id">
                                            <optgroup label="Brand Names">
                                                <option value="">Select Brand</option>

                                                @foreach($brands as $brand)
                                                    @if( $headphones[0]->brand_id == $brand->brand_id)
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
                                        <input class="form-control" type="text" name="title" value="{{ $headphones[0]->title }}">

                                        @if($errors->has('title'))
                                            <small><i style="color: red;">*{{ $errors->first('title') }}</i></small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col"><label style="color: rgb(0,0,0);">Stock:&nbsp;</label>
                                    <div class="form-group">
                                        <input class="form-control" type="number" min="1" max="1000000" step="1" placeholder="No. of Stocks" name="quantity" value="{{ $headphones[0]->quantity }}">

                                        @if($errors->has('quantity'))
                                            <small><i style="color: red;">*{{ $errors->first('quantity') }}</i></small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col"><label style="color: rgb(0,0,0);">Price:</label>
                                    <div class="form-group">
                                        <input class="form-control" type="number" name="price" value="{{ $headphones[0]->price }}">

                                        @if($errors->has('price'))
                                            <small><i style="color: red;">*{{ $errors->first('price') }}</i></small>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                   <div class="col"><label style="color: rgb(0,0,0);">Upload Image:</label>
                                    <div class="form-group"><input class="form-control-file" type="file" accept="image/*" name="image[]" ></div>
                                </div>
                            </div>

                            <div style="margin-bottom: 6px;">
                                <h1 style="font-size: 23px;">Other Info</h1>
                            </div>

        {{--  ADD ADDITIONAL INPUTS HERE --}}
                        
                                <div class="col"><label style="color: rgb(0,0,0);">Frequency Response:&nbsp;</label>
                                    <div class="form-group">
                                        <input class="form-control" type="text" name="frequency_response" value="{{old('frequency_response')?old('frequency_response'):$headphones[0]->frequency_response}}">

                                        @if($errors->has('frequency_response'))
                                            <small><i style="color: red;">*{{ $errors->first('frequency_response') }}</i></small>
                                        @endif
                                    </div>
                                </div>

                              <div class="col"><label style="color: rgb(0,0,0);">Transducer Principle:</label>
                                <div class="form-group">
                                    {{-- <input class="form-control" type="text" name="poll_rate" value="{{old('poll_rate')}}"> --}}

                                     <select name="transducer_principle" class="form-control" >
                                   <option  value="{{ $headphones[0]->transducer_principle}}" selected >{{ $headphones[0]->transducer_principle}}</option>
                                    <option value="Moving-coil dynamic">Moving-coil dynamic</option>
                                    <option value="Planar magnetic">Planar magnetic</option>
                                    <option value="Electrostatic">Electrostatic</option>
                                      <option value="Balanced armature">Balanced armature</option>
                                      <option value="Bone conduction">Bone conduction</option>
                                     
                                       </select>

                                    @if($errors->has('transducer_principle'))
                                        <small><i style="color: red;">*{{ $errors->first('transducer_principle') }}</i></small>
                                    @endif
                                </div>
                            </div>

            
                                <div class="col"><label style="color: rgb(0,0,0);">Driver Size:&nbsp;</label>
                                    <div class="form-group">
                                        <input class="form-control" type="text" name="driver_size" value="{{ $headphones[0]->driver_size}}">

                                        @if($errors->has('driver_size'))
                                            <small><i style="color: red;">*{{ $errors->first('driver_size') }}</i></small>
                                        @endif
                                    </div>
                                </div>
                        

                                <div class="col"><label style="color: rgb(0,0,0);">Nominal Impedence:&nbsp;</label>
                                    <div class="form-group">
                                        <input class="form-control" type="text" name="nominal_impedance" value="{{ $headphones[0]->nominal_impedance}}">

                                        @if($errors->has('nominal_impedance'))
                                            <small><i style="color: red;">*{{ $errors->first('nominal_impedance') }}</i></small>
                                        @endif
                                    </div>
                                </div>


                                <div class="col"><label style="color: rgb(0,0,0);">Sensitivity:&nbsp;</label>
                                    <div class="form-group">
                                        <input class="form-control" type="text"  name="headphone_sensivity" value="{{ $headphones[0]->headphone_sensivity}}">

                                        @if($errors->has('headphone_sensivity'))
                                            <small><i style="color: red;">*{{ $errors->first('headphone_sensivity') }}</i></small>
                                        @endif
                                    </div>
                                </div>
                       

                          <div class="col"><label style="color: rgb(0,0,0);">Weight:</label>
                                <div class="form-group"><input class="form-control" type="text" name="weight" value="{{ $headphones[0]->weight}}"></div>
                            </div>
                    

                            <div class="col"><label style="color: rgb(0,0,0);">Description:</label>
                                <div class="form-group"><input class="form-control" type="text" name="headphones_desciption" value="{{ $headphones[0]->headphones_desciption }}"></div>
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
        </div><a class="border rounded d-inline scroll-to-top" href="{{ route('headphone.index') }}"><i class="fas fa-arrow-left"></i></a>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/Custom-File-Upload.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/theme.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>

</html>