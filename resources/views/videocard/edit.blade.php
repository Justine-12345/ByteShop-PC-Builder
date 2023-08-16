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
                        <h3 class="text-dark mb-0">Edit Video Card</h3>
                    </div>
                    <div style="background: rgb(230,247,236);padding: 11px;">
                        <h1 style="font-size: 23px;">Basic Info</h1>
            {{-- START --}}
                        {{Form::model($item,array('route'=>array('videocard.update',$item->videocard_id), 'enctype' => 'multipart/form-data'))}}
                        {{method_field('PUT')}}
                        @csrf
                            <div class="form-row">
                                 <div class="col"><label style="color: rgb(0,0,0);">Brand:</label>
                                    <div class="form-group">                                         <select class="form-control" name="brand_id">
                                            <optgroup label="Brand Names">

                                                <option value="">Select Brand</option>

                                                  @foreach($brands as $Bkey => $Bval)

                                                    @if( $item->item->brand_id == $Bkey)
                                                        <option value="{{ $Bkey }}" selected="">{{    $Bval }}</option>
                                                    @else
                                                        <option value="{{$Bkey }}">{{ $Bval}}</option>
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
                                        <input class="form-control" type="text" name="title" value="{{old('title')?old('title'):$item->item->title}}">

                                        @if($errors->has('title'))
                                            <small><i style="color: red;">*{{ $errors->first('title') }}</i></small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                           <div class="form-row">
                                <div class="col"><label style="color: rgb(0,0,0);">Stock:&nbsp;</label>

                                    <div class="form-group"><input class="form-control" type="number" min="1" max="1000000" step="1" placeholder="No. of Stocks" name="quantity" value="{{old('quantity')?old('quantity'):$item->quantity}}">
                                        @if($errors->has('quantity'))
                                        <small><i style="color: red">*{{$errors->first('quantity')}}</i></small>
                                        @endif
                                    </div>
                                </div>
                               <div class="col"><label style="color: rgb(0,0,0);">Price:</label>
                                    <div class="form-group">
                                        <input class="form-control" type="number" name="price" value="{{old('price')?old('price'):$item->item->price}}" step="1" min="1" max="1000000">

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
                            <div class="form-row">
                                <div class="col">
                                {{Form::label('GPU Brand:',null,['style'=>'color: rgb(0,0,0)'])}}<br>
                                </div>
                                    {{Form::select('gpu_brand',['NVIDIA' => 'NVIDIA','AMD' => 'AMD'],null,['class'=>'form-control'])}}
                                    @if($errors->has('gpu_brand'))
                                        <small><i style="color: red">*{{$errors->first('gpu_brand')}}</i></small>
                                        @endif
                            </div>
                            <div class="form-row">
                                <div class="col">
                                {{Form::label('Core Count:',null,['style'=>'color: rgb(0,0,0)'])}}<br>
                                </div>
                                    {{Form::number('core_count',null,['class'=>'form-control'])}}
                                    @if($errors->has('core_count'))
                                        <small><i style="color: red">*{{$errors->first('core_count')}}</i></small>
                                        @endif
                            </div>
                            <div class="form-row">
                                <div class="col">
                                {{Form::label('Clock Speed (MHz):',null,['style'=>'color: rgb(0,0,0)'])}}<br>
                                </div>
                                    {{Form::number('clock_speed',null,['class'=>'form-control'])}}
                                    @if($errors->has('clock_speed'))
                                        <small><i style="color: red">*{{$errors->first('clock_speed')}}</i></small>
                                        @endif
                            </div>
                            <div class="form-row">
                                <div class="col">
                                {{Form::label('Memory Type:',null,['style'=>'color: rgb(0,0,0)'])}}<br>
                                </div>
                                    {{Form::select('memory_type',['DDR' => 'DDR','DDR2' => 'DDR2','DDR3' => 'DDR3','DDR4' => 'DDR4','GDDR4' => 'GDDR4','GDDR5' => 'GDDR5','GDDR5X' => 'GDDR5X','GDDR6' => 'GDDR6','HBM' => 'HBM'],null,['class'=>'form-control'])}}
                                    @if($errors->has('memory_type'))
                                        <small><i style="color: red">*{{$errors->first('memory_type')}}</i></small>
                                        @endif
                            </div>
                            <div class="form-row">
                                <div class="col">
                                {{Form::label('Memory Size:',null,['style'=>'color: rgb(0,0,0)'])}}<br>
                                </div>
                                    {{Form::select('memory_size',['2' => '2 GB','4' => '4 GB','8' => '8 GB','16' => '16 GB','32' => '32 GB'],null,['class'=>'form-control'])}}
                                    @if($errors->has('memory_size'))
                                        <small><i style="color: red">*{{$errors->first('memory_size')}}</i></small>
                                        @endif
                            </div>
                            <div class="form-row">
                                <div class="col">
                                {{Form::label('Memory Bandwidth (bit):',null,['style'=>'color: rgb(0,0,0)'])}}<br>
                                </div>
                                    {{Form::number('memory_bandwidth',null,['class'=>'form-control'])}}
                                    @if($errors->has('memory_bandwidth'))
                                        <small><i style="color: red">*{{$errors->first('memory_bandwidth')}}</i></small>
                                        @endif
                            </div>
                            <div class="form-row">
                                <div class="col">
                                {{Form::label('Thermal Design Power (Watts):',null,['style'=>'color: rgb(0,0,0)'])}}<br>
                                </div>
                                    {{Form::number('thermal_designpower',null,['class'=>'form-control'])}}
                                    @if($errors->has('thermal_designpower'))
                                        <small><i style="color: red">*{{$errors->first('thermal_designpower')}}</i></small>
                                        @endif
                            </div>
                            <div class="form-row">
                                <div class="col">
                                {{Form::label('Power Connectors:',null,['style'=>'color: rgb(0,0,0)'])}}<br>
                                </div>
                                    {{Form::select('power_connectors',['6-pin' => '6-pin','8-pin' => '8-pin','12' => '12-pin'],null,['class'=>'form-control'])}}
                                    @if($errors->has('power_connectors'))
                                        <small><i style="color: red">*{{$errors->first('power_connectors')}}</i></small>
                                        @endif
                            </div>
                            <div class="form-row">
                                <div class="col">
                                {{Form::label('Video Output Ports:',null,['style'=>'color: rgb(0,0,0)'])}}<br>
                                </div>
                                    {{Form::select('video_outputports',['HDMI' => 'HDMI','VGA' => 'VGA','Display Port' => 'Display Port','USB Type-C' => 'USB Type-C','DVI' => 'DVI'],null,['class'=>'form-control'])}}
                                    @if($errors->has('video_outputports'))
                                        <small><i style="color: red">*{{$errors->first('video_outputports')}}</i></small>
                                        @endif
                            </div>
                            <div class="form-row">
                                <div class="col">
                                {{Form::label('API Support:',null,['style'=>'color: rgb(0,0,0)'])}}<br>
                                </div>
                                    {{Form::select('api_support',['DirectX' => 'DirectX','OpenGL' => 'OpenGL','Vulkan' => 'Vulkan'],null,['class'=>'form-control'])}}
                                    @if($errors->has('api_support'))
                                        <small><i style="color: red">*{{$errors->first('api_support')}}</i></small>
                                        @endif
                            </div>
                            <div class="form-row">
                                <div class="col">
                                {{Form::label('Computer Performance:',null,['style'=>'color: rgb(0,0,0)'])}}<br>
                                </div>
                                    {{Form::text('computer_performance',null,['class'=>'form-control'])}}
                                    @if($errors->has('computer_performance'))
                                        <small><i style="color: red">*{{$errors->first('computer_performance')}}</i></small>
                                        @endif
                            </div>
                            <div class="form-row">
                                <div class="col">
                                {{Form::label('GPU Wattage:',null,['style'=>'color: rgb(0,0,0)'])}}<br>
                                </div>
                                    {{Form::number('gpu_wattage',null,['class'=>'form-control'])}}
                                    @if($errors->has('gpu_wattage'))
                                        <small><i style="color: red">*{{$errors->first('gpu_wattage')}}</i></small>
                                        @endif
                            </div>
                            <div class="form-row">
                                <div class="col">
                                {{Form::label('GPU Score:',null,['style'=>'color: rgb(0,0,0)'])}}<br>
                                </div>
                                    {{Form::number('gpu_score',null,['class'=>'form-control'])}}
                                    @if($errors->has('gpu_score'))
                                        <small><i style="color: red">*{{$errors->first('gpu_score')}}</i></small>
                                        @endif
                            </div>
                            <div class="form-row">
                                <div class="col">
                                {{Form::label('GPU Description:',null,['style'=>'color: rgb(0,0,0)'])}}<br>
                                </div>
                                    {{Form::text('gpu_description',null,['class'=>'form-control'])}}
                                    @if($errors->has('gpu_description'))
                                        <small><i style="color: red">*{{$errors->first('gpu_description')}}</i></small>
                                        @endif
                            </div>

                              <div class="form-group" style="margin-top: 0px;padding: 0px;padding-top: 82px;text-align: center;"><button type="submit" class="btn btn-primary text-center" type="button" style="text-align: right;background: rgb(0,103,76);">UPDATE</button></div>
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
        </div><a class="border rounded d-inline scroll-to-top" href="{{route('videocard.index')}}"><i class="fas fa-arrow-left"></i></a>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/Custom-File-Upload.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/theme.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>

</html>