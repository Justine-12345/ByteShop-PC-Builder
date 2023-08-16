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
                                <div class="col text-center"><img style="color: rgb(133, 135, 150);border-radius: 150px;width: 200px;height: 200px;border: 10px solid #031131 ;" src="{{asset('src/images/products/'.$printers[0]->image)}}"></div>
                                <div class="col">
                                    <h1 class="text-center" style="color: rgb(0,0,0);margin-top: 10px;">{{ $printers[0]->title }}</h1>
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
                                                    <td style="color: rgb(0,0,0);">{{ $printers[0]->brand_name }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: rgb(0,0,0);">Category</td>
                                                    <td style="color: rgb(0,0,0);">{{ $printers[0]->category_name }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: rgb(0,0,0);">Printer Type</td>
                                                    <td style="color: rgb(0,0,0);">{{ $printers[0]->printer_type }}</td>
                                                </tr>
                                                    <tr>
                                                    <td style="color: rgb(0,0,0);">Ink Type</td>
                                                    <td style="color: rgb(0,0,0);">{{ $printers[0]->ink_type }}</td>
                                                </tr>
                                                    <tr>
                                                    <td style="color: rgb(0,0,0);">All in One</td>
                                                    <td style="color: rgb(0,0,0);">{{ $printers[0]->all_inOne }}</td>
                                                </tr>
                                                    <tr>
                                                    <td style="color: rgb(0,0,0);">Printer Speed</td>
                                                    <td style="color: rgb(0,0,0);">{{ $printers[0]->print_speed }} ppm</td>
                                                </tr>
                                                    <tr>
                                                    <td style="color: rgb(0,0,0);">Duplex Support</td>
                                                    <td style="color: rgb(0,0,0);">{{ $printers[0]->duplex_support }}</td>
                                                </tr>
                                                    <tr>
                                                    <td style="color: rgb(0,0,0);">Feed</td>
                                                    <td style="color: rgb(0,0,0);">{{ $printers[0]->automatic_feed }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: rgb(0,0,0);">DPI</td>
                                                    <td style="color: rgb(0,0,0);">{{ $printers[0]->dpi }} DPI</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: rgb(0,0,0);">Paper Capacity</td>
                                                    <td style="color: rgb(0,0,0);">{{ $printers[0]->paper_capacity }} sheets</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: rgb(0,0,0);">Duty Cycle</td>
                                                    <td style="color: rgb(0,0,0);">{{ $printers[0]->duty_cycle }} sheets</td>
                                                </tr> 

                                                 <tr>
                                                    <td style="color: rgb(0,0,0);">Catridge Capacity</td>
                                                    <td style="color: rgb(0,0,0);">{{ $printers[0]->catridge_capacity}} pages</td>
                                                </tr>
                                                 <tr>
                                                    <td style="color: rgb(0,0,0);">Connectivity</td>
                                                    <td style="color: rgb(0,0,0);"> @foreach($connection_interface as $connection)
                                                            @if($connection != " ")
                                                             @php
                                                             $cs = explode(' | ', $connection);
                                                             @endphp
                                                            @foreach($cs as $c)
                                                               {{ $c }}
                                                            @endforeach
                                                            @endif
                                                        @endforeach</td>
                                                </tr>
                                              
                                                <tr>
                                                    <td style="color: rgb(0,0,0);">Scanner Resolution</td>
                                                    <td style="color: rgb(0,0,0);">{{ $printers[0]->scanner_resolution}} DPI</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: rgb(0,0,0);">Copy Speed</td>
                                                    <td style="color: rgb(0,0,0);">{{ $printers[0]->copy_speed }} ppm</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: rgb(0,0,0);">Printer Memory</td>
                                                    <td style="color: rgb(0,0,0);">{{ $printers[0]->printer_memory }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: rgb(0,0,0);">Encryption/Security </td>
                                                    <td style="color: rgb(0,0,0);">{{ $printers[0]->encryption_support}}</td>
                                                </tr>
                                               
                                                <tr>
                                                    <td style="color: rgb(0,0,0);">Description</td>
                                                    <td style="color: rgb(0,0,0);">{{ $printers[0]->printer_description }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: rgb(0,0,0);">Stocks</td>
                                                    <td style="color: rgb(0,0,0);">{{ $printers[0]->quantity }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: rgb(0,0,0);">Price</td>
                                                    <td style="color: rgb(0,0,0);">₱ {{ number_format($printers[0]->price, 2, '.', ',') }}</td>
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
        </div><a class="border rounded d-inline scroll-to-top" href="{{ route('printer.index') }}"><i class="fas fa-arrow-left"></i></a>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/theme.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>

</html>
