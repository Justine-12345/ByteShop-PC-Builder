@php
use App\Converter;
@endphp
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
                        <h3 class="text-dark mb-0">Add Solid State Drive</h3>
                    </div>
                    <div style="background: rgb(230,247,236);padding: 11px;">
                        <h1 style="font-size: 23px;">Basic Info</h1>
                        <form action="{{route('soliddrive.store')}}" method="post" enctype="multipart/form-data">
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
                            <div class="col"><label style="color: rgb(0,0,0);">Form Factor</label>
                                <div class="form-group"><select name="form_factor" class="form-control" >
                                    @if(old('form_factor'))
                                    <option value="{{old('form_factor')}}" selected>{{old('form_factor')}}</option>
                                    @endif
                                    <option value="">Select Form Factor</option>
                                    <option value="2.5' SSD Drive"> 2.5' SSD Drive</option>
                                    <option value="M.2 Drive"> M.2 Drive </option>
                                    <option value="Portable SSD">  Portable SSD </option>
                                 </select>
                                   @if($errors->has('form_factor'))
                                            <small><i style="color: red;">*{{ $errors->first('form_factor') }}</i></small>
                                        @endif</div>
                            </div>


                            <div class="col"><label style="color: rgb(0,0,0);">Interface</label>
                                <div class="form-group">
                                  <select name="interface" class="form-control" >
                                    @if(old('interface'))
                                    <option value="{{old('interface')}}" selected>{{old('interface')}}</option>
                                    @endif
                                    <option value="">Select Interface</option>
                                    <option value="Serial ATA (SATA)"> Serial ATA (SATA)</option>
                                    <option value="PCI Express® (PCIe®)"> PCI Express® (PCIe®) </option>
                                    <option value="Serial Attached SCSI (SAS)">  Serial Attached SCSI (SAS) </option>
                                 </select>
                                   @if($errors->has('interface'))
                                            <small><i style="color: red;">*{{ $errors->first('interface') }}</i></small>
                                        @endif
                                </div>
                            </div>



                            <div class="col"><label style="color: rgb(0,0,0);">Read Speed (MB per second)</label>
                                 <div class="form-group">
                                        <input class="form-control" type="number" min="1" name="read_speed" value="{{old('read_speed')}}">

                                        @if($errors->has('read_speed'))
                                            <small><i style="color: red;">*{{ $errors->first('read_speed') }}</i></small>
                                        @endif
                                    </div>
                            </div>
                            <div class="col"><label style="color: rgb(0,0,0);">Write Speed (MB per second)</label>
                                <div class="form-group">
                                        <input class="form-control" type="number" min="1" name="  write_speed" value="{{old('write_speed')}}">

                                        @if($errors->has('  write_speed'))
                                            <small><i style="color: red;">*{{ $errors->first(' write_speed') }}</i></small>
                                        @endif
                                    </div>
                            </div>


                            <div class="col"><label style="color: rgb(0,0,0);">Endurance Rating (TBW - Terabytes Written)</label>
                                <div class="form-group">
                                        <input class="form-control" type="number" min="1" name="  endurance_rating" value="{{old('endurance_rating')}}">

                                        @if($errors->has('endurance_rating'))
                                            <small><i style="color: red;">*{{ $errors->first('  endurance_rating') }}</i></small>
                                        @endif
                                    </div>
                            </div>
                            <div class="col"><label style="color: rgb(0,0,0);">Input/Output Operations Per Second (IOPS)</label>
                                  <div class="form-group">
                                        <input class="form-control" type="number" min="1" name="iops" value="{{old('iops')}}">

                                        @if($errors->has('iops'))
                                            <small><i style="color: red;">*{{ $errors->first('iops') }}</i></small>
                                        @endif
                                    </div>
                            </div>
                            <div class="col"><label style="color: rgb(0,0,0);">Capacity</label>
                                <div class="form-group">
                        
                                     <select name="capacity" class="form-control" >
                                      @if(old('capacity'))
                                      <option value="{{old('capacity')}}">{{Converter::translateS(old('capacity'))}}</option>
                                      @endif
                                    <option value="">Select Capacity</option>
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
                            <div class="col"><label style="color: rgb(0,0,0);">Cell Type</label>
                                 <div class="form-group">
                                     <select name="cell_type" class="form-control" >
                                    @if(old('cell_type'))
                                    <option value="{{old('cell_type')}}"> {{old('cell_type')}} </option>
                                    @endif
                                    <option value="">Select Cell type</option>
                                    <option value="Single Level Cell (SLC)"> Single Level Cell (SLC) </option>
                                    <option value=" Multi-Level Cell (MLC/eMLC)"> Multi-Level Cell (MLC/eMLC) </option>
                                    <option value="Triple Level Cell (TLC)"> Triple Level Cell (TLC) </option>
                                    <option value="Quad and Penta Level Cell (QLC/PLC)">Quad and Penta Level Cell (QLC/PLC)</option>
                                    <option value="3D NAND Flash"> 3D NAND Flash </option>
                                       </select>
                                    @if($errors->has('cell_type'))
                                        <small><i style="color: red;">*{{ $errors->first('cell_type') }}</i></small>
                                    @endif
                                </div>
                            </div>
                            <div class="col"><label style="color: rgb(0,0,0);">Solid Drive Description</label>
                                <div class="form-group">
                                        <input class="form-control" type="text" name="soliddrive_description" value="{{old('soliddrive_description')}}">

                                        @if($errors->has('soliddrive_description'))
                                            <small><i style="color: red;">*{{ $errors->first('  soliddrive_description') }}</i></small>
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