@extends('layouts.layout')
@section('content')
<main class="main">
    <!-- BEGIN PRODUCTS -->
    <section class="main-block wrapper">
        <div class="main-block__top">
            <h3 class="main-block__title">Sách {{\App\Category::find($cd_id)->category_name }}</h3>
        </div>
            <div class="main-catalog">
                <div class="main-catalog__list">
                    @if(count($books) == 0)
                        <h4 class="short-item__title">Danh mục rỗng </h4>
                    @else
                    @foreach($books as $book)
                    <article class="short-item">
                        <div class="short-item__all">
                            <a class="short-item__image-bg" href="{{route('buy', $book['id'])}}">
                                <img class="short-item__image" src="{{'/images/' . $book->hinhanh}}" alt="{{$book->name}}">
                            </a>
                            <h4 class="short-item__title">
                                <a class="short-item__link" href="#">{{$book->name}}</a>
                            </h4>
                            <span class="short-item__price">{{number_format($book->giaban) . ' VNĐ'}}</span>
                        </div>
                    </article>
                    @endforeach
                    @endif
                </div>
            </div>
    </section>
    <!-- PRODUCTS END -->
</main>
<!-- MAIN END -->

@endsection
