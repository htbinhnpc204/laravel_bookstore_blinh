<!doctype html>
<html lang="zxx">
<head>
    <meta charset="utf-8">
    <meta name="format-detection" content="telephone=no">
    <meta id="Viewport" name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1">
    <link rel="icon" type="image/x-icon" href="{{asset('assets/img/favicon.ico')}}">
    <title>Vbookstore - {{\Request::route()->getName()}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/custom.css')}}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.14.1/build/ol.js"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300;400&family=Raleway:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="it-rating" content="it-rat-cd303c3f80473535b3c667d0d67a7a11"/>
    <meta name="cmsmagazine" content="3f86e43372e678604d35804a67860df7"/>
    <style>
        .loaded .load-icon {
            display: block;
        }

        .loaded * {
            -webkit-transition: none;
            transition: none;
        }

        .load-icon {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            display: none;
            z-index: 99999;
            position: absolute;
            top: 0;
            left: 0;
            background: #fff;
        }

        .load-icon:before {
            content: "";
            width: 64px;
            height: 64px;
            margin: -32px 0 0 -32px;
            position: absolute;
            top: 50%;
            left: 50%;
            background: url({{asset('assets/user/img/loader.gif')}}) no-repeat left top;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/user/css/main.css')}}">
</head>
<body class="loaded">

<div class="load-icon"></div>
<?php $category = \App\Category::all(); ?>
<div class="page-container">
    <!-- BEGIN HEADER -->
    <header class="header">
        <div class="header__main">
            <div class="header__cols">
                <div class="header__left">
                    <div class="header__cols">
                        <div class="header__col">
                            <button class="mob-button js-mob-open">
                                <span class="mob-button__icon"></span>
                            </button>
                        </div>
                        <div class="header__col">
                            <a class="logo" href="#">
                                <img class="logo__image" src="{{asset('assets/frontend/images/logo2.png')}}" alt="">
                            </a>
                        </div>
                        <div class="header__col header__col_hide-mob">
                            <nav class="header-nav">
                                <ul class="header-nav__list">
                                    <li class="header-nav__item">
                                        <a class="header-nav__link" href="{{route('index')}}">Trang chủ</a>
                                    </li>
                                    <li class="header-nav__item js-nav-item">
                                        <a class="header-nav__link header-nav__link_arrow js-nav-button"
                                           href="#">Danh mục</a>
                                        <div class="hide-nav js-nav-hide">
                                            <ul class="hide-nav__list">
                                                @foreach($category as $item)
                                                    <li class="hide-nav__item">
                                                        <a class="hide-nav__link"
                                                           href="{{route('home.category', $item['id'])}}">{{$item->category_name}}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="header-nav__item">
                                        <a class="header-nav__link" href="{{route('home.shop')}}">Tất cả sản phẩm</a>
                                    </li>
                                    @guest
                                    @else
                                        <li class="header-nav__item js-nav-item">
                                            <a class="header-nav__link header-nav__link_arrow js-nav-button"
                                               href="#">{{Auth::user()->name ?? Auth::user()->user}}</a>
                                            <div class="hide-nav js-nav-hide">
                                                <ul class="hide-nav__list">
                                                    @if(Auth::user()->role_id != 3)
                                                        <li class="hide-nav__item">
                                                            <a class="hide-nav__link" href="{{route('admin.index')}}">
                                                                {{ __('Trang quản trị') }}
                                                            </a>
                                                        </li>
                                                    @endif
                                                    <li class="hide-nav__item">
                                                        <a class="hide-nav__link" href="{{route('profile')}}">Thông tin
                                                            cá nhân</a>
                                                    </li>
                                                    <li class="hide-nav__item">
                                                        <a class="hide-nav__link" href="#">Lịch sử mua hàng</a>
                                                    </li>
                                                    <li class="hide-nav__item">
                                                        <a class="hide-nav__link" href="#" onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">Đăng xuất</a>
                                                    </li>
                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                          style="display: none;">
                                                        @csrf
                                                    </form>
                                                </ul>
                                            </div>
                                        </li>
                                    @endguest
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>

                <div class="header__right">
                    <ul class="user-nav">
                        <li class="searchGroup">
                            <input type="text" id="liveSearch" class="js-nav-button" placeholder="Tìm kiếm">
                            <div class="searchResult">
                                <ul id="searchResult">

                                </ul>
                            </div>
                        </li>

                        <li class="user-nav__item">
                            @guest
                                <a class="user-nav__link" href="{{route('login')}}">
                                    <span class="user-nav__icon user-nav__icon_2"></span>
                                </a>
                            @else
                                <a class="user-nav__link" href="{{route('profile')}}">
                                    <span class="user-nav__icon user-nav__icon_2"></span>
                                </a>
                            @endguest
                        </li>
                        <li class="user-nav__item">
                            <a class="user-nav__link" href="{{route('cart.details')}}">
                                <span class="user-nav__icon user-nav__icon_4"></span>
                                <span
                                    class="user-nav__text">{{ empty(Session::get('cart')) ? 0 : count(Session::get('cart')) }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <!-- HEADER END -->

    <!-- MOBILE NAVIGATION -->
    <div class="hide-mob js-mob-hide">
        <div class="hide-mob__bg">
            <button class="hide-mob__close close-button js-mob-close"></button>
            <div class="hide-mob__mask js-mob-close"></div>
            <ul class="mob-nav">
                <li class="mob-nav__item">
                    <a class="mob-nav__link" href="{{route('index')}}">Trang chủ</a>
                </li>
                <li class="mob-nav__item js-slidedown">
                    <a class="mob-nav__link js-slidedown-button" href="#">
                        <span class="mob-nav__arrow">Danh mục</span>
                    </a>
                    <div class="slide-nav js-slidedown-hide">
                        <ul class="slide-nav__list">
                            @foreach($category as $item)
                                <li class="slide-nav__item">
                                    <a class="slide-nav__link"
                                       href="{{route('home.category', $item['id'])}}">{{$item->category_name}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </li>
            </ul>
            <div class="hide-mob__socials">
                <ul class="socials__list socials__list_center">
                    <li class="socials__item">
                        <a class="socials__link" href="https://fb.com/binh.hothai.39">Fb</a>
                    </li>
                    <li class="socials__item">
                        <a class="socials__link" href="https://www.instagram.com/binh.hothai.204/">Ins</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- MOBILE NAVIGATION END -->
@include('message.flash')

@yield('content')

<!-- BEGIN FOOTER -->
    <footer class="footer">
        <div class="footer__main wrapper">
            <div class="footer__top">
                <div class="footer__cols">
                    <div class="footer__col">
                        <a class="footer-logo logo" href="{{route('index')}}">
                            <img class="logo__image" src="{{asset('assets/frontend/images/logo2.png')}}" alt="">
                        </a>
                        <span class="footer-description">
                            Vbookstore nhận đặt hàng trực tuyến và giao hàng tận nơi. KHÔNG hỗ trợ đặt mua và nhận hàng trực tiếp tại văn
                            phòng cũng như tất cả Hệ Thống Blinh trên toàn quốc.
                        </span>
                        <div class="footer-line"></div>
                    </div>
                    <div class="footer__col">
                        <div id="map" class="map"></div>
                        <script type="text/javascript">
                            var map = new ol.Map({
                                target: 'map',
                                layers: [
                                    new ol.layer.Tile({
                                        source: new ol.source.OSM()
                                    })
                                ],
                                view: new ol.View({
                                    center: ol.proj.fromLonLat([16.078897290024955, 108.21224432373785]),
                                    zoom: 4
                                })
                            });
                        </script>
                    </div>
                    <div class="footer__col">
                        <div class="socials">
                            <span class="socials__text">Thông tin liên hệ</span>
                            <span class="footer-description">
                                Email: <a href="mailto:htbinhnpc@gmail.com">htbinhnpc@gmail.com</a>
                            </span>
                            <span class="footer-description">
                                Số điện thoại: <a href="tel:0946794778">Hồ Thái Bình</a>
                            </span>
                            <span class="socials__text">Liên kết mạng xã hội:</span>
                            <ul class="socials__list">
                                <li class="socials__item">
                                    <a class="socials__link" href="https://fb.com/binh.hothai.39">Fb</a>
                                </li>
                                <li class="socials__item">
                                    <a class="socials__link" href="https://www.instagram.com/binh.hothai.204/">Ins</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer__bottom">
                <div class="footer__cols">
                    <div class="footer__left">
                        <span class="copyrights">&copy; All right reserved. Mollee 2021</span>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- FOOTER END -->

</div>


<script src="{{asset('assets/frontend/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/user/js/libs/jquery-3.5.1.min.js')}}"></script>
<script src="{{asset('assets/user/js/libs/jquery-migrate-1.4.1.min.js')}}"></script>
<script src="{{asset('assets/user/js/components/slick.js')}}"></script>
<script src="{{asset('assets/user/js/components/syotimer.js')}}"></script>
<script src="{{asset('assets/user/js/components/formstyler.js')}}"></script>
<script src="{{asset('assets/user/js/components/wnumb.js')}}"></script>
<script src="{{asset('assets/user/js/components/rating.js')}}"></script>
<script src="{{asset('assets/user/js/components/nouislider.js')}}"></script>

<script src="{{asset('assets/user/js/main.js')}}"></script>
<script>
    function calcRate(r) {
        const f = ~~r,//Tương tự Math.floor(r)
            id = 'star' + f + (r % f ? 'half' : '')
        id && (document.getElementById(id).checked = !0)
        console.log(id);
    }

    $(document).ready(function () {
        setTimeout(function () {
            $("div.toast").fadeOut(400);
        }, 2000); // 5 secs
    });

    $("#liveSearch").focus(function () {
        $('.searchResult').addClass('d-block');
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
                        $('#searchResult').append('<li><a href="' + url + '" >' + value.name + '</a> <br>');
                    });
                }
            });
        });
        $("#liveSearch").focusout(function () {
            if ($(this).val() === '') {
                $('.searchResult').removeClass('d-block');
            }
        });
    });

    $(document).ready(function () {
        $(".js-count button").on('click', function () {
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
            var span = $("input#qty-" + id);
            var cost = $("#cost-" + id);
            var total = $("#total");
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
                    span.text(data.qty);
                    var temp = data.qty * data.giaban;
                    cost.text(addCommas(temp) + ' VNĐ');
                    var sumtotal = 0;
                    $('.wishlist__price_total').each(function () {
                        var text = $(this).text();
                        var regex = /\D/g;
                        sumtotal += parseInt(text.replace(regex, ''));
                    })
                    total.text(addCommas(sumtotal) + ' VNĐ');
                }
            });
        });
    });
    $(function () {
        $('#doFilter').on("click", function () {
            var rangeSlider = document.getElementById("range-slider");
            var value = rangeSlider.noUiSlider.get();
            var categories = [];
            $("input:checkbox[class=checkbox__input]:checked").each(function () {
                categories.push($(this).val());
            });
            $.ajax({
                type: 'POST',
                url: '{{ route("shop.filter") }}',
                dataType: 'json',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'range': value,
                    'categories': categories
                },
                success: function (data) {
                    console.log('success');
                    location.reload();
                },
                error: function (data) {
                    console.log('error');
                }
            });
        });
    });

</script>
</body>
</html>
