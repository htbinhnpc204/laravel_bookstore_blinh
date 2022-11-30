@extends('admin.layout')
@section('content')
    @include('message.flash')
    <div class="col-lg-6 col-7 pt-3">
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.order')}}">Quản lý đơn hàng</a></li>
                <li class="breadcrumb-item"><span class="text-dark">Chi tiết đơn hàng</span></li>
            </ol>
        </nav>
    </div>

    <div class="container-fluid">
        <!-- blank-page -->
        <div class="row">
            <div class="col-md-8">
                <p>Tổng số sách trong đơn hàng: <strong>{{$num}}</strong></p>
            </div>
        </div>
        <div class="well mt-1">
            <div class="w3l-table-info">
                <label>Số lượng mỗi trang:
                    <form action="" method="get">
                        <select class="form-control" name="itemPerPage" onchange="this.form.submit()">
                            @for($i = 5; $i <= 30; $i +=5)
                                <option {{$itemPerPage == $i ? 'selected' : ''}}>{!! $i !!}</option>
                            @endfor
                        </select>
                    </form>
                </label>
                <div class="d-flex float-right"> <strong>Tổng tiền: </strong> {{'' . number_format($totalPrice) . ' VNĐ'}}</div>

                <table id="dataTable" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th colspan="1">STT</th>
                        <th colspan="1">Tên sách</th>
                        <th colspan="1">Hình ảnh</th>
                        <th colspan="1">Đơn giá</th>
                        <th colspan="1">Số lượng</th>
                    </tr>
                    </thead>
                    <tbody id="myData">
                    @foreach($list as $item)
                        <tr>
                            <td colspan="1"><strong>{{   $stt++  }}</strong></td>
                            <td colspan="1"><strong>{!! $item->name !!}</strong></td>
                            <td colspan="1"><img src="{!! asset('images/' . $item->hinhanh) !!}"
                                                 alt="{!! $item->name !!}"
                                width="100" height="100"></td>
                            <td colspan="1"><strong>{!! number_format($item->giaban) . ' VNĐ' !!}</strong></td>
                            <td colspan="1"><strong>{{ $item->quantity }}</strong></td>
                    @endforeach
                    </tbody>
                </table>


                {{ $list->links() }}
            </div>
        </div>


    </div>
@endsection
