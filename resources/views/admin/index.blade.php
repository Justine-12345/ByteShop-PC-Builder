<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard - Operating Systems</title>
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
               @if($message = Session::get('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-right: 30px; margin-left: 30px">
  <strong>{{$message}}</strong> 
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
                <div class="container-fluid" style="font-size: 14px;">

                <div class="row justify-content-center" style="">
                    <div class="col-lg-3" style="box-shadow: 1px 1px 3px  gray; margin-right: 20px;background: rgb(82,85,231);
background: linear-gradient(13deg, rgba(82,85,231,1) 0%, rgba(82,85,231,1) 70%, rgba(141,143,255,1) 100%);height: 25vh; border-radius:3%; color: white; padding:24px">
                    <h4>Products Sold</h4>
                    <h3><b>{{$productSold_month != null?$productSold_month->sold: "0"}} <i class="fas fa-shopping-cart" style="float:right; opacity: .8;"></i></b></h3>
                    <small>
                        @php
                        
                        if($productSold_month != null){
                        $monthDateToString =''.$productSold_month->year.'-'.$productSold_month->month.'';
                        $monthDate=date_create($monthDateToString);
                        }
                        else{
                        $monthDateToString =''.date("Y").'-'.date("m").'';
                        $monthDate=date_create();
                        }
                        @endphp
                        {{date_format($monthDate,"M - Y")}}
                    </small>
                    </div>

                    <div class="col-lg-3" style="box-shadow: 1px 1px 3px  gray;  margin-right: 20px; background: rgb(223,4,77);
background: linear-gradient(239deg, rgba(223,4,77,1) 0%, rgba(231,82,132,1) 88%, rgba(231,82,132,1) 100%);height: 25vh; border-radius:3%; color: white; padding:24px">
                    <h4>Total Sales</h4>
                     <h3><b>{{$productSale_month != null?"₱". number_format($productSale_month->sales, 2, '.', ',') : "₱ 0.00"}} <i class="fas fa-money-bill-wave" style="float:right; opacity:.8;"></i></b></h3>
                    <small>
                        @php
                        
                        if($productSale_month != null){
                        $monthDateToString =''.$productSale_month->year.'-'.$productSale_month->month.'';
                        $monthDate=date_create($monthDateToString);
                        }
                        else{
                        $monthDateToString =''.date("Y").'-'.date("m").'';
                        $monthDate=date_create();
                        }
                        @endphp
                        {{date_format($monthDate,"M - Y")}}
                    </small>
                </div>


                    <div class="col-lg-3" style="box-shadow: 1px 1px 3px  gray;background: rgb(231,191,82);
background: linear-gradient(239deg, rgba(231,191,82,1) 0%, rgba(231,143,82,1) 68%, rgba(231,143,82,1) 97%);height: 25vh; border-radius:3%; color: white; padding:24px">
                    <h4>New Customers</h4>
                     <h3><b>{{$user_month != null?$user_month->users: "0"}} <i class="fas fa-users" style="float:right; opacity: .8;"></i></b></h3>
                    <small>
                        @php
                        
                        if($user_month != null){
                        $monthDateToString =''.$user_month->year.'-'.$user_month->month.'';
                        $monthDate=date_create($monthDateToString);
                        }
                        else{
                        $monthDateToString =''.date("Y").'-'.date("m").'';
                        $monthDate=date_create();
                        }
                        @endphp
                        {{date_format($monthDate,"M - Y")}}
                    </small>
                    </div>
                </div>
                <hr>
                {{-- CHARTS --}}
                <h2>Analytic Charts </h2>
                <div class="row" style="margin: 30px;">
                     <div class="col-lg-6" style="box-shadow: 1px 1px 3px  gray; border-radius:1%; margin-top: 0px">
                         @if(empty($bestSeller_Chart))
                           <div id="app2"></div>
                         @else
                         <h5><b>Best Seller Items</b></h5>
                           <div id="app2">{!! $bestSeller_Chart->container() !!}</div>
                           {!! $bestSeller_Chart->script() !!}
                         @endif
                    </div>

                 

                    <div class="col-lg-6" style="box-shadow: 1px 1px 3px  gray; border-radius:1%; margin-top: 0px">
                         @if(empty($productSales_month_chart))
                           <div id="app2"></div>
                         @else
                         <h5><b>Monthly Sales</b></h5>
                           <div id="app2">{!! $productSales_month_chart->container() !!}</div>
                           {!! $productSales_month_chart->script() !!}
                         @endif
                    </div>


                    <div class="col-lg-6" style="box-shadow: 1px 1px 3px  gray; border-radius:1%; margin-top: 0px">
                         @if(empty($users_month_chart))
                           <div id="app2"></div>
                         @else
                         <h5><b>Monthly New Users</b></h5>
                           <div id="app2">{!! $users_month_chart->container() !!}</div>
                           {!! $users_month_chart->script() !!}
                         @endif
                    </div>

                       <div class="col-lg-6" style="box-shadow: 1px 1px 3px  gray; border-radius:1%;">
                         @if(empty($productSold_months_chart))
                           <div id="app2"></div>
                         @else
                         <h5><b>Monthly Item Solds</b></h5>
                           <div id="app2">{!! $productSold_months_chart->container() !!}</div>
                           {!! $productSold_months_chart->script() !!}
                         @endif
                    </div>
                   
                </div>









                    </div>
            </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © Brand 2021</span></div>
                </div>
            </footer>
        </div>
    </div>
    <script
src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
</script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/theme.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>

</html>