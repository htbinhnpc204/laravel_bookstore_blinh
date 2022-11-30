@extends('layouts.layout')
@section('product')
    <h1 class="fashion_taital">Trang chủ</h1>
    <div id="main_slider" class=" carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            @php $i = 0 @endphp
            @foreach(array_chunk($books->toArray(), 3, true) as $chunk)
                <div class="carousel-item <?php if ($i == 0) {
                    echo 'active';
                    $i++;
                } ?>">
                    <div class="container">
                        <div class="fashion_section_2">
                            <div class="row">
                                @foreach($chunk as $item)
                                    <div class="col-lg-4 col-sm-4">
                                        <div class="box_main">
                                            <h4 class="shirt_text">{{$item['name']}}</h4>
                                            <p class="price_text">Giá bán: <span
                                                    style="color: #262626;">{{number_format($item['giaban']) . ' VNĐ'}}</span>
                                            </p>
                                            <div class="tshirt_img">
                                                <img width="310" height="310"
                                                     src="{{asset('public/images/' . $item['hinhanh'])}}"
                                                     alt="Hình ảnh sách">
                                            </div>
                                            <div class="btn_main">
                                                <span
                                                    class="seemore_bt lnr-text-align-center">{!! $item['tacgia'] !!}</span>
                                                <div class="buy_bt"><a class="btn btn-primary"
                                                                       href="{{route('buy', $item['id'])}}">Mua sách
                                                        này</a></div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#main_slider" role="button" data-slide="prev">
            <i class="fa fa-angle-left"></i>
        </a>
        <a class="carousel-control-next" href="#main_slider" role="button" data-slide="next">
            <i class="fa fa-angle-right"></i>
        </a>
    </div>

@endsection
