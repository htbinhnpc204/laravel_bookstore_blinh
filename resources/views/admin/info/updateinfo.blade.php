@extends('admin.layout')
@section('content')
    @include('message.flash')
    <div class="container-fluid">
        <div class="header-body">
            <div class="row justify-content-center">
                <h6 class="h1 d-inline-block mb-5">Cập nhật thông tin cá nhân</h6>
            </div>
            <!-- Form start Start -->
            <div class="panel panel-widget forms-panel">
                <div class="forms">
                    <div class=" form-grids form-grids-right">
                        <div class="widget-shadow " data-example-id="basic-forms">
                            <form class="form-horizontal" method="POST"
                                  action="{!! route('profile.doUpdate',$user->id) !!}" id="">
                                @csrf
                                <div class="form-body">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="control-label">Tên người dùng</label>
                                            <input type="text" name="user_name" class="form-control" id="name"
                                                   value="{{$user->name ?? ''}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="control-label">Số điện thoại</label>
                                            <input type="text" name="sdt" class="form-control" id="name"
                                                   value="{{$user->profile->sdt ?? ''}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="control-label">Địa chỉ</label>
                                            <input type="text" name="diachi" class="form-control" id="name"
                                                   value="{{$user->profile->diachi ?? ''}}" required>
                                    </div>
                                    <div class="form-group d-flex justify-content-center">
                                        <input class="btn btn-primary" type="submit" value="Cập nhật">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
