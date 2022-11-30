@extends('layouts.layout')
@section('content')
    <!-- BEGIN SHOP -->
    <div class="shop wrapper">
        <div class="shop__cols">
            <!-- BEGIN LEFT COLUMN -->
            <aside class="shop__left">
                <section class="widget js-slidedown">
                    <h3 class="widget__title widget__title_hide-mob">Khoảng giá</h3>
                    <a class="widget__button js-slidedown-button" href="javascript:void(0);">Khoảng giá</a>
                    <div class="widget__hide js-slidedown-hide">
                        <div class="range">
                            <div class="range__slider" id="range-slider"
                                 data-from="{{\session()->get('filter-ranges') == null ? 0 : \session()->get('filter-ranges')[0]}}"
                                data-to="{{\session()->get('filter-ranges') == null ? 1000000 : \session()->get('filter-ranges')[1]}}"
                            ></div>
                        </div>
                        <span id="range-value"></span>
                    </div>
                </section>

                <section class="widget js-more js-slidedown">
                    <h3 class="widget__title widget__title_hide-mob">Danh mục</h3>
                    <a class="widget__button js-slidedown-button" href="javascript:void(0);">Danh mục</a>
                    <div class="widget__hide js-slidedown-hide">
                        <div class="checkboxes">
                            <?php function isChecked($id, $list) {
                                return (\session()->has('filter-categories') && in_array($id, $list)) ? 'checked' : '';
                            }?>
                            @foreach($categories as $item)
                                <div class="checkbox">
                                    <label class="checkbox__label">
                                        <input class="checkbox__input" type="checkbox" value="{{$item->id}}" {{isChecked($item->id, $category_id)}}>
                                        <span class="checkbox__icon"></span>
                                        <span class="checkbox__text">{{$item->category_name}}</span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        @if(count($categories) > 5)
                        <a class="widget__deploy deploy-button js-more-button" href="#">Xem thêm</a>
                        @endif

                    </div>
                </section>
                <button class="apply-button button">
                    <span class="button__text" id="doFilter">Áp dụng bộ lọc</span>
                </button>

        </aside>
        <!-- LEFT COLUMN END -->

        <!-- BEGIN RIGHT COLUMN -->
        <div class="shop__right" id="product-area">
            @if(session()->has('filter-ranges'))
                <h4 class="short-item__price">
                {!! 'Khoảng giá ' . number_format(intval(\session()->get('filter-ranges')[0])) . ' - ' . number_format(intval(\session()->get('filter-ranges')[1])) . ' VNĐ'!!}
                </h4>
                @endif
            <div class="inner-catalog w-full" >
                @foreach($books as $item)
                    <article class="short-item">
                        <div class="short-item__all">
                            <a class="short-item__image-bg" href="{{route('buy', $item->id)}}">
                                <img class="short-item__image" src="{{asset('/images/' . $item->hinhanh)}}" alt="">
                            </a>
                            <h4 class="short-item__title">
                                <a class="short-item__link" href="{{route('buy', $item->id)}}">{{$item->name}}</a>
                            </h4>
                            <span class="short-item__price">{{number_format($item->giaban) . ' VNĐ'}}</span>
                        </div>
                    </article>
                @endforeach
            </div>
            <div class="page-nav">
                {{$books->links()}}
            </div>
        </div>
        <!-- RIGHT COLUMN END -->
    </div>
    <!-- SHOP END -->
@endsection
