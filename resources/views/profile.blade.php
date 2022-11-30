@extends('layouts.layout')
@section('content')
    <!-- BEGIN WISHLIST -->
    <main class="main">
        <section class="main-block wrapper">
            <div class="main-block__top">
                <h3 class="main-block__title">Thông tin cá nhân</h3>
            </div>
            <div class="profile-page wrapper">
                <div class="profile-page__cols">
                    <!-- BEGIN LEFT COLUMN -->
                    <div class="profile-page__left">
                        <div class="profile-nav tabs-nav js-line">
                            <ul class="profile-nav__list tabs-nav__list tabs-nav__list_left">
                                <li class="tabs-nav__item js-tabs-item js-line-item active">
                                    <a class="tabs-nav__link js-line-link js-tabs-link" href="#profile-tab-1">Thông tin
                                        cá
                                        nhân</a>
                                </li>
                                <li class="tabs-nav__item js-line-item js-tabs-item">
                                    <a class="tabs-nav__link js-line-link js-tabs-link" href="#profile-tab-2">Lịch sử
                                        mua
                                        hàng</a>
                                </li>
                            </ul>
                            <div class="tabs-nav__line js-line-element"></div>
                        </div>
                    <?php $user = Auth::user(); ?>
                    <!-- BEGIN TAB 1-->
                        <div class="profile-tab js-tabs-content active" id="profile-tab-1">
                            <div class="float-left w-50 p-3 d-block">
                                <img src="https://i.pinimg.com/564x/0b/66/31/0b6631f08d3d4a62867861bdcd300bba.jpg"
                                     class="imgAvatar" alt="{{$user->name}}">
                            </div>
                            <div class="left">
                                <p class="newsletter-block__text">Họ và tên: <strong>{{$user->name}}</strong></p>
                                <p class="newsletter-block__text">Địa
                                    chỉ: {{$user->profile->diachi ?? 'Chưa cập nhật'}}</p>
                                <p class="newsletter-block__text">Số điện
                                    thoại: {{$user->profile->sdt ?? 'Chưa cập nhật'}}</p>
                                <p class="newsletter-block__text">Địa chỉ email: {{$user->email}}</p>
                                <a class="newsletter-block__button button" href="{{route('profile.update')}}">
                                    <span class="button__text">Cập nhật thông tin cá nhân</span>
                                </a>
                            </div>
                        </div>
                        <!-- TAB 1 END -->
                        <!-- BEGIN TAB 2-->
                        <div class="profile-tab js-tabs-content" id="profile-tab-2">
                            <div class="orders js-faq">
                                @forelse($histories as $item)
                                    <div class="order js-faq-item">
                                        <div class="order__top">
                                            <a class="order__button js-faq-button" href="javascript:void(0);">
                                                <div class="order-header">
                                                    <div class="order-header__col">
                                                        <span
                                                            class="order-header__number">Đơn hàng số: {{$item->id}}</span>
                                                    </div>
                                                    <div class="order-header__col">
                                                        <span class="order-header__date">{{$item->created_at}}</span>
                                                    </div>
                                                    <div class="order-header__col">
                                                        @if($item->status == 'Đang chờ')
                                                            <div class="order-header__status order-status orange">
                                                                <div class="order-status__cols">
                                                                    <div
                                                                        class="order-status__col">{{$item->status}}</div>
                                                                    <div class="order-status__col">
                                                                        <img class="order-status__icon"
                                                                             data-lazy="{{asset('assets/user/img/svg/order-icon_1.svg')}}"
                                                                             alt="" style="width:24px; height:19px;">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <div class="order-header__status order-status green">
                                                                <div class="order-status__cols">
                                                                    <div
                                                                        class="order-status__col">{{$item->status}}</div>
                                                                    <div class="order-status__col">
                                                                        <img class="order-status__icon"
                                                                             data-lazy="{{asset('assets/user/img/svg/order-icon_2.svg')}}"
                                                                             alt="" style="width:24px; height:19px;">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="order__hide js-faq-hide">
                                            <div class="order__content">
                                                <?php $total = 0; ?>
                                                <div class="order-table">
                                                    <?php $details = \App\OrderDetails::where('order_id', $item->id)->get(); ?>
                                                    @foreach($details as $detail)
                                                        <?php $book = \App\Book::find($detail->book_id); ?>
                                                        <article class="order-table__item">
                                                            <div class="order-table__cols">
                                                                <div class="order-table__col">
                                                                    <a class="order-table__image-link"
                                                                       href="{{route('buy', $book->id)}}">
                                                                        <img class="order-table__image"
                                                                             src="{{asset('/images/' . $book->hinhanh)}}"
                                                                             alt="">
                                                                    </a>
                                                                </div>
                                                                <div class="order-table__col">
                                                                    <h4 class="order-table__title">
                                                                        <a class="order-table__link"
                                                                           href="{{route('buy', $book->id)}}">{{$book->name}}</a>
                                                                    </h4>
                                                                    <span
                                                                        class="order-table__text">x{{$detail->quantity}}</span>
                                                                </div>
                                                                <div class="order-table__col">
                                                                    <span
                                                                        class="order-table__price">{{number_format($book->giaban) . ' VNĐ'}}</span>
                                                                </div>
                                                                @if(!$detail->rStatus && $item->status == 'Đã duyệt')
                                                                    <div class="order-table__col">
                                                                        <a type="button" href="#" data-toggle="modal"
                                                                           data-target="#exampleModal">
                                                                            <i class="fa fa-comments"></i>
                                                                        </a>
                                                                        <div class="modal fade" id="exampleModal"
                                                                             tabindex="-1" role="dialog"
                                                                             aria-labelledby="exampleModalLabel"
                                                                             aria-hidden="true">
                                                                            <div class="modal-dialog" role="document">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title"
                                                                                            id="exampleModalLabel">Đánh giá sách {!! \App\Book::find($detail->book_id)->first()->name !!}</h5>
                                                                                        <button type="button"
                                                                                                class="close"
                                                                                                data-dismiss="modal"
                                                                                                aria-label="Close">
                                                                                            <span aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <?php $result = DB::table('orders')->where('orders.user_id', \auth()->user()->id)
                                                                                            ->join('order_details', 'order_details.order_id', '=', 'orders.id')
                                                                                            ->where('order_details.book_id', $book->id); ?>
                                                                                        @if(count($result->get()) > 0)
                                                                                            <form
                                                                                                action="{{route('review', $detail)}}"
                                                                                                method="post">
                                                                                                <section
                                                                                                    class="add-review">
                                                                                                    <div
                                                                                                        class="add-review__top">
                                                                                                        <h3 class="add-review__title">
                                                                                                            Leave a
                                                                                                            review</h3>
                                                                                                        <p class="add-review__text">
                                                                                                            Write us
                                                                                                            your
                                                                                                            impressions
                                                                                                            of&nbsp;the&nbsp;purchase</p>
                                                                                                        @csrf
                                                                                                        <div
                                                                                                            id="rating">
                                                                                                            <input
                                                                                                                type="radio"
                                                                                                                id="star5"
                                                                                                                name="rating"
                                                                                                                value="5"/>
                                                                                                            <label
                                                                                                                class="full"
                                                                                                                for="star5"
                                                                                                                title="Awesome - 5 stars"></label>

                                                                                                            <input
                                                                                                                type="radio"
                                                                                                                id="star4half"
                                                                                                                name="rating"
                                                                                                                value="4.5"/>
                                                                                                            <label
                                                                                                                class="half"
                                                                                                                for="star4half"
                                                                                                                title="Pretty good - 4.5 stars"></label>

                                                                                                            <input
                                                                                                                type="radio"
                                                                                                                id="star4"
                                                                                                                name="rating"
                                                                                                                value="4"/>
                                                                                                            <label
                                                                                                                class="full"
                                                                                                                for="star4"
                                                                                                                title="Pretty good - 4 stars"></label>

                                                                                                            <input
                                                                                                                type="radio"
                                                                                                                id="star3half"
                                                                                                                name="rating"
                                                                                                                value="3.5"/>
                                                                                                            <label
                                                                                                                class="half"
                                                                                                                for="star3half"
                                                                                                                title="Meh - 3.5 stars"></label>

                                                                                                            <input
                                                                                                                type="radio"
                                                                                                                id="star3"
                                                                                                                name="rating"
                                                                                                                value="3"/>
                                                                                                            <label
                                                                                                                class="full"
                                                                                                                for="star3"
                                                                                                                title="Meh - 3 stars"></label>

                                                                                                            <input
                                                                                                                type="radio"
                                                                                                                id="star2half"
                                                                                                                name="rating"
                                                                                                                value="2.5"/>
                                                                                                            <label
                                                                                                                class="half"
                                                                                                                for="star2half"
                                                                                                                title="Kinda bad - 2.5 stars"></label>

                                                                                                            <input
                                                                                                                type="radio"
                                                                                                                id="star2"
                                                                                                                name="rating"
                                                                                                                value="2"/>
                                                                                                            <label
                                                                                                                class="full"
                                                                                                                for="star2"
                                                                                                                title="Kinda bad - 2 stars"></label>

                                                                                                            <input
                                                                                                                type="radio"
                                                                                                                id="star1half"
                                                                                                                name="rating"
                                                                                                                value="1.5"/>
                                                                                                            <label
                                                                                                                class="half"
                                                                                                                for="star1half"
                                                                                                                title="Meh - 1.5 stars"></label>

                                                                                                            <input
                                                                                                                type="radio"
                                                                                                                id="star1"
                                                                                                                name="rating"
                                                                                                                value="1"/>
                                                                                                            <label
                                                                                                                class="full"
                                                                                                                for="star1"
                                                                                                                title="Sucks big time - 1 star"></label>

                                                                                                            <input
                                                                                                                type="radio"
                                                                                                                id="starhalf"
                                                                                                                name="rating"
                                                                                                                value="half"/>
                                                                                                            <label
                                                                                                                class="half"
                                                                                                                for="starhalf"
                                                                                                                title="Sucks big time - 0.5 stars"></label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <textarea
                                                                                                        class="textarea"
                                                                                                        placeholder="Enter your feedback"
                                                                                                        name="comment"></textarea>
                                                                                                    <button
                                                                                                        type="submit"
                                                                                                        class="add-review__button button float-right">
                                                                                                            <span
                                                                                                                class="button__text">Đánh giá</span>
                                                                                                    </button>
                                                                                                </section>
                                                                                            </form>
                                                                                        @endif
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </article>
                                                        <?php $total += $book->giaban * $detail->quantity; ?>
                                                    @endforeach
                                                </div>
                                                <div class="order-total">
                                                    <div class="order-total__item">
                                                        <div class="order-total__col">
                                                            <span class="order-total__title">Tổng tiền:</span>
                                                        </div>
                                                        <div class="order-total__col">
                                                            <div
                                                                class="order-total__price">{{number_format($total) . ' VNĐ'}}</div>
                                                        </div>
                                                    </div>
                                                    <div class="order-total__item">
                                                        <div class="order-total__col">
                                                            <span class="order-total__title">Địa chỉ nhận hàng:</span>
                                                        </div>
                                                        <div class="order-total__col">
                                                            <div
                                                                class="order-total__text">{{Auth::user()->profile->diachi ?? ""}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <span class="order-header__number">Bạn chưa có đơn hàng nào, hãy đặt hàng ở cửa hàng chúng mình nhé !!</span>
                                @endforelse
                            </div>
                        </div>
                        <!-- TAB 2 END -->
                    </div>
                    <!-- LEFT COLUMN END -->
                </div>
            </div>
        </section>
    </main>

    <!-- WISHLIST END -->
@endsection
