<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard - Casing</title>
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
                        <h3 class="text-dark mb-0">Edit Casing</h3>
                    </div>
                    <div style="background: rgb(230,247,236);padding: 11px;">
                        <h1 style="font-size: 23px;">Basic Info</h1>
                       
                         {{-- START --}}
                        <form method="post" action="{{ route('casing.update', $casings[0]->item_id) }}" enctype="multipart/form-data">
                            @csrf
                            {{ method_field('PATCH') }}
                            
                            <div class="form-row">
                                <div class="col"><label style="color: rgb(0,0,0);">Brand:</label>
                                    <div class="form-group">
                                        <select class="form-control" name="brand_id">
                                            <optgroup label="Brand Names">
                                                <option value="">Select Brand</option>

                                                @foreach($brands as $brand)
                                                    @if( $casings[0]->brand_id == $brand->brand_id)
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
                                        <input class="form-control" type="text" name="title" value="{{ $casings[0]->title }}">

                                        @if($errors->has('title'))
                                            <small><i style="color: red;">*{{ $errors->first('title') }}</i></small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col"><label style="color: rgb(0,0,0);">Stock:&nbsp;</label>
                                    <div class="form-group">
                                        <input class="form-control" type="number" min="1" max="1000000" step="1" placeholder="No. of Stocks" name="quantity" value="{{ $casings[0]->quantity }}">

                                        @if($errors->has('quantity'))
                                            <small><i style="color: red;">*{{ $errors->first('quantity') }}</i></small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col"><label style="color: rgb(0,0,0);">Price:</label>
                                    <div class="form-group">
                                        <input class="form-control" type="number" name="price" value="{{ $casings[0]->price }}">

                                        @if($errors->has('price'))
                                            <small><i style="color: red;">*{{ $errors->first('price') }}</i></small>
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <div class="form-row">
                                   <div class="col"><label style="color: rgb(0,0,0);">Upload Image:</label>
                                    <div class="form-group"><input class="form-control-file" type="file" accept="image/*" name="image[]"></div>
                                </div>
                            </div>

                            <div style="margin-bottom: 6px;">
                                <h1 style="font-size: 23px;">Other Info</h1>
                            </div>

        {{--  ADD ADDITIONAL INPUTS HERE --}}

                            <div class="col"><label style="color: rgb(0,0,0);">Type:</label>
                                <div class="form-group">
                                    <input class="form-control" type="text" name="case_type" value="{{ $casings[0]->case_type }}">

                                    @if($errors->has('case_type'))
                                        <small><i style="color: red;">*{{ $errors->first('case_type') }}</i></small>
                                    @endif
                                </div>
                            </div>

                            <div class="col"><label style="color: rgb(0,0,0);">Steel Thickness:</label>
                                <div class="form-group"><input class="form-control" type="text" name="steel_thickness" value="{{ $casings[0]->steel_thickness }}"></div>
                            </div>

                            <div class="col"><label style="color: rgb(0,0,0);">Motherbaords:</label>
                                <div class="form-group">
                                    @foreach($motherboard_formfactors as $motherboard_formfactor)
                                        @if(in_array($motherboard_formfactor, $case_motherboards))
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="{{ $motherboard_formfactor }}" name="case_motherboards[]" checked="">
                                                <label class="form-check-label" for="case_motherboards">{{ $motherboard_formfactor }}</label>
                                            </div>
                                        @elseif($motherboard_formfactor != '')
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="{{ $motherboard_formfactor }}" name="case_motherboards[]">
                                                <label class="form-check-label" for="case_motherboards">{{ $motherboard_formfactor }}</label>
                                            </div>
                                        @endif
                                    @endforeach

                                    <br>

                                    @if($errors->has('case_motherboards'))
                                        <small><i style="color: red;">*{{ $errors->first('case_motherboards') }}</i></small>
                                    @endif
                                </div>
                            </div>

                            <div class="col"><label style="color: rgb(0,0,0);">Width:</label>
                                <div class="form-group">
                                    <input class="form-control" type="text" name="case_width" value="{{ $casings[0]->case_width }}">

                                    @if($errors->has('case_width'))
                                        <small><i style="color: red;">*{{ $errors->first('case_width') }}</i></small>
                                    @endif
                                </div>
                            </div>

                            <div class="col"><label style="color: rgb(0,0,0);">Height:</label>
                                <div class="form-group">
                                    <input class="form-control" type="text" name="case_height" value="{{ $casings[0]->case_height }}">

                                    @if($errors->has('case_height'))
                                        <small><i style="color: red;">*{{ $errors->first('case_height') }}</i></small>
                                    @endif
                                </div>
                            </div>

                            <div class="col"><label style="color: rgb(0,0,0);">Depth:</label>
                                <div class="form-group">
                                    <input class="form-control" type="text" name="case_depth" value="{{ $casings[0]->case_depth }}">

                                    @if($errors->has('case_depth'))
                                        <small><i style="color: red;">*{{ $errors->first('case_depth') }}</i></small>
                                    @endif
                                </div>
                            </div>

                            <div class="col"><label style="color: rgb(0,0,0);">Drive Bay 5.25:</label>
                                <div class="form-group">
                                    <input class="form-control" type="text" name="drivebay_5point25" value="{{ $casings[0]->drivebay_5point25 }}">

                                    @if($errors->has('drivebay_5point25'))
                                        <small><i style="color: red;">*{{ $errors->first('drivebay_5point25') }}</i></small>
                                    @endif
                                </div>
                            </div>

                            <div class="col"><label style="color: rgb(0,0,0);">Drive Bay 3.5:</label>
                                <div class="form-group">
                                    <input class="form-control" type="text" name="drivebay_3point5" value="{{ $casings[0]->drivebay_3point5 }}">

                                    @if($errors->has('drivebay_3point5'))
                                        <small><i style="color: red;">*{{ $errors->first('drivebay_3point5') }}</i></small>
                                    @endif
                                </div>
                            </div>

                            <div class="col"><label style="color: rgb(0,0,0);">Drive Bay 2.5:</label>
                                <div class="form-group">
                                    <input class="form-control" type="text" name="drivebay_2point5" value="{{ $casings[0]->drivebay_2point5 }}">

                                    @if($errors->has('drivebay_2point5'))
                                        <small><i style="color: red;">*{{ $errors->first('drivebay_2point5') }}</i></small>
                                    @endif
                                </div>
                            </div>

                            <div class="col"><label style="color: rgb(0,0,0);">Expansion Slot:</label>
                                <div class="form-group"><input class="form-control" type="text" name="expansion_slot" value="{{ $casings[0]->expansion_slot }}"></div>
                            </div>

                            <div class="col"><label style="color: rgb(0,0,0);">Max PCI Slots:</label>
                                <div class="form-group"><input class="form-control" type="text" name="max_pcislots"value="{{ $casings[0]->max_pcislots }}"></div>
                            </div>

                            <div class="col"><label style="color: rgb(0,0,0);">IO Ports:</label>
                                <div class="form-group"><input class="form-control" type="text" name="io_ports"value="{{ $casings[0]->io_ports }}"></div>
                            </div>

                            <div class="col"><label style="color: rgb(0,0,0);">Height of Coolers:</label>
                                <div class="form-group"><input class="form-control" type="text" name="height_coolers" value="{{ $casings[0]->height_coolers }}"></div>
                            </div>

                            <div class="col"><label style="color: rgb(0,0,0);">Air Cooling System:</label>
                                <div class="form-group"><input class="form-control" type="text" name="aircooling_system" value="{{ $casings[0]->aircooling_system }}"></div>
                            </div>

                            <div class="col"><label style="color: rgb(0,0,0);">Net Weight:</label>
                                <div class="form-group"><input class="form-control" type="text" name="net_weight" value="{{ $casings[0]->net_weight }}"></div>
                            </div>

                            <div class="col"><label style="color: rgb(0,0,0);">Description:</label>
                                <div class="form-group"><input class="form-control" type="text" name="casing_description" value="{{ $casings[0]->casing_description }}"></div>
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
        </div><a class="border rounded d-inline scroll-to-top" href="{{ route('casing.index') }}"><i class="fas fa-arrow-left"></i></a>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/Custom-File-Upload.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/theme.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>

</html>