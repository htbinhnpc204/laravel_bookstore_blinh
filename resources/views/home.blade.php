@extends('layouts.layout')
@section('content')
    <main class="main">
        <!-- BEGIN FIRST SCREEN -->
        <div class="first-screen">
            <div class="first-screen__left">
                <div class="first-screen__mob-cols">
                    <div class="first-screen__mob-col">
                        <div class="slider-count">
                            <span class="slider-count__text js-main-count"><span>1</span>/3</span>
                        </div>
                    </div>
                    <div class="first-screen__mob-col js-to-1"></div>
                </div>
            </div>
            <div class="first-screen__center">
                <div class="main-slider">
                    <div class="main-slider__list-wrap">
                        <div class="main-slider__list js-main-slider loaded">
                            @php $newsBook = \App\Book::all()->sortByDesc('created_at')->take(3); $isFirst = 1; @endphp
                            @foreach($newsBook as $book)
                                <div class="main-slider__item js-slide {{ $isFirst == 1 ? 'active' : ''}}">
                                    <div class="main-slider__max">
                                        <div class="main-slider__row">
                                            <div class="main-slider__cell">
                                                <div class="main-slider__content">
                                                    <span class="main-slider__subtitle category-subtitle">{{$book->category->category_name}}</span>
                                                    <h2 class="main-slider__title">{{$book->name}}</h2>
                                                    <a class="main-slider__button button" href="{{route('buy', $book->id)}}">
                                                        <span class="button__text">Mua ngay</span>
                                                    </a>
                                                </div>
                                                <div class="main-slider__image-wrap">
                                                    <div class="main-slider__image"
                                                         data-bg="{{'images/' . $book->hinhanh}}"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @php $isFirst = -1; @endphp
                            @endforeach
                        </div>
                    </div>
                    <div class="main-slider__bg-wrap">
                        <img class="main-slider__bg"
                             data-lazy="{{asset('assets/user/img/svg/vector-first-screen.svg')}}" alt="">
                        <div class="scroll-down">
                            <span class="scroll-down__icon"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="first-screen__right js-from-1">
                <div class="slider-dots dots-1 js-main-dots"></div>
                <div class="slider-arrows arrows-1 js-main-arrows js-content-1"></div>
            </div>
        </div>
        <!-- FIRST SCREEN END -->

        <!-- BEGIN PRODUCTS -->
        <section class="main-block wrapper">
            <div class="main-block__top">
                <h3 class="main-block__title">Sách mới</h3>
            </div>
            <div class="products-nav tabs-nav js-line">
                <ul class="tabs-nav__list">
                    @php $categories = \App\Category::all()->take(5); @endphp
                    @php $isFirst = 1; @endphp
                    @foreach($categories as $item)
                        <li class="tabs-nav__item js-line-item js-tabs-item {{$isFirst == 1 ? 'active' : ''}}">
                            @php $isFirst = 0; @endphp
                            <a class="tabs-nav__link js-line-link js-tabs-link"
                               href="#products-{{$item->id}}">{{$item->category_name}}</a>
                        </li>
                        @php $isFirst = -1; @endphp
                    @endforeach
                </ul>
                <div class="tabs-nav__line js-line-element"></div>
            </div>
            @php $isFirst = 1; @endphp
            @foreach($categories as $item)
                <div class="product-tab js-tabs-content {{ $isFirst == 1 ? 'active' : '' }}" id="products-{{$item->id}}">
                    @php $isFirst = 0; @endphp
                    <div class="main-catalog">
                        <div class="main-catalog__list">
                            @php $books_category = \App\Book::all()->sortByDesc('created_at')->where('category_id', $item->id) @endphp
                            @foreach($books_category as $book)
                                <article class="short-item">
                                    <div class="short-item__all">
                                        <a class="short-item__image-bg" href="{{route('buy',$book->id)}}">
                                            <img class="short-item__image" src="{{'images/' . $book->hinhanh}}" alt="{{$book->name}}">
                                        </a>
                                        <h4 class="short-item__title">
                                            <a class="short-item__link" href="{{route('buy',$book->id)}}">{{$book->name}}</a>
                                        </h4>
                                        <span class="short-item__price">{{number_format($book->giaban) . ' VNĐ'}}</span>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                        <img class="main-catalog__bg" data-lazy="{{asset('assets/user/img/svg/vector-first-screen.svg')}}" alt="">
                    </div>
                </div>
            @endforeach

            <div class="load-more">
                <a class="button" href="{{route('home.shop')}}">
                    <span class="button__text">Xem tất cả</span>
                </a>
            </div>
        </section>
        <!-- PRODUCTS END -->

        <!-- BEGIN BEST SELLERS -->
        <section class="main-block wrapper">
            <div class="main-block__top">
                <span class="main-block__subtitle category-subtitle"><b>top</b> products</span>
                <h3 class="main-block__title">Sách bán chạy</h3>
            </div>
            @php $topSales = DB::table('order_details')
                                    ->select('book_id', DB::raw('SUM(quantity) as soluongban'))
                                    ->groupBy('book_id')
                                    ->orderBy('soluongban','desc')
                                    ->get();
            @endphp
            <div class="catalog-slider js-catalog loaded">
                <div class="catalog-slider__list-wrap">
                    <div class="catalog-slider__list js-catalog-carousel">
                        @foreach($topSales as $item)
                            @php $book = \App\Book::find($item->book_id) @endphp
                            <article class="short-item">
                                <div class="short-item__all">
                                    <a class="short-item__image-bg" href="{{route('buy',$book->id)}}">
                                        <img class="short-item__image" src="{{'images/' . $book->hinhanh}}" alt="{{$book->name}}">
                                    </a>
{{--                                    <div class="short-item__top">--}}
{{--                                        <div class="short-item__cols">--}}
{{--                                            <div class="short-item__col">--}}
{{--                                                <span class="item-tag item-tag_red">Sale</span>--}}
{{--                                                <span class="item-tag item-tag_green">New</span>--}}
{{--                                            </div>--}}
{{--                                            <div class="short-item__col">--}}
{{--                                                <button class="heart-button js-toggle-active"></button>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                    <h4 class="short-item__title">
                                        <a class="short-item__link" href="{{route('buy',$book->id)}}">{{$book->name}}</a>
                                    </h4>
                                    <span class="short-item__price">{{number_format($book->giaban) . ' VNĐ'}}</span>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
                <div class="catalog-slider__cols">
                    <div class="catalog-slider__col">
                        <button class="prev-button js-catalog-prev"></button>
                    </div>
                    <div class="catalog-slider__col dots-2 js-catalog-dots">

                    </div>
                    <div class="catalog-slider__col">
                        <button class="next-button js-catalog-next"></button>
                    </div>
                </div>
                <div class="load-icon"></div>
                <img class="catalog-slider__bg"
                     data-lazy="{{asset('assets/user/img/svg/vector-first-screen.svg')}}" alt="">
            </div>
        </section>
        <!-- BEST SELLERS END -->
    </main>
    <!-- MAIN END -->

@endsection
