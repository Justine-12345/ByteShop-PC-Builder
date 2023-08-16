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
                                <div class="col text-center"><img style="color: rgb(133, 135, 150);border-radius: 150px;width: 200px;height: 200px;border: 10px solid #031131 ;" src="{{asset('src/images/products/'.$powersupply->image)}}"></div>
                                <div class="col">
                                    <h1 class="text-center" style="color: rgb(0,0,0);margin-top: 10px;">{{ucwords($powersupply->title)}}</h1>
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
                                                    <td style="color: rgb(0,0,0);">{{$powersupply->brand_name}}</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: rgb(0,0,0);">Price</td>
                                                    <td style="color: rgb(0,0,0);">₱ {{ number_format($powersupply->price, 2, '.', ',') }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: rgb(0,0,0);">Stock</td>
                                                    <td style="color: rgb(0,0,0);">{{$powersupply->quantity}}</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: rgb(0,0,0);">Form Factor</td>
                                                    <td style="color: rgb(0,0,0);">{{$powersupply->form_factor}}</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: rgb(0,0,0);">Wattage</td>
                                                    <td style="color: rgb(0,0,0);">{{$powersupply->wattage}} watts</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: rgb(0,0,0);">Efficiency Rating</td>
                                                    <td style="color: rgb(0,0,0);">{{$powersupply->efficiency_rating}}</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: rgb(0,0,0);">Rails</td>
                                                    <td style="color: rgb(0,0,0);">{{$powersupply->rails}}</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: rgb(0,0,0);">Protection</td>
                                                    <td style="color: rgb(0,0,0);">
                                                      @php 
                                                      $n = count($protection)-1; 
                                                      @endphp
                                                      @foreach($protection as $k => $p)
                                                       @php
                                                       if ($k == $n) {
                                                         break;
                                                       }
                                                       @endphp
                                                        - {{$p}}<br>
                                                      @endforeach
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="color: rgb(0,0,0);">Modularity</td>
                                                    <td style="color: rgb(0,0,0);">{{$powersupply->modularity}}</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: rgb(0,0,0);">Variable_rpmfan</td>
                                                    <td style="color: rgb(0,0,0);">{{$powersupply->variable_rpmfan}}</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: rgb(0,0,0);">Fan Size</td>
                                                    <td style="color: rgb(0,0,0);">{{$powersupply->fan_size}} mm</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: rgb(0,0,0);">Description</td>
                                                    <td style="color: rgb(0,0,0);">{{$powersupply->powersupplies_description}}</td>
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