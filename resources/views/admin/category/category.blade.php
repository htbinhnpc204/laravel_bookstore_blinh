@extends('admin.layout')
@section('content')
    @include('message.flash')
    <div class="col-lg-6 col-7 pt-3">
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item"><span class="text-dark">Quản lý chủ đề</span></li>
            </ol>
        </nav>
    </div>

    <div class="container-fluid">
        <!-- blank-page -->
        <div class="row">
            <div class="col-md-8">
                <p>Tổng số chủ đề: <strong>{{$num}}</strong></p>
            </div>
        </div>
        <div class="row">
            <form class="form-horizontal col-md-8" method="post" action="{{route('category.add')}}">
                {{csrf_field()}}
                <label>
                    <input type="text" class="form-control" name="name" placeholder="Tên chủ đề"/>
                </label>
                <input type="submit" value="+Thêm chủ đề" class="btn btn-primary text-white">
            </form>
            {{--                <a class="btn btn-primary text-white" type="submit" data-toggle="modal" data-target="#myModal_product">+Thêm chủ đề</a>--}}
        </div>
        @if ($message = Session::get('notification'))
            <div class="alert alert-success">
                <span id="msg">{{ $message }}</span>
            </div>
        @endif
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
                <table id="user" class="table table table-striped table-bordered table-responsive-md">
                    <thead>
                    <tr>
                        <th colspan="1">STT</th>
                        <th colspan="1">Tên chủ đề</th>
                        <th colspan="2" class="text-center">Hành động</th>
                    </tr>
                    </thead>
                    <tbody id="myData">
                    @foreach($paginator as $item)
                        <tr>
                            <td colspan="1"><strong>{{$stt++}}</strong></td>
                            <td colspan="1"><strong>{!! $item->category_name !!}</strong></td>
                            <td colspan="1" class="text-center">
                                <button class="btn btn-success text-white openModal" type="button" data-toggle="modal"
                                        data-target="#editName" data-id="{{$item->id}}" data-name="{!! $item->category_name !!}">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <a class="btn btn-danger"
                                   onclick="return confirm('Bạn có chắc muốn xóa {{$item->category_name}}?')"
                                   href="{{route('category.delete', $item->id)}}">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $paginator->links() }}
            </div>
        </div>
    </div>

    <div class="modal fade" id="editName" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cập nhật chủ đề</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="categoryEdit" method="post">
                        @csrf
                        <div class="mb-3">
                            <label>Tên chủ đề</label>
                            <input type="text" class="form-control" id="nameR" name="name" required>
                        </div>
                        <input type="hidden" name="id" id="cateId"/>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
