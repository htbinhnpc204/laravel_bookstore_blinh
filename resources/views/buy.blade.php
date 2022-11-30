@extends('layouts.layout')
@section('content')
    <!-- BEGIN PRODUCT CARD -->
    <section class="product wrapper">
        <div class="product__cols">
            <!-- BEGIN LEFT COLUMN -->
            <div class="product__left">
                <div class="product__mob js-to-3"></div>
                <div class="product-gallery">
                    <div class="product-gallery__top">
                        <div class="product-gallery__cols">
                        </div>
                    </div>
                    <div class="product-slider loaded js-product-slider dots-2 dots-left">
                        <div class="product-slider__item">
                            <a class="product-slider__link" href="#" data-fancybox="gallery">
                                <img class="product-slider__image" src="{{asset('images/' . $book->hinhanh)}}"
                                     alt="{{$book->name}}">
                            </a>
                        </div>
                        <div class="product-slider__item">
                            <a class="product-slider__link" href="#" data-fancybox="gallery">
                                <img class="product-slider__image" src="{{asset('images/' . $book->hinhanh)}}"
                                     alt="{{$book->name}}">
                            </a>
                        </div>
                        <div class="product-slider__item">
                            <a class="product-slider__link" href="#" data-fancybox="gallery">
                                <img class="product-slider__image" src="{{asset('images/' . $book->hinhanh)}}"
                                     alt="{{$book->name}}">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- LEFT COLUMN END -->

            <!-- BEGIN RIGHT COLUMN -->
            <div class="product__right">
                <div class="product__content h-100">
                    <div class="product__desktop js-from-3">
                        <div class="product__top js-content-3">
                            <h2 class="product__title">{{$book->name}}</h2>
                            <div class="product-rating">
                                <div class="product-rating__col">
                                    <span class="product-rating__text">{{$sold}} đã mua</span>
                                </div>
                                <div class="product-rating__col">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($rating > 0.5)
                                            <span class="fa fa-star checked"></span>
                                        @elseif($rating <= 0)
                                            <span class="fa fa-star-o checked"></span>
                                        @elseif($rating <= 0.5)
                                            <span class="fa fa-star-half-full checked"></span>
                                        @endif
                                        <?php $rating--; ?>
                                    @endfor
                                </div>
                                <div class="product-rating__col">
                                    <span class="text-small checked">({{count($details)}} đánh giá)</span>
                                </div>

                            </div>
                        </div>
                    </div>
                    <p class="product__text">Tác giả: {{$book->tacgia}}</p>
                    <ul class="chars">
                        <li class="chars__item">
                            <span class="chars__name">Trạng thái:</span>
                            <span class="chars__text">
                                        <span
                                            class="chars__status">{{$book->soluong == 0 ? 'Hết hàng' : 'Còn hàng'}}</span>
                                    </span>
                        </li>
                    </ul>
                    <div class="product__prices">
                        <span class="product__price">{{number_format($book->giaban) . ' VNĐ'}}</span>
                    </div>
                    <div class="product__text">
                        <form action="{{route('cart.add', $book->id)}}" method="post" class=" mt-auto">
                            @csrf
                            <div class="product-add">
                                <div class="product-add__col">
                                    <div class="product-add__count count js-count">
                                        <button class="count__button count__button_minus js-count-minus"></button>
                                        <input class="count__input js-count-input" name="quantity" type="text" value="1"
                                               data-max="{{$book->soluong}}" maxlength="4">
                                        <button class="count__button count__button_plus js-count-plus"></button>
                                    </div>
                                </div>
                                <div class="product-add__col">
                                    <button class="product-add__button button">
                                        <span class="button__text">Thêm vào giỏ hàng</span>
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
                <!-- RIGHT COLUMN END -->

            </div>
        </div>
    </section>
    <!-- PRODUCT CARD END -->
    <div class="product-tabs ms-5">
        <div class="product-nav tabs-nav js-line">
            <ul class="product-nav__list tabs-nav__list tabs-nav__list_left">
                <li class="tabs-nav__item js-tabs-item js-line-item active">
                    <a class="tabs-nav__link js-line-link js-tabs-link" href="#product-tab-1">Giới thiệu</a>
                </li>
                <li class="tabs-nav__item js-tabs-item js-line-item">
                    <a class="tabs-nav__link js-line-link js-tabs-link" href="#product-tab-2">Đánh giá</a>
                </li>
            </ul>
            <div class="tabs-nav__line js-line-element"></div>
        </div>

        <!-- BEGIN DESCRIPTION -->
        <div class="product-tab js-tabs-content active" id="product-tab-1">
            <div class="w-full">
                {!! $book->gioithieu !!}
            </div>
        </div>
        <div class="product-tab js-tabs-content " id="product-tab-2">
            <div class="product-tab__cols">
                <!-- BEGIN REVIEWS -->
                <div class="product-tab__left">
                    <div class="reviews">
                        @forelse($details as $detail)
                            <article class="review">
                                <div class="review__top">
                                    <div class="review__left">
                                        <div class="review__cols">
                                            <div class="review__col">
                                                <h5 class="review__author">{{$detail->order->user->name}}</h5>
                                            </div>
                                            <div class="review__col">
                                                <span class="review__date">{{$detail->reviews->created_at}}</span>
                                            </div>
                                            <div class="review__rating rating rating_small">
                                                @for($i = 1; $i <= 5; $i++)
                                                    @if($detail->reviews->rating - $i >= 0)
                                                        <span class="fa fa-star checked"></span>
                                                    @elseif($detail->reviews->rating - $i < -1)
                                                        <span class="fa fa-star-o checked"></span>
                                                    @elseif($detail->reviews->rating - $i <= -0.5)
                                                        <span class="fa fa-star-half-full checked"></span>

                                                    @endif
                                                @endfor
                                            </div>
                                            <div class="review__col">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p class="review__text">{{$detail->reviews->comment}}</p>
                            </article>
                        @empty
                            <h6>Chưa có đánh giá nào</h6>
                        @endforelse
                    </div>
                </div>
                <!-- REVIEWS END -->

                <!-- BEGIN ADD REVIEW -->
            </div>
        </div>
    </div>
    <!-- ADD REVIEW END -->
    <!-- DESCRIPTION END -->
    <!-- REVIEWS END -->
    <section class="main-block wrapper">
        <div class="main-block__top">
            <span class="main-block__subtitle category-subtitle"><b>you</b> viewed</span>
            <h3 class="main-block__title">Cùng chủ đề</h3>
        </div>
        <div class="catalog-slider js-catalog loaded">
            <div class="catalog-slider__list-wrap">
                <div class="catalog-slider__list js-catalog-carousel">
                    @foreach($related_books as $rbook)
                        <article class="short-item">
                            <div class="short-item__all">
                                <a class="short-item__image-bg" href="{{route('buy',$rbook->id)}}">
                                    <img class="short-item__image"
                                         src="{{asset('images/' . $rbook->hinhanh)}}" alt="">
                                </a>
                                <h4 class="short-item__title">
                                    <a class="short-item__link"
                                       href="{{route('buy',$rbook->id)}}">{{$rbook->name}}</a>
                                </h4>
                                <span
                                    class="short-item__price">{{number_format($rbook->giaban) . ' VNĐ'}}</span>
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
        </div>
    </section>
@endsection
