@extends('admin.layout')
@section('content')
    @include('message.flash')
    <div class="col-lg-6 col-7 pt-3">
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item"><span>Quản lý đơn hàng</span></li>
            </ol>
        </nav>
    </div>

    <div class="container-fluid">
        <!-- blank-page -->
        <div class="row">
            <div class="col-md-8">
                <p>Tổng số đơn hàng: <strong>{{$num}}</strong></p>
            </div>
        </div>
{{--        <a class="btn btn-primary text-white" type="submit" data-toggle="modal" data-target="#addOrder">+Thêm đơn--}}
{{--            hàng</a>--}}
        <div class="well mt-1">
            <div class="w3l-table-info">
                <label>Số lượng mỗi trang:
                    <form action="" method="get">
                        <select class="form-control" name="itemPerPage" onchange="this.form.submit()">
                            @for($i = 5; $i <= 30; $i +=5)
                                <option {{$itemPerPage== $i ? 'selected' : ''}}>{!! $i !!}</option>
                            @endfor
                        </select>
                    </form>
                </label>
                <table id="dataTable" class="table table-striped table-bordered table-responsive-md">
                    <thead>
                    <tr>
                        <th colspan="1">STT</th>
                        <th colspan="1">Tài khoản đặt</th>
                        <th colspan="1">Số lượng sách</th>
                        <th colspan="1">Tổng tiền</th>
                        <th colspan="1">Trạng thái</th>
                        <th colspan="3" class="text-center">Hành động</th>
                    </tr>
                    </thead>
                    <tbody id="myData">
                    @foreach($orders as $item)
                        <tr>
                            <td colspan="1"><strong>{{   $stt++  }}</strong></td>
                            <td colspan="1"><strong>{!! $item->user !!}</strong></td>
                            <td colspan="1"><strong>{!! $item->totalBook !!}</strong></td>
                            <td colspan="1"><strong>{{ number_format($item->totalPrice) . ' VNĐ' }}</strong></td>
                            <td colspan="1"><strong>{!! $item->status !!}</strong></td>
                            <td colspan="1" class="text-center">
                                @if($item->status == 'Đã duyệt')
                                    <a class="btn btn-secondary"><i class="fa fa-check"></i> </a>

                                @else
                                    <a class="btn btn-success" href="{{route('order.approve', $item->id)}}" ><i class="fa fa-check"></i> </a>
                                @endif
                                <a class="btn btn-info" href="{{route('order.view', $item->id)}}" ><i class="fa fa-eye"></i> </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="modal fade" id="addOrder" tabindex="-1"
                     role="dialog" aria-labelledby="myLargeModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"
                                    id="exampleModalLabel">{{'Thêm đơn hàng'}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="" enctype="multipart/form-data">
                                    @csrf
                                    <div class="table">
                                        <div class="row">
                                            <span class="col-sm-3">Tài khoản: </span>
                                            <label class="w-75"><input type="text" class="form-control"
                                                                       name="user"></label>
                                        </div>
                                        <div class="float-right">
                                            <button class="btn btn-primary" data-dismiss="modal">Đóng</button>
                                            <input type="submit" name="save" class="btn btn-success"
                                                   value="Thêm đơn hàng">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{ $orders->links() }}
            </div>
        </div>


    </div>
@endsection
