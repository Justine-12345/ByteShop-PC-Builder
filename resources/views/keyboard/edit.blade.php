<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard - Keyboard</title>
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
                        <h3 class="text-dark mb-0">Edit Keyboard</h3>
                    </div>
                    <div style="background: rgb(230,247,236);padding: 11px;">
                        <h1 style="font-size: 23px;">Basic Info</h1>
                       
                         {{-- START --}}
                        <form method="post" action="{{ route('keyboard.update', $keyboards[0]->item_id) }}" enctype="multipart/form-data">
                            @csrf
                            {{ method_field('PATCH') }}
                            
                            <div class="form-row">
                                <div class="col"><label style="color: rgb(0,0,0);">Brand:</label>
                                    <div class="form-group">
                                        <select class="form-control" name="brand_id">
                                            <optgroup label="Brand Names">
                                                <option value="">Select Brand</option>

                                                @foreach($brands as $brand)
                                                    @if( $keyboards[0]->brand_id == $brand->brand_id)
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
                                        <input class="form-control" type="text" name="title" value="{{ $keyboards[0]->title }}">

                                        @if($errors->has('title'))
                                            <small><i style="color: red;">*{{ $errors->first('title') }}</i></small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col"><label style="color: rgb(0,0,0);">Stock:&nbsp;</label>
                                    <div class="form-group">
                                        <input class="form-control" type="number" min="1" max="1000000" step="1" placeholder="No. of Stocks" name="quantity" value="{{ $keyboards[0]->quantity }}">

                                        @if($errors->has('quantity'))
                                            <small><i style="color: red;">*{{ $errors->first('quantity') }}</i></small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col"><label style="color: rgb(0,0,0);">Price:</label>
                                    <div class="form-group">
                                        <input class="form-control" type="number" name="price" value="{{ $keyboards[0]->price }}">

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

                            <div class="col"><label style="color: rgb(0,0,0);">Type:</label>
                                <div class="form-group">
                                    <input class="form-control" type="text" name="keyboard_width" value="{{ $keyboards[0]->keyboard_width }}">

                                    @if($errors->has('keyboard_width'))
                                        <small><i style="color: red;">*{{ $errors->first('keyboard_width') }}</i></small>
                                    @endif
                                </div>
                            </div>

                            <div class="col"><label style="color: rgb(0,0,0);">Length (inches):</label>
                                <div class="form-group">
                                    <input class="form-control" type="text" name="keyboard_length" value="{{ $keyboards[0]->keyboard_length }}">

                                    @if($errors->has('keyboard_length'))
                                        <small><i style="color: red;">*{{ $errors->first('keyboard_length') }}</i></small>
                                    @endif
                                </div>
                            </div>
            
                            <div class="col"><label style="color: rgb(0,0,0);">Depth (inches):</label>
                                <div class="form-group">
                                    <input class="form-control" type="text" name="keyboard_depth" value="{{ $keyboards[0]->keyboard_depth }}">

                                    @if($errors->has('keyboard_depth'))
                                        <small><i style="color: red;">*{{ $errors->first('keyboard_depth') }}</i></small>
                                    @endif
                                </div>
                            </div>

                            <div class="col"><label style="color: rgb(0,0,0);">Weight (pounds):</label>
                                <div class="form-group"><input class="form-control" type="text" name="keyboard_weight" value="{{ $keyboards[0]->keyboard_weight }}"></div>
                            </div>

                            <div class="col"><label style="color: rgb(0,0,0);">Wired:</label>
                                <div class="form-group">
                                    @if($keyboards[0]->keyboard_wired == 'Yes')
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="keyboard_wired" id="inlineRadio1" value="Yes" checked="">
                                            <label class="form-check-label" for="inlineRadio1">Yes</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="keyboard_wired" id="inlineRadio1" value="No">
                                            <label class="form-check-label" for="inlineRadio1">No</label>
                                        </div>
                                    @elseif($keyboards[0]->keyboard_wired == 'No')
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="keyboard_wired" id="inlineRadio1" value="Yes">
                                            <label class="form-check-label" for="inlineRadio1">Yes</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="keyboard_wired" id="inlineRadio1" value="No" checked="">
                                            <label class="form-check-label" for="inlineRadio1">No</label>
                                        </div>
                                    @else
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="keyboard_wired" id="inlineRadio1" value="Yes">
                                            <label class="form-check-label" for="inlineRadio1">Yes</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="keyboard_wired" id="inlineRadio1" value="No">
                                            <label class="form-check-label" for="inlineRadio1">No</label>
                                        </div>
                                    @endif

                                    <br>

                                    @if($errors->has('keyboard_wired'))
                                        <small><i style="color: red;">*{{ $errors->first('keyboard_wired') }}</i></small>
                                    @endif
                                </div>
                            </div>

                            <div class="col"><label style="color: rgb(0,0,0);">Style of Keys:</label>
                                <div class="form-group"><input class="form-control" type="text" name="style_keys" value="{{ $keyboards[0]->style_keys }}"></div>
                            </div>

                            <div class="col"><label style="color: rgb(0,0,0);">Full Keyboard:</label>
                                <div class="form-group"><input class="form-control" type="text" name="full_keyboard" value="{{ $keyboards[0]->full_keyboard }}"></div>
                            </div>

                            <div class="col"><label style="color: rgb(0,0,0);">Color:</label>
                                <div class="form-group"><input class="form-control" type="text" name="color" value="{{ $keyboards[0]->color }}"></div>
                            </div>

                            <div class="col"><label style="color: rgb(0,0,0);">Battery:</label>
                                <div class="form-group"><input class="form-control" type="text" name="battery" value="{{ $keyboards[0]->battery }}"></div>
                            </div>

                            <div class="col"><label style="color: rgb(0,0,0);">Extra Features:</label>
                                <div class="form-group"><input class="form-control" type="text" name="extra_features"value="{{ $keyboards[0]->extra_features }}"></div>
                            </div>

                            <div class="col"><label style="color: rgb(0,0,0);">Layout:</label>
                                <div class="form-group"><input class="form-control" type="text" name="keyboard_layout"value="{{ $keyboards[0]->keyboard_layout }}"></div>
                            </div>

                            <div class="col"><label style="color: rgb(0,0,0);">Description:</label>
                                <div class="form-group"><input class="form-control" type="text" name="keyboard_description" value="{{ $keyboards[0]->keyboard_description }}"></div>
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
        </div><a class="border rounded d-inline scroll-to-top" href="{{ route('keyboard.index') }}"><i class="fas fa-arrow-left"></i></a>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/Custom-File-Upload.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/theme.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>

</html>