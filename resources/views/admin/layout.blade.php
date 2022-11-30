<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>Trang quản trị</title>
    <!-- Favicon -->
    <!-- Favicon -->
    <link
        href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300;400&family=Raleway:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="icon" href="{{asset('assets/admin/img/brand/favicon.png')}}" type="image/png">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="{{asset('assets/admin/vendor/nucleo/css/nucleo.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/admin/vendor/@fortawesome/fontawesome-free/css/all.min.css')}}"
          type="text/css">
    <link rel="stylesheet" href="{{asset('assets/admin/css/argon.css?v=1.2.2')}}" type="text/css">
{{--    <link rel="stylesheet" href="{{asset('assets/frontend/css/custom.css')}}" type="text/css">--}}

    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
</head>

<body>
<!-- Sidenav -->
<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header  align-items-center">
            <a class="navbar-brand" href="javascript:void(0)">
                <img src="{{asset('assets/frontend/images/logo2.png')}}" class="navbar-brand-img" alt="...">
            </a>
        </div>
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('admin/dashboard')}}">
                            <i class="ni ni-tv-2 text-primary"></i>
                            <span class="nav-link-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('category')}}" class="nav-link">
                            <i class="ni ni-books text-primary"></i>
                            <span class="nav-link-text">Quản lý chủ đề</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.book')}}" class="nav-link">
                            <i class="fa fa-book text-primary"></i>
                            <span class="nav-link-text">Quản lý sách</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url(route('admin.user'))}}" class="nav-link">
                            <i class="ni ni-books text-primary"></i>
                            <span class="nav-link-text">Quản lý tài khoản</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url(route('admin.order'))}}" class="nav-link">
                            <i class="fas fa-receipt text-primary"></i>
                            <span class="nav-link-text">Quản lý đơn hàng</span>
                        </a>
                    </li>
                </ul>
                <!-- Divider -->
                <!-- Heading -->
            </div>
        </div>
    </div>
</nav>

<!-- Main content -->
<div class="main-content" id="panel">
    <!-- Topnav -->
    <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Search form -->
                <form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
                    <div class="form-group mb-0">
                        <div class="input-group input-group-alternative input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                            </div>
                            <input class="form-control" placeholder="Tìm kiếm" type="text" id="search">
                        </div>
                    </div>
                    <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main"
                            aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </form>
                <!-- Navbar links -->
                <ul class="nav navbar-nav align-items-center ml-md-auto ">
                    <li class="nav-item d-xl-none">
                        <!-- Sidenav toggler -->
                        <div class="pr-3 sidenav-toggler sidenav-toggler-dark show" data-action="sidenav-pin"
                             data-target="#sidenav-main">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item d-sm-none">
                        <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                            <i class="ni ni-zoom-split-in"></i>
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav align-items-center ml-auto ml-md-0 ">
                    <li class="nav-item dropdown">
                        <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false">
                            <div class="media align-items-center">
                                    <span class="avatar avatar-sm rounded-circle">
                                        <img alt="Image placeholder"
                                             src="{{asset('assets/admin/img/theme/team-4.jpg')}}">
                                    </span>
                                <div class="media-body  ml-2  d-none d-lg-block">
                                    <span class="mb-0 text-sm  font-weight-bold">{{Auth::user()->user}}</span>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu  dropdown-menu-right ">
                            <div class="dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Xin chào!</h6>
                            </div>
                            <a href="{{route('admin.info')}}" class="dropdown-item">
                                <i class="ni ni-single-02"></i>
                                <span>Thông tin cá nhân</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="{{route('home')}}" class="dropdown-item">
                                <i class="ni ni-user-run"></i>
                                <span>Quay lại trang người dùng</span>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="myContent">
        @yield('content')
    </div>
</div>
<!-- Core -->
<script src="{{asset('assets/frontend/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/jquery-3.0.0.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/plugin.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

<script src="{{asset('assets/admin/vendor/js-cookie/js.cookie.js')}}"></script>
<script src="{{asset('assets/admin/vendor/jquery.scrollbar/jquery.scrollbar.min.js')}}"></script>
<!-- Argon JS -->
<script src="{{asset('assets/frontend/js/custom.js')}}"></script>
<script src="{{asset('assets/admin/js/argon.js?v=1.2.2')}}"></script>
<!-- Optional JS -->
<script src="{{asset('assets/admin/vendor/chart.js/dist/Chart.min.js')}}"></script>
<script src="{{asset('assets/admin/vendor/chart.js/dist/Chart.extension.js')}}"></script>
</body>

<!-- Footer -->

</html>
