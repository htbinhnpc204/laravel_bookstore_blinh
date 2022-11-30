@extends('admin.layout')
@section('content')
    <div class="col-lg-6 col-7 pt-3">
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.user')}}">Quản lý người dùng</a></li>
                <li class="breadcrumb-item"><span class="text-dark">Chỉnh sửa</span></li>
            </ol>
        </nav>
    </div>
    @include('message.flash')

    <div class="container-fluid">
        <form method="POST" action="{{route('user.update')}}"
              enctype="multipart/form-data">
            @csrf
            <input type="hidden" value="{{$model->id}}" name="id">
            <div class="table">
                <div class="row">
                    <span class="col-sm-3">Tài khoản: </span>
                    <label class="w-75"><input type="text" class="form-control"
                                               name="user" value="{{$model->user}}"></label>
                </div>
                <div class="row">
                    <span class="col-sm-3">Mật khẩu: </span>
                    <label class="w-75"><input type="password" class="form-control" placeholder="Nhập mật khẩu"
                                               name="password"></label>
                </div>
                <div class="row">
                    <span class="col-sm-3">Dạng tài khoản: </span>
                    <select class="form-control w-25 mb-2" name="role_id">
                        @foreach($roles as $role)
                            @if($role->id == $model->role_id)
                                <option value="{!! $role->id !!}" selected>{!! $role->roleName !!}</option>
                            @else
                                <option value="{!! $role->id !!}">{!! $role->roleName !!}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="row">
                    <span class="col-sm-3">Email: </span>
                    <label class="w-75"><input type="text" class="form-control"
                                               name="email" value="{{$model->email}}"></label>
                </div>
                <div class="row mb-2 justify-content-center">
                    <a href="{{route('admin.user')}}" class="btn btn-primary">Quay lại</a>
                    <input type="submit" name="save" class="btn btn-success"
                           value="Cập nhật">
                </div>
            </div>
        </form>
    </div>
@endsection
