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
                        <h3 class="text-dark mb-0"></h3>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-xl-12 offset-xl-0">
                            <div class="card shadow mb-4">
                                <div class="col text-center"><img style="color: rgb(133, 135, 150);border-radius: 150px;width: 200px;height: 200px;border: 10px solid #031131 ;" src="{{asset('src/images/products/'.$videocards->image)}}"></div>
                                <div class="col">
                                    <h1 class="text-center" style="color: rgb(0,0,0);margin-top: 10px;">{{$videocards->title}}</h1>
                                </div>
                                <div class="col">
                                    <div class="table-responsive" style="text-align: center;color: rgb(0,0,0);">
                                        <table class="table">
                                            <thead style="background: #031131;color: rgb(248,249,255);">
                                                <tr>
                                                    <th style="color: rgb(255,255,255);">Category</th>
                                                    <th style="color: rgb(255,255,255);">Specifications</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="color: rgb(0,0,0);">Brand</td>
                                                    <td style="color: rgb(0,0,0);">{{$videocards->brand_name}}</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: rgb(0,0,0);">GPU Brand</td>
                                                    <td style="color: rgb(0,0,0);">{{$videocards->gpu_brand}}</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: rgb(0,0,0);">Core Count</td>
                                                    <td style="color: rgb(0,0,0);">{{$videocards->core_count}}</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: rgb(0,0,0);">Clock Speed</td>
                                                    <td style="color: rgb(0,0,0);">{{$videocards->clock_speed}} MHz</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: rgb(0,0,0);">Memory Type</td>
                                                    <td style="color: rgb(0,0,0);">{{$videocards->memory_type}}</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: rgb(0,0,0);">Memory Size</td>
                                                    <td style="color: rgb(0,0,0);">{{$videocards->memory_size}} GB</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: rgb(0,0,0);">Memory Bandwidth</td>
                                                    <td style="color: rgb(0,0,0);">{{$videocards->memory_bandwidth}}-bit</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: rgb(0,0,0);">Thermal Design Power</td>
                                                    <td style="color: rgb(0,0,0);">{{$videocards->thermal_designpower}} Watts</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: rgb(0,0,0);">Power Connectors</td>
                                                    <td style="color: rgb(0,0,0);">{{$videocards->power_connectors}}</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: rgb(0,0,0);">Video Output Ports</td>
                                                    <td style="color: rgb(0,0,0);">{{$videocards->video_outputports}}</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: rgb(0,0,0);">API Support</td>
                                                    <td style="color: rgb(0,0,0);">{{$videocards->api_support}}</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: rgb(0,0,0);">Computer Performance</td>
                                                    <td style="color: rgb(0,0,0);">{{$videocards->computer_performance}}</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: rgb(0,0,0);">GPU Wattage</td>
                                                    <td style="color: rgb(0,0,0);">{{$videocards->gpu_wattage}} Watts</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: rgb(0,0,0);">GPU Score</td>
                                                    <td style="color: rgb(0,0,0);">{{$videocards->gpu_score}}</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: rgb(0,0,0);">GPU Description</td>
                                                    <td style="color: rgb(0,0,0);">{{$videocards->gpu_description}}</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: rgb(0,0,0);">Price</td>
                                                    <td style="color: rgb(0,0,0);">₱ {{ number_format($videocards->price, 2, '.', ',') }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: rgb(0,0,0);">Stocks</td>
                                                    <td style="color: rgb(0,0,0);">{{$videocards->quantity}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/theme.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>

</html>