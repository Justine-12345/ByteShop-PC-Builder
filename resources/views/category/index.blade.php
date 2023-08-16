<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard - Category</title>
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
                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-dark mb-0">Categories</h3>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-xl-12 offset-xl-0">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <div class="table-responsive text-center">
                                        <table class="table">
                                            <thead style="background: #031131;">
                {{--  COLOMN NAME --}}
                                                <tr>
                                                    <th style="color: rgb(255,255,255);">ID</th>
                                                    <th style="color: rgb(255,255,255);">Name</th>
                                                    <th style="color: rgb(255,255,255);width: 300px;">Action</th>
                                                </tr>

                                            </thead>
                                            <tbody>
                                              
                {{-- START LOOP HERE --}}
                                        @foreach($categories as $category)
                                            <tr>
                                                <td style="color: rgb(0,0,0);">{{ $category->category_id }}</td>

                                                <td style="color: rgb(0,0,0);">{{ $category->category_name }}</td>

                                                <td class="text-center">
                                                <form action="{{ action('CategoryController@destroy', $category->category_id)}}" method="post">

                                                    <a href="{{ action('CategoryController@show', $category->category_id)}}" class="btn btn-primary" type="button" style="color: rgb(255, 255, 255);background: #00674c;"><i class="fa fa-eye"></i>&nbsp;View</a>

                                                    <a href="{{ action('CategoryController@edit', $category->category_id)}}" class="btn btn-primary" type="button" style="color: rgb(255, 255, 255);background: #00674c;"><i class="fa fa-eye"></i>&nbsp;Edit</a>

                                                    @csrf
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    <button class="btn btn-primary" type="submit" style="background: #00674c;"><i class="fa fa-trash"></i>&nbsp;Delete</button>
                                                </form>
                                                </td>
                                             </tr>
                                        @endforeach
                {{-- END LOOP HERE --}}


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
        </div><a class="border rounded d-inline scroll-to-top" href="{{ route('category.create') }}"><i class="fas fa-plus"></i></a>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/theme.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>

</html>