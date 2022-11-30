@extends('layouts.layout')
@section('content')
    <!-- BEGIN LOGIN -->
    <main class="main">
        <div class="login-page">
            <div class="login-page__all">
                <div class="login-page__main">
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="login-form ml-auto mr-auto">
                            <div class="login-form__top">
                                <h2 class="login-form__title">Đăng nhập vào website</h2>
                            </div>
                            <ul class="socials-nav">
                                <li class="socials-nav__item">
                                    <a class="socials-nav__link socials-nav__link_icon-1" href="#"></a>
                                </li>
                                <li class="socials-nav__item">
                                    <a class="socials-nav__link socials-nav__link_icon-2" href="#"></a>
                                </li>
                                <li class="socials-nav__item">
                                    <a class="socials-nav__link socials-nav__link_icon-3" href="#"></a>
                                </li>
                                <li class="socials-nav__item">
                                    <a class="socials-nav__link socials-nav__link_icon-4" href="{{ route('login.provider', 'google') }}"></a>
                                </li>
                            </ul>
                            <input class="text-input" name="user" type="text" placeholder="Enter your email">
                            <input class="text-input" name="password" type="password" placeholder="Enter your password">
                            <div class="login-form__bottom">
                                <div class="login-form__col">
                                    <div class="login-form__checkbox checkbox">
                                        <label class="checkbox__label">
                                            <input class="checkbox__input" type="checkbox">
                                            <span class="checkbox__icon"></span>
                                            <span class="checkbox__text">Nhớ tài khoản</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="login-form__col">
                                        <span class="login-form__small-text">
                                            <a href="{{route('register')}}">Đăng ký</a>
                                        </span>
                                </div>
                            </div>
                            <button class="login-form__button button" type="submit">
                                <span class="button__text">Đăng nhập</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <!-- LOGIN END -->
@endsection
