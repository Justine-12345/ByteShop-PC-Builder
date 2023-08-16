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
                        <h3 class="text-dark mb-0">Edit Power Supply</h3>
                    </div>
                    <div style="background: rgb(230,247,236);padding: 11px;">
                        <h1 style="font-size: 23px;">Basic Info</h1>
                        <form  action="{{ route('powersupply.update', $powersupply->item_id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            {{ method_field('PATCH') }}
                             <div class="form-row">
                                <div class="col"><label style="color: rgb(0,0,0);">Brand:</label>
                                    <div class="form-group">
                                        <select class="form-control" name="brand_id">
                                            <optgroup label="Brand Names">
                                                <option value="">Select Brand</option>

                                                  @foreach($brands as $brand)
                                                    @if( $powersupply->brand_id == $brand->brand_id)
                                                        <option value="{{ $brand->brand_id }}" selected="">{{ $brand->brand_name }}</option>
                                                    @else
                                                        <option value="{{$brand->brand_id }}">{{ $brand->brand_name }}</option>
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
                                        <input class="form-control" type="text" name="title" value="{{old('title')?old('title'):$powersupply->title}}">

                                        @if($errors->has('title'))
                                            <small><i style="color: red;">*{{ $errors->first('title') }}</i></small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                           
                             <div class="form-row">
                                <div class="col"><label style="color: rgb(0,0,0);">Stock:&nbsp;</label>
                                    <div class="form-group">
                                        <input class="form-control" type="number" min="1" max="1000000" step="1" placeholder="No. of Stocks" name="quantity" value="{{old('quantity')?old('quantity'):$powersupply->quantity}}">

                                        @if($errors->has('quantity'))
                                            <small><i style="color: red;">*{{ $errors->first('quantity') }}</i></small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col"><label style="color: rgb(0,0,0);">Price:</label>
                                    <div class="form-group">
                                        <input class="form-control" type="number" name="price" value="{{old('price')?old('price'):$powersupply->price}}" step="1" min="1" max="1000000">

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
                    {{-- OTHER INFO --}}
                            <div style="margin-bottom: 6px;">
                                <h1 style="font-size: 23px;">Other Info</h1>
                            </div>
                            <div class="col"><label style="color: rgb(0,0,0);">Form Factor</label>
                                <div class="form-group">
                                 <select name="form_factor" class="form-control" >
                                    @if(old('form_factor'))
                                    <option value="{{old('form_factor')}}" selected>{{old('form_factor')}}</option>

                                    @else
                                    <option value="{{$powersupply->form_factor}}" selected>{{$powersupply->form_factor}}</option>
                                    @endif
                                    <option value="">Select Form Factor</option>
                                    <option value="ATX"> ATX</option>
                                    <option value="ATX12V v1.x"> ATX12V v1.x </option>
                                    <option value=" ATX12V v2.x">  ATX12V v2.x </option>
                                    <option value="micro-ATX"> micro-ATX </option>
                                    <option value="LFX12V"> LFX12V </option> 
                                    <option value="SFX12V"> SFX12V  </option> 
                                    <option value="EPS12V"> EPS12V  </option> 
                                    <option value="CFX12V"> CFX12V  </option> 
                                    <option value="TFX12V"> TFX12V  </option> 
                                    <option value="WTX12V"> WTX12V  </option> 
                                    <option value="FlexATX"> FlexATX  </option> 
                                 </select>
                                   @if($errors->has('form_factor'))
                                            <small><i style="color: red;">*{{ $errors->first('form_factor') }}</i></small>
                                        @endif
                                </div>
                            </div>

                            <div class="col"><label style="color: rgb(0,0,0);">Wattage</label>
                                 <div class="form-group"><input class="form-control" type="number" name="wattage" min="1" max="1000" step="1" placeholder="0"value="{{old('wattage')? old('wattage'): $powersupply->wattage}}"></div>
                                    @if($errors->has('wattage'))
                                            <small><i style="color: red;">*{{ $errors->first('wattage') }}</i></small>
                                        @endif
                            </div>


                            <div class="col"><label style="color: rgb(0,0,0);">Efficiency Rating</label>
                                <div class="form-group">
                                    <select name="efficiency_rating" class="form-control" >
                                    @if(old('efficiency_rating'))
                                    <option value="{{old('efficiency_rating')}}" selected>{{old('efficiency_rating')}}</option>
                                    @else
                                    <option value="{{$powersupply->efficiency_rating}}" selected>{{$powersupply->efficiency_rating}}</option>
                                    @endif
                                    <option value="">Select Efficiency Rating</option>
                                    <option value="80 PLUS"> 80 PLUS</option>
                                    <option value="80 PLUS Bronze"> 80 PLUS Bronze</option>
                                    <option value="80 PLUS Silver">  80 PLUS Silver </option>
                                    <option value="80 PLUS Gold"> 80 PLUS Gold </option>
                                    <option value="80 PLUS Platinum"> 80 PLUS Platinum </option> 
                                    <option value="80 PLUS Titanium"> 80 PLUS Titanium  </option> 
                                 </select>
                                   @if($errors->has('efficiency_rating'))
                                            <small><i style="color: red;">*{{ $errors->first('efficiency_rating') }}</i></small>
                                        @endif
                                  </div>
                            </div>



                            <div class="col"><label style="color: rgb(0,0,0);">Railst</label>
                                <div class="form-group">
                                     <select name="rails" class="form-control" >
                                    @if(old('rails'))
                                    <option value="{{old('rails')}}" selected>{{old('rails')}}</option>
                                    @else
                                    <option value="{{$powersupply->rails}}" selected>{{$powersupply->rails}}</option>
                                    @endif
                                    <option value="">Select Railst</option>
                                    <option value="Single-Rail"> Single-Rail</option>
                                    <option value="Multi-Rail"> Multi-Rail</option> 
                                 </select>
                                   @if($errors->has('rails'))
                                            <small><i style="color: red;">*{{ $errors->first('rails') }}</i></small>
                                        @endif
                                </div>
                            </div>


                          {{-- {{dd($protection)}} --}}

                             <div class="col"><label style="color: rgb(0,0,0);">Protection:</label>
                                <div class="form-group">
                                    
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="Over Voltage Protection" name="protection[]" 
                                        @if(old('protection'))
                                        {!!in_array("Over Voltage Protection", old('protection'))? 'checked' : null!!}
                                        @elseif($protection)
                                        {!!in_array("Over Voltage Protection", $protection)? 'checked' : null!!}
                                        @endif
                                         >
                                        <label class="form-check-label" for="protection">Over Voltage Protection</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="Under Voltage Protection" name="protection[]" 
                                        @if(old('protection'))
                                        {!!in_array("Under Voltage Protection", old('protection'))? 'checked' : null!!}
                                        @elseif($protection)
                                        {!!in_array("Under Voltage Protection", $protection)? 'checked' : null!!}
                                        @endif
                                        >
                                        <label class="form-check-label" for="protection">Under Voltage Protection</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="Over Power Protection" name="protection[]"
                                         @if(old('protection'))
                                        {!!in_array("Over Power Protection", old('protection'))? 'checked' : null!!}
                                         @elseif($protection)
                                        {!!in_array("Over Power Protection", $protection)? 'checked' : null!!}
                                        @endif
                                        >
                                        <label class="form-check-label" for="protection">Over Power Protection</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="Short Circuit Protection" name="protection[]" 
                                         @if(old('protection'))
                                        {!!in_array("Short Circuit Protection", old('protection'))? 'checked' : null!!}
                                        @elseif($protection)
                                        {!!in_array("Short Circuit Protection", $protection)? 'checked' : null!!}
                                        @endif

                                        >
                                        <label class="form-check-label" for="protection">Short Circuit Protection</label>
                                    </div>
                                     <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="Over Current Protection" name="protection[]"
                                        @if(old('protection'))
                                        {!!in_array("Over Current Protection", old('protection'))? 'checked' : null!!}
                                        @elseif($protection)
                                        {!!in_array("Over Current Protection", $protection)? 'checked' : null!!}
                                        @endif
                                        >
                                        <label class="form-check-label" for="protection">Over Current Protection</label>
                                    </div>
                                     <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="Over Temperature Protection" name="protection[]"
                                        @if(old('protection'))
                                        {!!in_array("Over Temperature Protection", old('protection'))? 'checked' : null!!}
                                        @elseif($protection)
                                        {!!in_array("Over Temperature Protection", $protection)? 'checked' : null!!}
                                        @endif
                                        >
                                        <label class="form-check-label" for="protection">Over Temperature Protection</label>
                                    </div>
                                     <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="Brown Out Protection" name="protection[]"
                                        @if(old('protection'))
                                        {!!in_array("Brown Out Protection", old('protection'))? 'checked' : null!!}
                                        @elseif($protection)
                                        {!!in_array("Brown Out Protection", $protection)? 'checked' : null!!}
                                        @endif
                                        >
                                        <label class="form-check-label" for="protection">Brown Out Protection</label>
                                    </div>

                                    <br>

                                    @if($errors->has('protection'))
                                        <small><i style="color: red;">*{{ $errors->first('protection') }}</i></small>
                                    @endif
                                </div>
                            </div>




                            <div class="col"><label style="color: rgb(0,0,0);">Modularity</label>
                                <div class="form-group">
                                     <select name="modularity" class="form-control" >
                                    @if(old('modularity'))
                                    <option value="{{old('modularity')}}" selected>{{old('modularity')}}</option>
                                    @else
                                    <option value="{{$powersupply->modularity}}" selected>{{$powersupply->modularity}}</option>
                                    @endif
                                    <option value="">Select Modularity</option>
                                    <option value="Non-Modular"> Non-Modular</option>
                                    <option value="Semi-Modular"> Semi-Modular</option>
                                    <option value="Full-Modular"> Full-Modular</option> 
                                 </select>
                                   @if($errors->has('modularity'))
                                            <small><i style="color: red;">*{{ $errors->first('modularity') }}</i></small>
                                        @endif
                                </div>
                            </div>


                            <div class="col"><label style="color: rgb(0,0,0);">Variable_rpmfan</label>
                                <div class="form-group">
                                        <input class="form-control" type="text" name="variable_rpmfan" value="{{old('variable_rpmfan')?old('variable_rpmfan'):$powersupply->variable_rpmfan }}">

                                        @if($errors->has('variable_rpmfan'))
                                            <small><i style="color: red;">*{{ $errors->first('variable_rpmfan') }}</i></small>
                                        @endif
                                    </div>
                            </div>



                            <div class="col"><label style="color: rgb(0,0,0);">Fan Size (mm)</label>
                                <div class="form-group">
                                        <input class="form-control" type="number" name="fan_size" min="1" max="1000" step="1" value="{{old('fan_size')?old('fan_size'):$powersupply->fan_size}}">

                                        @if($errors->has('fan_size'))
                                            <small><i style="color: red;">*{{ $errors->first('fan_size') }}</i></small>
                                        @endif
                                    </div>
                            </div>



                            <div class="col"><label style="color: rgb(0,0,0);">Power Supply Description</label>
                                 <div class="form-group">
                                        <input class="form-control" type="text" name="  powersupplies_description" value="{{old('   powersupplies_description')?old('   powersupplies_description'):$powersupply->powersupplies_description}}">

                                        @if($errors->has('  powersupplies_description'))
                                            <small><i style="color: red;">*{{ $errors->first('  powersupplies_description') }}</i></small>
                                        @endif
                                    </div>
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
        </div><a class="border rounded d-inline scroll-to-top" href="{{url()->previous()}}"><i class="fas fa-arrow-left"></i></a>
    </div>










    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/Custom-File-Upload.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/theme.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>

</html>