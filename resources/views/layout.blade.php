<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Book store</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/frontend/css/custom.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/frontend/css/responsive.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/app.css')}}">
    <!-- style css -->
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/frontend/css/style.css')}}">
    <!-- Responsive-->
    <link rel="stylesheet" href="{{asset('public/assets/frontend/css/responsive.css')}}">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="{{asset('public/assets/frontend/css/jquery.mCustomScrollbar.min.css')}}">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="{{asset('public/assets/admin/vendor/@fortawesome/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700&display=swap" rel="stylesheet">
    <!-- font awesome -->

    <!--  -->
    <!-- owl stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Great+Vibes|Poppins:400,700&display=swap&subset=latin-ext"
          rel="stylesheet">
    <link rel="stylesheet" href="{{asset('public/assets/frontend/css/owl.carousel.min.css')}}">
    <link rel="stylesoeet" href="{{asset('public/assets/frontend/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css"
          media="screen">

</head>

<body>
<div class="banner_bg_main pb-3">
    <div class="header_section">
        <div class="container">
            <div class="containt_main">
                <div class="logo"><a href="{{route('index')}}"><img
                            src="{{asset('public/assets/frontend/images/logo.png')}}" alt=""></a>
                </div>
            </div>
            <div class="containt_main">
                <img src="{{asset('public/assets/frontend/images/toggle-icon.png')}}" class="toggle_icon"
                     onclick="openNav()">
                <div id="mySidenav" class="sidenav">
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                    <ul>
                        @php $categories = \App\Category::all(); @endphp
                        @foreach($categories as $item)
                            @if(empty($cd_id))
                                <li class="nav-item"><a href="{{route('home.category', $item->id)}}"
                                                        class="item">{{$item->name}}</a></li>

                            @else
                                <li class="nav-item"><a href="{{route('home.category', $item->id)}}"
                                                        class="item {!! $item->id == $cd_id ? 'selected' : '' !!}">{{$item->name}}</a>
                                </li>

                            @endif
                        @endforeach
                    </ul>
                </div>
                <div class="dropdown">
                    <a class="btn btn-primary" type="button" id="dropdownMenuButton"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">All Category
                    </a>
                    <div class="dropdown-menu pl-2 pr-2" aria-labelledby="dropdownMenuButton">
                        <a href="#">Best Sellers</a>
                        <a href="#">Gift Ideas</a>
                        <a href="#">New Releases</a>
                        <a href="#">Today's Deals</a>
                        <a href="#">Customer Service</a>
                    </div>
                </div>
                <div class="main">
                    <div class="input-group">
                        <input type="text" id="liveSearch" class="form-control" placeholder="{{__('Tìm kiếm sách')}}"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <div class="dropdown-menu" id="liveSearchResult" aria-labelledby="liveSearch">
                            <ul id="searchResult">

                            </ul>
                        </div>
                        <div class="input-group-append">
                            <button class="btn btn-secondary" type="button">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>

                    </div>
                </div>
                <div class="header_box justify-content-center">
                    <div class="login_menu">
                        <ul>
                            <li><a href="#" id="cart" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    <span class="padding_10">{{__('Giỏ hàng')}}</span></a>
                                <div class="dropdown-menu p-2" id="cartItem" aria-labelledby="cart">
                                    <span>Giỏ hàng</span>
                                    <table class="w-100">
                                        <thead>
                                        <tr>
                                            <th colspan="1">Tên sách</th>
                                            <th colspan="1">Số lượng</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if($cart_item = Session::get('cart'))
                                            @foreach($cart_item as $item)
                                                @php
                                                    $book = \App\Book::find($item['id'])
                                                @endphp
                                                <tr>
                                                    <td colspan="1">{{$book['name']}}</td>
                                                    <td colspan="1" class="text-center">{{$item['qty']}}</td>
                                                    <td colspan="1" class="text-right"><a
                                                            href="{{route('cart.delete', $item['id'])}}">&#x2715;</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                    <div class="d-flex flex-column">
                                        <span>Thành tiền: <strong
                                                class="float-right">{{number_format(Session::get('total')) . ' VNĐ'}}</strong> </span>
                                        <span><a href="{{route('cart.details')}}" class="right">Xem chi tiết</a></span>
                                    </div>

                                </div>
                            </li>

                            @guest
                                <li>
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <a href="{{route('login') }}">{{ __('Đăng nhập') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a href="{{ route('register') }}">{{ __('Đăng ký') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="padding_10 dropdown-toggle" href="#" role="button"
                                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ Auth::user()->name ?? Auth::user()->user }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        @if(Auth::user()->role_id != 3)
                                            <a class="dropdown-item item" href="{{route('admin.index')}}">
                                                {{ __('Trang quản trị') }}
                                            </a>
                                        @endif
                                        <a class="dropdown-item item" href="">
                                            {{ __('Thông tin cá nhân') }}
                                        </a>
                                        <a class="dropdown-item item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                               document.getElementById('logout-form').submit();">
                                            {{ __('Đăng xuất') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                              style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- banner bg main end -->
<!-- fashion section start -->

<div class="fashion_section">
    @include('message.flash')
    @yield('product')
</div>

<!-- fashion section end -->
<!-- footer section start -->
<div class="footer_section layout_padding">
    <div class="container">
        <div class="footer_logo"><a href="{{route('index')}}"><img
                    src="{{asset('public/assets/frontend/images/logo.png')}}"></a>
        </div>
        <div class="location_main">{{__('Số diện thoại liên hệ: ')}}<a href="#">+84 946 794 778</a></div>
    </div>
</div>
<!-- footer section end -->
<!-- Javascript files-->
<script src="{{asset('public/assets/frontend/js/jquery.min.js')}}"></script>
<script src="{{asset('public/assets/frontend/js/jquery-3.0.0.min.js')}}"></script>
<script src="{{asset('public/assets/frontend/js/popper.min.js')}}"></script>
<script src="{{asset('public/assets/frontend/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('public/assets/frontend/js/plugin.js')}}"></script>
<!-- sidebar -->
<script src="{{asset('public/assets/frontend/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<script src="{{asset('public/assets/frontend/js/custom.js')}}"></script>

<script>
    $("#liveSearch").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $.ajax({
            type: 'POST',
            url: '{{ route("search") }}',
            dataType: 'json',
            data: {
                '_token': '{{ csrf_token() }}',
                'key': value
            },
            success: function (data) {
                $('#searchResult').empty();
                $.each(data, function (index, value) {
                    console.log(value);
                    var url = '{{ route("buy", ":id") }}';
                    url = url.replace(':id', value.id);
                    $('#searchResult').append('<li><a href="' + url + '" class="dropdown-item item">' + value.name + '</a>');
                });
            }
        })
        .on("click", function (){

        });
    });
    // Remove Items From Cart
    $('a.remove').click(function () {
        event.preventDefault();
        $(this).parent().parent().parent().hide(400);

    });

    // Just for testing, show all items
    $('a.btn.continue').click(function () {
        $('li.items').show(400);
    });

    $(document).ready(function () {
        $(".qty-block a").on('click', function () {
            function addCommas(nStr) {
                nStr += '';
                x = nStr.split('.');
                x1 = x[0];
                x2 = x.length > 1 ? '.' + x[1] : '';
                var rgx = /(\d+)(\d{3})/;
                while (rgx.test(x1)) {
                    x1 = x1.replace(rgx, '$1' + ',' + '$2');
                }
                return x1 + x2;
            }

            var id = $(this).data("id");
            var type = $(this).data("type");
            var span = $("span#qty-" + id);
            var cost = $("#cost-" + id);
            var total = $("#total");
            console.log(addCommas({{Session::get('total')}}) + ' VNĐ');
            $.ajax({
                type: 'POST',
                url: '{{ route("cart.update") }}',
                dataType: 'json',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'id': id,
                    'type': type
                },
                success: function (data) {
                    console.log(data);
                    span.text(data.qty);
                    var temp = data.qty * data.giaban;
                    cost.text(addCommas(temp) + ' VNĐ');
                    total.text(addCommas({{Session::get('total')}}) + ' VNĐ');
                }
            });
        });
    });
</script>
<script>
    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";

    }
</script>
</body>

</html>
