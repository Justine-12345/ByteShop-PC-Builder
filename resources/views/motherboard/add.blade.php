<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard - Motherboard</title>
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
                        <h3 class="text-dark mb-0">Add Motherboard</h3>
                    </div>
                    <div style="background: rgb(230,247,236);padding: 11px;">
                        <h1 style="font-size: 23px;">Basic Info</h1>
            {{-- START --}}
                        <form method="post" action="{{ route('motherboard.store') }}" enctype="multipart/form-data">
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
                                        <input class="form-control" type="number" name="price" value="{{old('price')}}" min="1" max="1000000" step="1">

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

                         <div class="col"><label style="color: rgb(0,0,0);">Form Factor:</label>
                                <div class="form-group">
                                    {{-- <input class="form-control" type="text" name="poll_rate" value="{{old('poll_rate')}}"> --}}

                                     <select name="form_factor" class="form-control" >
                                    <option value="">Select Form Factor</option>
                                    <option value="ATX">ATX</option>
                                    <option value="EATX">EATX</option>
                                    <option value="MicroATX">MicroATX</option>
                                      <option value="Mini-ITX">Mini-ITX</option>
                                     
                                       </select>

                                    @if($errors->has('form_factor'))
                                        <small><i style="color: red;">*{{ $errors->first('form_factor') }}</i></small>
                                    @endif
                                </div>
                            </div>
                  
                    <div class="col"><label style="color: rgb(0,0,0);">CPU Socket:</label>
                                <div class="form-group">
                                    {{-- <input class="form-control" type="text" name="poll_rate" value="{{old('poll_rate')}}"> --}}

                                     <select name="cpu_socket" class="form-control" >
                                    <option value="">Select CPU Socket</option>
                                    <option value="AMD Ryzen - AM3">AMD Ryzen - AM3</option>
                                    <option value="AMD Ryzen - AM4">AMD Ryzen - AM4</option>
                                    <option value="AMD Ryzen Threadripper - TR4">AMD Ryzen Threadripper - TR4</option>
                                    <option value="Intel - LGA775">Intel - LGA775</option>
                                    <option value="Intel - LGA1150">Intel - LGA1150 </option>
                                    <option value="Intel - LGA1151">Intel - LGA1151</option>
                                    <option value="Intel - LGA1156">Intel - LGA1156</option>
                                    <option value="Intel - LGA1200">Intel - LGA1200</option>
                                    <option value="Intel - LGA2011">Intel - LGA2011</option>
                                    <option value="Intel - LGA2011-3 ">Intel - LGA2011-3</option> 
                                    <option value="Intel - LGA2066">Intel - LGA2066</option>
                                    <option value="Intel - LGA3647">Intel - LGA3647</option> 
                                    <option value="Intel - LGA4189">Intel - LGA4189</option> 
                                       </select>

                                    @if($errors->has('cpu_socket'))
                                        <small><i style="color: red;">*{{ $errors->first('cpu_socket') }}</i></small>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col"><label style="color: rgb(0,0,0);">USB Ports:</label>
                                <div class="form-group">
                                    {{-- <input class="form-control" type="text" name="poll_rate" value="{{old('poll_rate')}}"> --}}

                                     <select name="usb_ports" class="form-control" >
                                    <option value="">Select USB ports</option>
                                    <option value="USB 2.0">USB 2.0</option>
                                    <option value="USB 3.0">USB 3.0</option>
                                    <option value="USB 3.2">USB 3.2</option>
                                      <option value="USB Type C">USB Type C</option>
                                     
                                       </select>

                                    @if($errors->has('usb_ports'))
                                        <small><i style="color: red;">*{{ $errors->first('usb_ports') }}</i></small>
                                    @endif
                                </div>
                            </div>
                              {{--   <div class="col"><label style="color: rgb(0,0,0);">CPU Socket:&nbsp;</label>
                                    <div class="form-group">
                                        <input class="form-control" type="text" placeholder="Driver size in mm" name="driver_size" value="{{old('driver_size')}}">

                                        @if($errors->has('driver_size'))
                                            <small><i style="color: red;">*{{ $errors->first('driver_size') }}</i></small>
                                        @endif
                                    </div>
                                </div>
                         --}}


              
                                 <div class="col"><label style="color: rgb(0,0,0);">RAM Slot:</label>
                                <div class="form-group">
                                    {{-- <input class="form-control" type="text" name="poll_rate" value="{{old('poll_rate')}}"> --}}

                                     <select name="ram_slot" class="form-control" >
                                    <option value="">Select RAM Slot</option>
                                    <option value="DDR3">DDR3</option>
                                    <option value="DDR4">DDR4</option>
                                    
                                     
                                       </select>

                                    @if($errors->has('ram_slot'))
                                        <small><i style="color: red;">*{{ $errors->first('ram_slot') }}</i></small>
                                    @endif
                                </div>
                            </div>
                    


               
                                <div class="col"><label style="color: rgb(0,0,0);">Video Connector:</label>
                                <div class="form-group">
                                    
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="VGA" name="video_connectors[]">
                                        <label class="form-check-label" for="video_connectors">VGA</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="DVI" name="video_connectors[]">
                                        <label class="form-check-label" for="video_connectors">DVI</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="HDMI" name="video_connectors[]">
                                        <label class="form-check-label" for="video_connectors">HDMI</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="Display Port" name="video_connectors[]">
                                        <label class="form-check-label" for="video_connectors">Display Port</label>
                                    </div>
                                   
                                    <br>

                                    @if($errors->has('video_connectors'))
                                        <small><i style="color: red;">*{{ $errors->first('video_connectors') }}</i></small>
                                    @endif
                                </div>
                            </div>
             
                       
                         
                               <div class="col"><label style="color: rgb(0,0,0);">PCIE Slots:</label>
                                <div class="form-group"><input class="form-control" type="text" name="pcie_slots" placeholder="Input pcie slot"value="{{old('pcie_slots')}}"></div>
                            </div>

                            <div class="col"><label style="color: rgb(0,0,0);">Onboard Wi-Fi Support:</label>
                                <div class="form-group">
                                    @if(old('inbuilt_wifi') == 'Yes')
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inbuilt_wifi" id="inlineRadio1" value="Yes" checked="">
                                            <label class="form-check-label" for="inlineRadio1">Yes</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inbuilt_wifi" id="inlineRadio1" value="No">
                                            <label class="form-check-label" for="inlineRadio1">No</label>
                                        </div>
                                    @elseif(old('inbuilt_wifi') == 'No')
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inbuilt_wifi" id="inlineRadio1" value="Yes">
                                            <label class="form-check-label" for="inlineRadio1">Yes</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inbuilt_wifi" id="inlineRadio1" value="No" checked="">
                                            <label class="form-check-label" for="inlineRadio1">No</label>
                                        </div>
                                    @else
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inbuilt_wifi" id="inlineRadio1" value="Yes">
                                            <label class="form-check-label" for="inlineRadio1">Yes</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inbuilt_wifi" id="inlineRadio1" value="No">
                                            <label class="form-check-label" for="inlineRadio1">No</label>
                                        </div>
                                    @endif

                                    <br>

                                    @if($errors->has('inbuilt_wifi'))
                                        <small><i style="color: red;">*{{ $errors->first('inbuilt_wifi') }}</i></small>
                                    @endif
                                </div>
                            </div>

                            <div class="col"><label style="color: rgb(0,0,0);">Sata:</label>
                                <div class="form-group">
                                    {{-- <input class="form-control" type="text" name="poll_rate" value="{{old('poll_rate')}}"> --}}

                                     <select name="sata" class="form-control" >
                                    <option value="">Select Sata</option>
                                    <option value="SATAII">SATAII</option>
                                    <option value="SATAIII">SATAIII</option>
                                    <option value="ESATA">ESATA</option>
                                      <option value="MSATA">MSATA</option>
                                     
                                       </select>

                                    @if($errors->has('sata'))
                                        <small><i style="color: red;">*{{ $errors->first('sata') }}</i></small>
                                    @endif
                                </div>
                            </div>

                    <div class="col"><label style="color: rgb(0,0,0);">M.2 Nvme Support:</label>
                                <div class="form-group">
                                    @if(old('nvme_support') == 'M.2')
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="nvme_support" id="inlineRadio1" value="M.2" checked="">
                                            <label class="form-check-label" for="inlineRadio1">M.2</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="nvme_support" id="inlineRadio1" value="M.2 NVMe">
                                            <label class="form-check-label" for="inlineRadio1">M.2 NVMe</label>
                                        </div>
                                    @elseif(old('nvme_support') == 'M.2 NVMe')
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="nvme_support" id="inlineRadio1" value="M.2">
                                            <label class="form-check-label" for="inlineRadio1">M.2</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="nvme_support" id="inlineRadio1" value="M.2 NVMe" checked="">
                                            <label class="form-check-label" for="inlineRadio1">M.2 NVMe</label>
                                        </div>
                                    @else
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="nvme_support" id="inlineRadio1" value="M.2">
                                            <label class="form-check-label" for="inlineRadio1">M.2</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="nvme_support" id="inlineRadio1" value="M.2 NVMe">
                                            <label class="form-check-label" for="inlineRadio1">M.2 NVMe</label>
                                        </div>
                                    @endif

                                    <br>

                                    @if($errors->has('nvme_support'))
                                        <small><i style="color: red;">*{{ $errors->first('nvme_support') }}</i></small>
                                    @endif
                                </div>
                            </div>

                          <div class="col"><label style="color: rgb(0,0,0);">RGB Headers:</label>
                                <div class="form-group">
                                    @if(old('rgb_header') == '12V RGB')
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rgb_header" id="inlineRadio1" value="12V RGB" checked="">
                                            <label class="form-check-label" for="inlineRadio1">12V RGB</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rgb_header" id="inlineRadio1" value="5V ARGB">
                                            <label class="form-check-label" for="inlineRadio1">5V ARGB</label>
                                        </div>
                                    @elseif(old('rgb_header') == '5V ARGB')
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rgb_header" id="inlineRadio1" value="12V RGB">
                                            <label class="form-check-label" for="inlineRadio1">12V RGB</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rgb_header" id="inlineRadio1" value="5V ARGB" checked="">
                                            <label class="form-check-label" for="inlineRadio1">5V ARGB</label>
                                        </div>
                                    @else
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rgb_header" id="inlineRadio1" value="12V RGB">
                                            <label class="form-check-label" for="inlineRadio1">12V RGB</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rgb_header" id="inlineRadio1" value="5V ARGB">
                                            <label class="form-check-label" for="inlineRadio1">5V ARGB</label>
                                        </div>
                                    @endif

                                    <br>

                                    @if($errors->has('rgb_header'))
                                        <small><i style="color: red;">*{{ $errors->first('rgb_header') }}</i></small>
                                    @endif
                                </div>
                            </div>
                            <div class="col"><label style="color: rgb(0,0,0);">Description:</label>
                                <div class="form-group"><input class="form-control" type="text" placeholder="Type here..."name="motherboard_description" value="{{old('motherboard_description')}}"></div>
                            </div>
                       
                            <div class="form-group" style="margin-top: 0px;padding: 0px;padding-top: 82px;text-align: center;"><button type="submit" class="btn btn-primary text-center" type="button" style="text-align: right;background: rgb(0,103,76);">SUBMIT</button></div>
                        </form>
                   </div>
                      {{-- END --}}
                    </div>
                </div>
                        <footer class="bg-white sticky-footer">
                            <div class="container my-auto">
                                <div class="text-center my-auto copyright"><span>Copyright © Brand 2021</span></div>
                            </div>
                        </footer>
            </div>
         
        </div>

        <a class="border rounded d-inline scroll-to-top" href="{{ route('motherboard.index') }}"><i class="fas fa-arrow-left"></i></a>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/Custom-File-Upload.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/theme.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>

</html>