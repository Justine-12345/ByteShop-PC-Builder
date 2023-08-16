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
                        <h3 class="text-dark mb-0">Add Monitor</h3>
                    </div>
                    <div style="background: rgb(230,247,236);padding: 11px;">
                        <h1 style="font-size: 23px;">Basic Info</h1>
            {{-- START --}}
                        {{Form::open(['url' => route('monitor.store'), 'enctype' => 'multipart/form-data'])}}
                        @csrf
                            <div class="form-row">
                                <div class="col"><label style="color: rgb(0,0,0);">Brand:</label>
                                    <div class="form-group">
                                        {{Form::select('brand_id',$brands,null,['class'=>'form-control'])}}
                                        @if($errors->has('brand_id'))
                                        <small><i style="color: red">*{{$errors->first('brand_id')}}</i></small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col"><label style="color: rgb(0,0,0);">Title:</label>
                                    <div class="form-group">
                                        {{Form::text('title',null,['class'=>'form-control'])}}
                                        @if($errors->has('title'))
                                        <small><i style="color: red">*{{$errors->first('title')}}</i></small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col"><label style="color: rgb(0,0,0);">Stock:&nbsp;</label>
                                    <div class="form-group">
                                        {{Form::number('quantity',null,['class'=>'form-control','min'=>1,'placeholder'=>"No. of Stocks"])}}
                                        @if($errors->has('quantity'))
                                        <small><i style="color: red">*{{$errors->first('quantity')}}</i></small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col"><label style="color: rgb(0,0,0);">Price:</label>
                                    <div class="form-group">
                                        {{Form::number('price',null,['class'=>'form-control','min'=>1])}}
                                        @if($errors->has('price'))
                                        <small><i style="color: red">*{{$errors->first('price')}}</i></small>
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
                                 <div class="form-row">
                                <div class="col">
                                {{Form::label('Monitor Resolution:',null,['style'=>'color: rgb(0,0,0)'])}}<br>
                                </div>
                                    {{Form::select('monitor_resolution',['1280 × 720'=>'1280 × 720','1366 × 768'=>'1366 × 768','1440 × 900'=>'1440 × 900', '1920 × 1080 - FHD - 1080p'=>'1920 × 1080 - FHD - 1080p', '2560 × 1080'=>'2560 × 1080', '2560 × 1440 - QHD - 1440p - 2K'=>'2560 × 1440 - QHD - 1440p - 2K', '3440 × 1440'=>'3440 × 1440', '3840 × 2160 - UHD - 4K' => '3840 × 2160 - UHD - 4K'],null,['class'=>'form-control'])}}
                                    @if($errors->has('monitor_resolution'))
                                        <small><i style="color: red">*{{$errors->first('monitor_resolution')}}</i></small>
                                        @endif
                            </div>

                            <div class="form-row">
                                <div class="col">
                                {{Form::label('Monitor Size (inch):',null,['style'=>'color: rgb(0,0,0)'])}}<br>
                                </div>
                                    {{Form::text('monitor_size',null,['class'=>'form-control'])}}
                                    @if($errors->has('monitor_size'))
                                        <small><i style="color: red">*{{$errors->first('monitor_size')}}</i></small>
                                        @endif
                            </div>
                            <div class="form-row">
                                <div class="col">
                                {{Form::label('Monitor Aspect:',null,['style'=>'color: rgb(0,0,0)'])}}<br>
                                </div>
                                    {{Form::select('monitor_aspect',['4:3'=>'4:3','16:9'=>'16:9','21:9'=>'21:9'],null,['class'=>'form-control'])}}
                                    @if($errors->has('monitor_aspect'))
                                        <small><i style="color: red">*{{$errors->first('monitor_aspect')}}</i></small>
                                        @endif
                            </div>
                            <div class="form-row">
                                <div class="col">
                                {{Form::label('Panel Type:',null,['style'=>'color: rgb(0,0,0)'])}}<br>
                                </div>
                                    {{Form::select('panel_type',['TN'=>'TN','VA'=>'VA','OLED'=>'OLED','IPS'=>'IPS'],null,['class'=>'form-control'])}}
                                    @if($errors->has('panel_type'))
                                        <small><i style="color: red">*{{$errors->first('panel_type')}}</i></small>
                                        @endif
                            </div>
                            <div class="form-row">
                                <div class="col">
                                {{Form::label('Refresh Rate (Hz):',null,['style'=>'color: rgb(0,0,0)'])}}<br>
                                </div>
                                    {{Form::number('refresh_rate',null,['class'=>'form-control'])}}
                                    @if($errors->has('refresh_rate'))
                                        <small><i style="color: red">*{{$errors->first('refresh_rate')}}</i></small>
                                        @endif
                            </div>
                            <div class="form-row">
                                <div class="col">
                                {{Form::label('Response Time (ms):',null,['style'=>'color: rgb(0,0,0)'])}}<br>
                                </div>
                                    {{Form::number('response_time',null,['class'=>'form-control'])}}
                                    @if($errors->has('response_time'))
                                        <small><i style="color: red">*{{$errors->first('response_time')}}</i></small>
                                        @endif
                            </div>
                            <div class="form-row">
                                <div class="col">
                                {{Form::label('Synchronization Technology:',null,['style'=>'color: rgb(0,0,0)'])}}<br>
                                </div>
                                    {{Form::select('synchronisation_technology',['NVIDIA G-Sync'=>'NVIDIA G-Sync','AMD FreeSync'=>'AMD FreeSync'],null,['class'=>'form-control'])}}
                                    @if($errors->has('synchronisation_technology'))
                                        <small><i style="color: red">*{{$errors->first('synchronisation_technology')}}</i></small>
                                        @endif
                            </div>
                            <div class="form-row">
                                <div class="col">
                                {{Form::label('Viewing Angle (degrees):',null,['style'=>'color: rgb(0,0,0)'])}}<br>
                                </div>
                                    {{Form::number('viewing_angle',null,['class'=>'form-control'])}}
                                    @if($errors->has('viewing_angle'))
                                        <small><i style="color: red">*{{$errors->first('viewing_angle')}}</i></small>
                                        @endif
                            </div>
                            <div class="form-row">
                                <div class="col">
                                {{Form::label('Input Connectors:',null,['style'=>'color: rgb(0,0,0)'])}}<br>
                                </div>
                                    {{Form::select('input_connectors',['HDMI' => 'HDMI','DisplayPort and Mini DisplayPort' => 'DisplayPort and Mini DisplayPort','USB-C' => 'USB-C','Thunderbolt' => 'Thunderbolt','VGA' => 'VGA','DVI' => 'DVI'],null,['class'=>'form-control'])}}
                                    @if($errors->has('input_connectors'))
                                        <small><i style="color: red">*{{$errors->first('input_connectors')}}</i></small>
                                        @endif
                            </div>
                            <div class="form-row">
                                <div class="col">
                                {{Form::label('Monitor Curvature:',null,['style'=>'color: rgb(0,0,0)'])}}<br>
                                </div>
                                    {{Form::number('monitor_curvature',null,['class'=>'form-control'])}}
                                    @if($errors->has('monitor_curvature'))
                                        <small><i style="color: red">*{{$errors->first('monitor_curvature')}}</i></small>
                                        @endif
                            </div>
                            <div class="form-row">
                                <div class="col">
                                {{Form::label('Monitor Brightness:',null,['style'=>'color: rgb(0,0,0)'])}}<br>
                                </div>
                                    {{Form::number('monitor_brightness',null,['class'=>'form-control'])}}
                                    @if($errors->has('monitor_brightness'))
                                        <small><i style="color: red">*{{$errors->first('monitor_brightness')}}</i></small>
                                        @endif
                            </div>
                            <div class="form-row">
                                <div class="col">
                                {{Form::label('Monitor HDR:',null,['style'=>'color: rgb(0,0,0)'])}}<br>
                                </div>
                                    {{Form::select('monitor_hdr',['400'=>'DisplayHDR 400','500'=>'DisplayHDR 500','600'=>'DisplayHDR 600','1000'=>'DisplayHDR 1000','1400'=>'DisplayHDR 1400'],null,['class'=>'form-control'])}}
                                    @if($errors->has('monitor_hdr'))
                                        <small><i style="color: red">*{{$errors->first('monitor_hdr')}}</i></small>
                                        @endif
                            </div>
                            <div class="form-row">
                                <div class="col">
                                {{Form::label('Monitor Contrast:',null,['style'=>'color: rgb(0,0,0)'])}}<br>
                                </div>
                                    {{Form::number('monitor_contrast',null,['class'=>'form-control'])}}
                                    @if($errors->has('monitor_contrast'))
                                        <small><i style="color: red">*{{$errors->first('monitor_contrast')}}</i></small>
                                        @endif
                            </div>
                            <div class="form-row">
                                <div class="col">
                                {{Form::label('Monitor Color Space:',null,['style'=>'color: rgb(0,0,0)'])}}<br>
                                </div>
                                    {{Form::select('monitor_colorspace',['aRGB'=>'Adobe RGB','sRGB'=>'sRGB'],null,['class'=>'form-control'])}}
                                    @if($errors->has('monitor_colorspace'))
                                        <small><i style="color: red">*{{$errors->first('monitor_colorspace')}}</i></small>
                                        @endif
                            </div>
                            <div class="form-row">
                                <div class="col">
                                {{Form::label('Monitor Description:',null,['style'=>'color: rgb(0,0,0)'])}}<br>
                                </div>
                                    {{Form::text('monitor_description',null,['class'=>'form-control'])}}
                                    @if($errors->has('monitor_description'))
                                        <small><i style="color: red">*{{$errors->first('monitor_description')}}</i></small>
                                        @endif
                            </div>

                              <div class="form-group" style="margin-top: 0px;padding: 0px;padding-top: 82px;text-align: center;"><button type="submit" class="btn btn-primary text-center" type="button" style="text-align: right;background: rgb(0,103,76);">SUBMIT</button></div>
                        {{Form::close()}}
                      {{-- END --}}
                    </div>
                </div>
            </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © Brand 2021</span></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="{{route('monitor.index')}}"><i class="fas fa-arrow-left"></i></a>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/Custom-File-Upload.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/theme.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>

</html>