@extends('layouts.layout')
@section('content')
    <main class="main">
        <div class="checkout-page wrapper">
            <div class="checkout-page__cols">
                <!-- BEGIN LEFT COLUMN -->
                <div class="checkout-page__left">
                    <section class="thanks">
                        <div class="thanks__top">
                            <h2 class="thanks__title">Cảm ơn bạn đã mua hàng!</h2>
                            <p class="thanks__top-text">Mọi thứ đã hoàn tất, chúng tôi sẽ gửi email cho bạn ngay khi đơn
                                hàng được duyệt.</p>
                            <p>In hóa đơn <a href="{{route('cart.bill', session()->get('order_id'))}}">tại đây</a></p>
                        </div>
                    </section>
                </div>
                <!-- LEFT COLUMN END -->
                <!-- BEGIN RIGHT COLUMN -->
                <aside class="checkout-page__right checkout-page__right_more">
                    <section class="your-order">
                        <h3 class="your-order__title">Đơn hàng của bạn</h3>
                        <div class="side-cart">
                            <?php $total = 0; $cart = session()->get('cart_old'); ?>
                            @foreach($cart as $item)
                                @php $book = \App\Book::find($item['book_id']) @endphp
                                <article class="side-cart__item">
                                    <div class="side-cart__cols">
                                        <div class="side-cart__left">
                                            <a class="side-cart__image-link" href="{{'buy', $book['id']}}">
                                                <img class="side-cart__image" src="{{asset('/images/' . $book['hinhanh'])}}"
                                                     alt="">
                                            </a>
                                        </div>
                                        <div class="side-cart__right">
                                            <h4 class="side-cart__title">
                                                <a class="side-cart__link" href="{{'buy', $book['id']}}">{{$book['name']}}</a>
                                            </h4>
                                            <span class="side-cart__text">x{{$item['qty']}}</span>
                                            <div class="side-cart__prices">
                                                <span class="side-cart__price">{{number_format($book['giaban']) . ' VNĐ'}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                                <?php $total += $item['qty'] * $book['giaban']; ?>
                            @endforeach
                        </div>
                        <ul class="your-order__list">
                            <div class="your-order__bottom">
                                <div class="your-order__col">
                                    <span class="your-order__bottom-text">Tổng cộng</span>
                                </div>
                                <div class="your-order__col">
                                    <span class="your-order__bottom-price">{{number_format($total) . ' VNĐ' }}</span>
                                </div>
                            </div>
                        </ul>
                    </section>
                </aside>
            </div>
        </div>

    </main>
    <!-- BEGIN CHECKOUT -->
    <!-- CHECKOUT END -->
@endsection
