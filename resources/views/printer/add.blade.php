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
                        <h3 class="text-dark mb-0">Add Printers</h3>
                    </div>
                    <div style="background: rgb(230,247,236);padding: 11px;">
                        <h1 style="font-size: 23px;">Basic Info</h1>
            {{-- START --}}
                        <form method="post" action="{{ route('printer.store') }}" enctype="multipart/form-data">
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

                            
                            <div class="col"><label style="color: rgb(0,0,0);">Printer Type:</label>
                             <div class="form-group">
                                    @if(old('printer_type') == 'Inkjet')
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="printer_type" id="inlineRadio1" value="Inkjet" checked="">
                                            <label class="form-check-label" for="inlineRadio1">Inkjet</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="printer_type" id="inlineRadio1" value="Laser">
                                            <label class="form-check-label" for="inlineRadio1">Laser</label>
                                        </div>
                                    @elseif(old('printer_type') == 'Laser')
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="printer_type" id="inlineRadio1" value="Inkjet">
                                            <label class="form-check-label" for="inlineRadio1">Inkjet</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="printer_type" id="inlineRadio1" value="Laser" checked="">
                                            <label class="form-check-label" for="inlineRadio1">Laser</label>
                                        </div>
                                    @else
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="printer_type" id="inlineRadio1" value="Inkjet">
                                            <label class="form-check-label" for="inlineRadio1">Inkjet</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="printer_type" id="inlineRadio1" value="Laser">
                                            <label class="form-check-label" for="inlineRadio1">Laser</label>
                                        </div>
                                    @endif

                                    <br>

                                    @if($errors->has('printer_type'))
                                        <small><i style="color: red;">*{{ $errors->first('printer_type') }}</i></small>
                                    @endif
                                </div>
                                </div>
                  
                    <div class="col"><label style="color: rgb(0,0,0);">Ink Type:</label>
                                <div class="form-group">
                                    @if(old('int_type') == 'Monochrome')
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="int_type" id="inlineRadio1" value="Monochrome" checked="">
                                            <label class="form-check-label" for="inlineRadio1">Monochrome</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="int_type" id="inlineRadio1" value="Color">
                                            <label class="form-check-label" for="inlineRadio1">Color</label>
                                        </div>
                                    @elseif(old('int_type') == 'Color')
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="int_type" id="inlineRadio1" value="Monochrome">
                                            <label class="form-check-label" for="inlineRadio1">Monochrome</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="int_type" id="inlineRadio1" value="Color" checked="">
                                            <label class="form-check-label" for="inlineRadio1">Color</label>
                                        </div>
                                    @else
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="int_type" id="inlineRadio1" value="Monochrome">
                                            <label class="form-check-label" for="inlineRadio1">Monochrome</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="int_type" id="inlineRadio1" value="Color">
                                            <label class="form-check-label" for="inlineRadio1">Color</label>
                                        </div>
                                    @endif

                                    <br>

                                    @if($errors->has('int_type'))
                                        <small><i style="color: red;">*{{ $errors->first('int_type') }}</i></small>
                                    @endif
                                </div>
                            </div>

                            <div class="col"><label style="color: rgb(0,0,0);">All in One:</label>
                                <div class="form-group">
                                    @if(old('all_inOne') == 'Printer Only')
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="all_inOne" id="inlineRadio1" value="Printer Only" checked="">
                                            <label class="form-check-label" for="inlineRadio1">Printer Only</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="all_inOne" id="inlineRadio1" value="All-in-One Printer">
                                            <label class="form-check-label" for="inlineRadio1">All-in-One Printer</label>
                                        </div>
                                    @elseif(old('all_inOne') == 'All-in-One Printer')
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="all_inOne" id="inlineRadio1" value="Printer Only">
                                            <label class="form-check-label" for="inlineRadio1">Printer Only</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="all_inOne" id="inlineRadio1" value="All-in-One Printer" checked="">
                                            <label class="form-check-label" for="inlineRadio1">All-in-One Printer</label>
                                        </div>
                                    @else
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="all_inOne" id="inlineRadio1" value="Printer Only">
                                            <label class="form-check-label" for="inlineRadio1">Printer Only</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="all_inOne" id="inlineRadio1" value="All-in-One Printer">
                                            <label class="form-check-label" for="inlineRadio1">All-in-One Printer</label>
                                        </div>
                                    @endif

                                    <br>

                                    @if($errors->has('all_inOne'))
                                        <small><i style="color: red;">*{{ $errors->first('all_inOne') }}</i></small>
                                    @endif
                                </div>
                            </div>


                                <div class="col"><label style="color: rgb(0,0,0);">Printer Speed:&nbsp;</label>
                                    <div class="form-group">
                                        <input class="form-control" type="text" placeholder="Printer Speed in ppm" name="print_speed" value="{{old('print_speed')}}">

                                        @if($errors->has('print_speed'))
                                            <small><i style="color: red;">*{{ $errors->first('print_speed') }}</i></small>
                                        @endif
                                    </div>
                                </div>

                        <div class="col"><label style="color: rgb(0,0,0);">Duplex Support:</label>
                                <div class="form-group">
                                    @if(old('duplex_support') == 'Single-engine Duplex')
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="duplex_support" id="inlineRadio1" value="Single-engine Duplex" checked="">
                                            <label class="form-check-label" for="inlineRadio1">Single-engine Duplex</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="duplex_support" id="inlineRadio1" value="Double-engine Duplex">
                                            <label class="form-check-label" for="inlineRadio1">Double-engine Duplex</label>
                                        </div>
                                    @elseif(old('duplex_support') == 'Double-engine Duplex')
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="duplex_support" id="inlineRadio1" value="Single-engine Duplex">
                                            <label class="form-check-label" for="inlineRadio1">Single-engine Duplex</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="duplex_support" id="inlineRadio1" value="Double-engine Duplex" checked="">
                                            <label class="form-check-label" for="inlineRadio1">Double-engine Duplex</label>
                                        </div>
                                    @else
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="duplex_support" id="inlineRadio1" value="Single-engine Duplex">
                                            <label class="form-check-label" for="inlineRadio1">Single-engine Duplex</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="duplex_support" id="inlineRadio1" value="Double-engine Duplex">
                                            <label class="form-check-label" for="inlineRadio1">Double-engine Duplex</label>
                                        </div>
                                    @endif

                                    <br>

                                    @if($errors->has('duplex_support'))
                                        <small><i style="color: red;">*{{ $errors->first('duplex_support') }}</i></small>
                                    @endif
                                </div>
                            </div>

                           <div class="col"><label style="color: rgb(0,0,0);">Feeder:</label>
                                <div class="form-group">
                                    {{-- <input class="form-control" type="text" name="automatic_feed" value="{{old('automatic_feed')}}"> --}}

                                     <select name="automatic_feed" class="form-control" >
                                    <option value="">Select Feeder:</option>
                                    <option value="Auto Document Feeder">Auto Document Feeder</option>
                                    <option value="Reversing Automatic Document Feeder">Reversing Automatic Document Feeder</option>
                                    <option value="Duplexing Automatic Document Feeder">Duplexing Automatic Document Feeder</option>
                                
                                       </select>

                                    @if($errors->has('automatic_feed'))
                                        <small><i style="color: red;">*{{ $errors->first('automatic_feed') }}</i></small>
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

                  
                               <div class="col"><label style="color: rgb(0,0,0);">Paper Capacity:</label>
                                <div class="form-group"><input class="form-control" type="text" placeholder="No. of sheets" name="paper_capacity" value="{{old('paper_capacity')}}"></div>
                            </div>

                             <div class="col"><label style="color: rgb(0,0,0);">Duty Cycles:</label>
                                <div class="form-group"><input class="form-control" type="text" placeholder="No. of sheets" name="duty_cycle" value="{{old('duty_cycle')}}"></div>
                            </div>

                             <div class="col"><label style="color: rgb(0,0,0);">Cartridge Capacity:</label>
                                <div class="form-group"><input class="form-control" type="text" placeholder="No. of pages" name="catridge_capacity" value="{{old('catridge_capacity')}}"></div>
                            </div>

                              <div class="col"><label style="color: rgb(0,0,0);">Connectivity:</label>
                                <div class="form-group">
                                    
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="Standard USB Cable" name="connection_interface[]">
                                        <label class="form-check-label" for="connection_interface">Standard USB Cable</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="Bluetooth Capability" name="connection_interface[]">
                                        <label class="form-check-label" for="connection_interface">Bluetooth Capability</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="Wi-Fi Capability" name="connection_interface[]">
                                        <label class="form-check-label" for="connection_interface">Wi-Fi Capability</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="Cloud Printing Capability" name="connection_interface[]">
                                        <label class="form-check-label" for="connection_interface">Cloud Printing Capability</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="NFC Printing" name="connection_interface[]">
                                        <label class="form-check-label" for="connection_interface">NFC Printing</label>
                                    </div>
                                    <br>

                                    @if($errors->has('connection_interface'))
                                        <small><i style="color: red;">*{{ $errors->first('connection_interface') }}</i></small>
                                    @endif
                                </div>
                            </div>


                               <div class="col"><label style="color: rgb(0,0,0);">Scanner Resolution:</label>
                                <div class="form-group">
                                    <input class="form-control" type="text" name="scanner_resolution" placeholder="Scanner Resolution in DPI" value="{{old('scanner_resolution')}}">

                                    @if($errors->has('scanner_resolution'))
                                        <small><i style="color: red;">*{{ $errors->first('scanner_resolution') }}</i></small>
                                    @endif
                                </div>
                            </div>

                            <div class="col"><label style="color: rgb(0,0,0);">Copy Speed:</label>
                                <div class="form-group">
                                    <input class="form-control" type="text" name="copy_speed" placeholder="Copy speed in ppm" value="{{old('copy_speed')}}">

                                    @if($errors->has('copy_speed'))
                                        <small><i style="color: red;">*{{ $errors->first('copy_speed') }}</i></small>
                                    @endif
                                </div>
                            </div>  

                            <div class="col"><label style="color: rgb(0,0,0);">Printer Memory:</label>
                                <div class="form-group">
                                

                                     <select name="printer_memory" class="form-control" >
                                    <option value="">Select Memory:</option>
                                  
                                    <option value="2MB">2MB</option>
                                      <option value="4MB">4MB</option>
                                      <option value="8MB">8MB</option>
                                     <option value="16MB">16MB</option>
                                      <option value="32MB">32MB</option>
                               
                                       </select>

                                    @if($errors->has('printer_memory'))
                                        <small><i style="color: red;">*{{ $errors->first('printer_memory') }}</i></small>
                                    @endif
                                </div>
                            </div>

                            <div class="col"><label style="color: rgb(0,0,0);">Security and Encryption:</label>
                                <div class="form-group">
                                

                                     <select name="encryption_support" class="form-control" >
                                    <option value="">Select Security and Encryption:</option>
                                  
                                    <option value="None">None</option>
                                      <option value="User Authentication Features">User Authentication Features</option>
                                      <option value="Data Encryption">Data Encryption</option>

                                       </select>

                                    @if($errors->has('encryption_support'))
                                        <small><i style="color: red;">*{{ $errors->first('encryption_support') }}</i></small>
                                    @endif
                                </div>
                            </div>


                                       

                        
                    

                            <div class="col"><label style="color: rgb(0,0,0);">Description:</label>
                                <div class="form-group"><input class="form-control" type="text" name="printer_description" value="{{old('printer_description')}}"></div>
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
        </div><a class="border rounded d-inline scroll-to-top" href="{{ route('printer.index') }}"><i class="fas fa-arrow-left"></i></a>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/Custom-File-Upload.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/theme.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>

</html>