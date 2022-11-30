@extends('admin.layout')
@section('content')

    <div class="col-lg-6 col-7 pt-3">
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item"><span class="text-dark">Quản lý tài khoản</span></li>
            </ol>
        </nav>
    </div>
    @include('message.flash')
    <div class="container-fluid">
        <!-- blank-page -->
        <div class="row">
            <div class="col-md-8">
                <p>Tổng số thành viên: <strong>{{$num}}</strong></p>
            </div>
        </div>
        <a class="btn btn-primary text-white" type="submit" data-toggle="modal" data-target=".bd-add-modal-lg">+Thêm
            thành viên</a>
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
                        <th colspan="1">Tài khoản</th>
                        <th colspan="1">Mật khẩu</th>
                        <th colspan="1">Email</th>
                        <th colspan="1">Quyền</th>
                        <th colspan="3" class="text-center">Hành động</th>
                    </tr>
                    </thead>
                    <tbody id="myData">
                    @foreach($users as $item)
                        <tr>
                            <td colspan="1"><strong>{{   $stt++  }}</strong></td>
                            <td colspan="1"><strong>{!! $item->user !!}</strong></td>
                            <td colspan="1"><strong>{!! $item->password !!}</strong></td>
                            <td colspan="1"><strong>{!! $item->email !!}</strong></td>
                            @foreach($roles as $role)
                                @if($role->id == $item->role_id)
                                    <td colspan="1"><strong>{{ $role->roleName }}</strong></td>
                                @endif
                            @endforeach
                            <td colspan="1" class="text-center">
                                <a class="btn btn-success" href="{{route('user.edit', $item->id)}}"><i
                                        class="fa fa-edit"></i> </a>
                                <a class="btn btn-danger"
                                   onclick="return confirm('Bạn có chắc muốn xóa {{$item->user}}?')"
                                   href="{{route('user.delete', $item->id)}}">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="modal fade bd-add-modal-lg" id="viewBook" tabindex="-1"
                     role="dialog" aria-labelledby="myLargeModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"
                                    id="exampleModalLabel">{{'Thêm người dùng'}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{route('user.store')}}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="table">
                                        <div class="row">
                                            <span class="col-sm-3">Tài khoản: </span>
                                            <label class="w-75"><input type="text" class="form-control"
                                                                       name="user"></label>
                                        </div>
                                        <div class="row">
                                            <span class="col-sm-3">Mật khẩu: </span>
                                            <label class="w-75"><input type="password" class="form-control"
                                                                       name="password"></label>
                                        </div>
                                        <div class="row">
                                            <span class="col-sm-3">Quyền: </span>
                                            <select class="form-control w-25 mb-2" name="role_id">
                                                @foreach($roles as $role)
                                                    <option value="{!! $role->id !!}">{!! $role->roleName !!}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="row">
                                            <span class="col-sm-3">Email: </span>
                                            <label class="w-75"><input type="text" class="form-control"
                                                                       name="email"></label>
                                        </div>
                                        <div class="float-right">
                                            <button class="btn btn-primary" data-dismiss="modal">Đóng</button>
                                            <input type="submit" name="save" class="btn btn-success"
                                                   value="Thêm thành viên">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{ $users->links() }}
            </div>
        </div>


    </div>
@endsection
