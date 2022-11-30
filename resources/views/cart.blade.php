@extends('layouts.layout')
@section('content')
    <main class="main">
        <div class="cart-page wrapper">
            <div class="cart-page__cols">
                <!-- BEGIN LEFT COLUMN -->
                <div class="cart-page__left">
                    <div class="cart-table wishlist">

                        @if($items = Session::get('cart'))
                            @foreach($items as $item)
                                @php
                                    $book = \App\Book::find($item['book_id'])
                                @endphp
                                <article class="wishlist__item js-remove">
                                    <div class="wishlist__cols">
                                        <div class="wishlist__left">
                                            <img class="wishlist__image"
                                                 src="{{asset('images/' . $book->hinhanh)}}" alt="{{$book->name}}">

                                        </div>
                                        <div class="wishlist__right">
                                            <div class="wishlist__top wishlist__top_cart">
                                                <div class="wishlist__col">
                                                    <h2 class="wishlist__title">
                                                        <a class="wishlist__link"
                                                           href="{{route('buy', $book->id)}}">{{$book->name}}</a>
                                                    </h2>
                                                </div>
                                                <div class="wishlist__col">
                                                    <a class="wishlist__remove remove-button js-remove-button"
                                                       href="{{route('cart.delete', $book->id)}}"></a>
                                                </div>
                                            </div>
                                            <div class="wishlist__bottom wishlist__bottom_cart">
                                                <div class="wishlist__cart-col">
                                                    <span
                                                        class="wishlist__price wishlist__price_small">{{number_format($book->giaban) . ' VNĐ'}}</span>
                                                </div>
                                                <div class="wishlist__cart-col">
                                                    <div class="wishlist__count count js-count">
                                                        <button class="count__button count__button_minus js-count-minus"
                                                                data-id="{{$book->id}}" data-type="-"></button>
                                                        <input class="count__input js-count-input" type="text"
                                                               value="{{$item['qty']}}" id="qty-{{$book->id}}"
                                                               data-max="{{$book->soluong}}" maxlength="4">
                                                        <button class="count__button count__button_plus js-count-plus"
                                                                data-id="{{$book->id}}" data-type="+"></button>
                                                    </div>
                                                </div>
                                                <div class="wishlist__cart-col">
                                                <span
                                                    class="wishlist__price wishlist__price_total"
                                                    id="cost-{{$book->id}}">{{number_format($item['qty'] * $book->giaban) . ' VNĐ'}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        @else
                            <h3>Chưa có sản phẩm nào</h3>
                        @endif
                    </div>


                    <div class="cart-socials socials">
                        <span class="cart-socials__text socials__text">Mạng xã hội:</span>
                        <ul class="cart-socials__list socials__list">
                            <li class="socials__item">
                                <a class="socials__link" href="https://fb.com/binh.hothai.39">Fb</a>
                            </li>
                            <li class="socials__item">
                                <a class="socials__link" href="https://www.instagram.com/binh.hothai.204/">Ins</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- LEFT COLUMN END -->
            @if(session()->get('cart') != null)
                    <aside class="cart-page__right">
                        <section class="your-order">
                            <h3 class="your-order__title">Đơn hàng của bạn</h3>

                            <div class="your-order__bottom">
                                <div class="your-order__col">
                                    <span class="your-order__bottom-text">Tổng tiền</span>
                                </div>
                                <div class="your-order__col">
                                <span class="your-order__bottom-price"
                                      id="total">{{number_format(Session::get('total')) . ' VNĐ'}}</span>
                                </div>
                            </div>
                            <a class="your-order__button button" href="{{route('cart.create_order')}}">
                                <span class="button__text">Đặt hàng</span>
                            </a>
                            <div id="paypal-button-container"></div>

                            <!-- Include the PayPal JavaScript SDK -->
                            <script
                                src="https://www.paypal.com/sdk/js?client-id=AZUhv2DMf2w53vpzdTrvYTtIog91TiV9huprdxxBLaOh-n2fO6AThNvDgKhvNOmwmI8Ofv8CsC2MZ-Vp&currency=USD"></script>
                            <script>
                                // Render the PayPal button into #paypal-button-container
                                paypal.Buttons({
                                    // Call your server to set up the transaction
                                    createOrder: function (data, actions) {
                                        return fetch("{{route('paypal.create_order')}}", {
                                            method: 'post',
                                        }).then(function (res) {
                                            return res.json();
                                        }).then(function (orderData) {
                                            return orderData.id;
                                        });
                                    },

                                    // Call your server to finalize the transaction
                                    onApprove: function (data, actions) {
                                        return fetch("{{route('paypal.capture')}}", {
                                            method: 'post',
                                            body: JSON.stringify({
                                                    orderId : data.orderID
                                                })
                                        }).then(function (res) {
                                            console.log('Capture result', res, JSON.stringify(res, null, 2));
                                            return res.json();
                                        }).then(function (orderData) {

                                            var errorDetail = Array.isArray(orderData.details) && orderData.details[0];

                                            if (errorDetail && errorDetail.issue === 'INSTRUMENT_DECLINED') {
                                                return actions.restart(); // Recoverable state, per:
                                                // https://developer.paypal.com/docs/checkout/integration-features/funding-failure/
                                            }

                                            if (errorDetail) {
                                                var msg = 'Sorry, your transaction could not be processed.';
                                                if (errorDetail.description) msg += '\n\n' + errorDetail.description;
                                                if (orderData.debug_id) msg += ' (' + orderData.debug_id + ')';
                                            }

                                            // Successful capture! For demo purposes:
                                            console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                                            actions.redirect("{{route('checkout')}}");
                                        });
                                    }

                                }).render('#paypal-button-container');
                            </script>
                        </section>
                    </aside>

            @endif
            <!-- BEGIN RIGHT COLUMN -->
                <!-- RIGHT COLUMN END -->

            </div>

        </div>

    </main>
    <!-- BEGIN CART -->
    <!-- CART END -->


@endsection
