@extends('layouts.layout')
@section('content')
<div class="login-page">
        <div class="login-page__all">
            <div class="login-page__main">
                @include('message.flash')
                <form class="form-horizontal" method="POST"
                                  action="{!! route('profile.doUpdateuser', $user->id) !!}" id="">
                                @csrf
                    <div class="login-form">
                        <div class="login-form__top">
                            <h2 class="login-form__title">Cập nhật thông tin cá nhân</h2>
                        </div>

                        <div class="form-group">
                                        <label for="inputEmail3" class="control-label">Tên người dùng</label>
                                            <input type="text" name="name" class="form-control" id="name"
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
                        <div class="form-group">
                                        <label for="inputEmail3" class="control-label">Email</label>
                                            <input type="text" name="email" class="form-control" id="name"
                                                   value="{{$user->email ?? ''}}" required>
                        </div>
                        <br>
                        <button class="login-form__button button" type="submit">
                            <span class="button__text">Cập Nhật</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
