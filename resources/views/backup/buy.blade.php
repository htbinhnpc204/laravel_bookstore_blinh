@extends('layouts.layout')
@section('product')
    <div class="container p-3">
        <form action="{{route('cart.add', $book->id)}}" method="post">
            <div class="d-flex flex-row card p-3">
                <div class="col d-flex flex-column align-items-center">
                    <img class="book_img" src="{{asset('public/images/' . $book->hinhanh)}}" alt="hihi">
                    <br>
                    <label><input type="submit" class="btn btn-primary" name="submit" value="Thêm vào giỏ hàng"></label>
                </div>
                <div class="col d-flex flex-column ml-2 w-100">
                    @csrf
                    <span class="h3 text-dark">{{$book->name}}</span>
                    <div class="d-flex flex-row pb-1">
                        <span>Số lượng còn: {!! $book->soluong !!}</span>
                        <span>Số lượng đã bán: {!! $sold !!}</span>
                    </div>
                    <span>Giá bán: <label class="price">{{number_format($book->giaban) . ' VNĐ'}}</label></span>
                    <span>Số lượng: <label>
                        <input class="form-control" type="number" value="1" min="1" max="{{$book->soluong}}"
                               name="quantity">
                    </label></span>
                </div>
            </div>
        </form>
    </div>
    <div class="container">
        <div class="card-no-outline">
            <div class="row">
                <div class="col">
                    <h3 class="h5">Thông tin cơ bản</h3>
                    <p>Sách: {{$book->name}}</p>
                    <p>Tác giả: {{$book->tacgia}}</p>
                    <p>Nhá xuất bản: {{$book->nxb}}</p>
                    <p>Tái bản lần thứ {{$book->taiban}}</p>
                    <hr>
                    <h3 class="h5">Giới thiệu</h3>
                    <p>{!!$book->gioithieu!!}</p>
                </div>
                <div class="col-sm-3">
                    <h3>Sản phẩm nổi bật</h3>
                    <a href="{{route('buy', $pBook->id)}}">
                            <img src="{{asset('public/images/' . $pBook->hinhanh)}}" alt="">
                            {{$pBook->name}}
                    </a>
                </div>
            </div>
        </div>

    </div>

@endsection
