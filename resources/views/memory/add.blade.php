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
                        <h3 class="text-dark mb-0">Add Memory</h3>
                    </div>
                    <div style="background: rgb(230,247,236);padding: 11px;">
                        <h1 style="font-size: 23px;">Basic Info</h1>
            {{-- START --}}
                        {{Form::open(['url' => route('memory.store'), 'enctype' => 'multipart/form-data'])}}
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
                                    <div class="form-group"><input class="form-control" type="text" name="title">
                                        @if($errors->has('title'))
                                        <small><i style="color: red">*{{$errors->first('title')}}</i></small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col"><label style="color: rgb(0,0,0);">Stock:&nbsp;</label>
                                    <div class="form-group"><input class="form-control" type="number" min="1" max="1000000" step="1" placeholder="No. of Stocks" name="quantity">
                                        @if($errors->has('quantity'))
                                        <small><i style="color: red">*{{$errors->first('quantity')}}</i></small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col"><label style="color: rgb(0,0,0);">Price:</label>
                                    <div class="form-group"><input class="form-control" type="number" name="price">
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
                                {{Form::label('Memory Size (GB):',null,['style'=>'color: rgb(0,0,0)'])}}<br>
                                </div>
                                    {{Form::number('memory_size',null,['class'=>'form-control'])}}
                                @if($errors->has('memory_size'))
                                        <small><i style="color: red">*{{$errors->first('memory_size')}}</i></small>
                                        @endif
                            </div>
                            <div class="form-row">
                                <div class="col">
                                {{Form::label('Memory Type:',null,['style'=>'color: rgb(0,0,0)'])}}<br>
                                </div>
                                    {{Form::select('memory_type',['SDRAM' => 'SDRAM','DDR1' => 'DDR1', 'DDR2' => 'DDR2', 'DDR3' => 'DDR3', 'DDR4' => 'DDR4', ],null,['class'=>'form-control'])}}
                                @if($errors->has('memory_type'))
                                        <small><i style="color: red">*{{$errors->first('memory_type')}}</i></small>
                                        @endif
                            </div>
                            <div class="form-row">
                                <div class="col">
                                {{Form::label('Frequency (MHz):',null,['style'=>'color: rgb(0,0,0)'])}}<br>
                                </div>
                                    {{Form::number('frequency',null,['class'=>'form-control'])}}
                                @if($errors->has('frequency'))
                                        <small><i style="color: red">*{{$errors->first('frequency')}}</i></small>
                                        @endif
                            </div>
                            <div class="form-row">
                                <div class="col">
                                {{Form::label('CAS Latency:',null,['style'=>'color: rgb(0,0,0)'])}}<br>
                                </div>
                                    {{Form::number('cas_latency',null,['class'=>'form-control'])}}
                                @if($errors->has('cas_latency'))
                                        <small><i style="color: red">*{{$errors->first('cas_latency')}}</i></small>
                                        @endif
                            </div>
                            <div class="form-row">
                                <div class="col">
                                {{Form::label('Memory Bandwidth (MB/s):',null,['style'=>'color: rgb(0,0,0)'])}}<br>
                                </div>
                                    {{Form::number('memory_bandwidth',null,['class'=>'form-control'])}}
                                @if($errors->has('memory_bandwidth'))
                                        <small><i style="color: red">*{{$errors->first('memory_bandwidth')}}</i></small>
                                        @endif
                            </div>
                            <div class="form-row">
                                <div class="col">
                                {{Form::label('Overclocking Support:',null,['style'=>'color: rgb(0,0,0)'])}}<br>
                                </div>
                                    {{Form::text('overclocking_support',null,['class'=>'form-control'])}}
                                @if($errors->has('overclocking_support'))
                                        <small><i style="color: red">*{{$errors->first('overclocking_support')}}</i></small>
                                        @endif
                            </div>
                            <div class="form-row">
                                <div class="col">
                                {{Form::label('Heat Spreader:',null,['style'=>'color: rgb(0,0,0)'])}}<br>
                                </div>
                                    {{Form::text('heat_spreader',null,['class'=>'form-control'])}}
                                @if($errors->has('heat_spreader'))
                                        <small><i style="color: red">*{{$errors->first('heat_spreader')}}</i></small>
                                        @endif
                            </div>
                            <div class="form-row">
                                <div class="col">
                                {{Form::label('RGB Support:',null,['style'=>'color: rgb(0,0,0)'])}}<br>
                                </div>
                                    {{Form::text('rgb_support',null,['class'=>'form-control'])}}
                                @if($errors->has('rgb_support'))
                                        <small><i style="color: red">*{{$errors->first('rgb_support')}}</i></small>
                                        @endif
                            </div>
                            <div class="form-row">
                                <div class="col">
                                {{Form::label('Memory Description:',null,['style'=>'color: rgb(0,0,0)'])}}<br>
                                </div>
                                    {{Form::text('memory_description',null,['class'=>'form-control'])}}
                                @if($errors->has('memory_description'))
                                        <small><i style="color: red">*{{$errors->first('memory_description')}}</i></small>
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
        </div><a class="border rounded d-inline scroll-to-top" href="{{route('memory.index')}}"><i class="fas fa-arrow-left"></i></a>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/Custom-File-Upload.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/theme.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>

</html>