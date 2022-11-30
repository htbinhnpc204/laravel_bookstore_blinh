@extends('layouts.layout')

@section('content')

    <!-- REGISTER LOGIN -->
    <div class="login-page">
        <div class="login-page__all">
            <div class="login-page__banner" data-bg="https://via.placeholder.com/1680x500"></div>
            <div class="login-page__main">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="login-form login-form_reg">
                        <div class="login-form__top">
                            <h2 class="login-form__title">Đăng ký nhanh</h2>
                        </div>
                        <div class="login-form__label">
                            <div class="login-form__label">
                                <input class="text-input" name="name" type="text" placeholder="Họ và tên">
                            </div>
                        </div>
                        <div class="login-form__label">
                            <div class="login-form__label">
                                <input class="text-input" name="user" type="text" placeholder="Tên đăng nhập">
                            </div>
                        </div>
                        <div class="login-form__label">
                            <div class="login-form__label">
                                <input class="text-input" name="email" type="email" placeholder="Nhập email">
                            </div>
                        </div>
                        <span class="login-form__label">Mật khẩu</span>
                        <div class="login-form__cols">
                            <div class="login-form__col">
                                <input class="text-input" name="password" type="password" placeholder="Mật khẩu">
                            </div>
                            <div class="login-form__col">
                                <input class="text-input" id="password-confirm" name="password_confirmation" required
                                       type="password" placeholder="Xác nhận mật khẩu">
                            </div>
                        </div>
                        <div class="login-form__bottom">
                            <div class="login-form__col">
                                <div class="login-form__checkbox checkbox">
                                    <label class="checkbox__label">
                                    </label>
                                </div>
                            </div>
                            <div class="login-form__col">
                                        <span class="login-form__small-text">
                                            Đã có tài khoản? <a href="{{route('login')}}">Đăng nhập</a>
                                        </span>
                            </div>
                        </div>
                        <button class="login-form__button button" type="submit">
                            <span class="button__text">Dăng ký</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- REGISTER END -->
@endsection
