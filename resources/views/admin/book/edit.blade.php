@extends('admin.layout')
@section('content')
    @include('message.flash')
    <div class="col-lg-6 col-7 pt-3">
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.book')}}">Quản lý sách</a></li>
                <li class="breadcrumb-item"><span class="text-dark">Chỉnh sửa</span></li>
            </ol>
        </nav>
    </div>
    <div class="container-fluid">
        <form method="POST" action="{{route('book.store')}}"
              enctype="multipart/form-data">
            @csrf
            <div class="table">
                <input type="hidden" name="book_id" value="{!! $model->id !!}">
                <div class="row">
                    <span class="col-sm-2">Tên sách: </span>
                    <label class="col-sm-10"><input type="text" class="form-control"
                                               name="name"
                                               value="{!! $model->name !!}"></label>
                </div>
                <div class="row">
                    <span class="col-sm-2">Tác giả: </span>
                    <label class="col-sm-10"><input type="text" class="form-control"
                                               name="tacgia"
                                               value="{!! $model->tacgia !!}"
                        ></label>
                </div>
                <div class="row">
                    <span class="col-sm-2">Chủ đề: </span>
                    <label class="col-sm-2">
                        <select class="form-control " name="category_id">
                            @foreach($categories as $category)
                                @if($model->category_id == $category->id)
                                    <option value="{!! $category->id !!}"
                                            selected>{!! $category->category_name !!}</option>
                                @else
                                    <option
                                        value="{!! $category->id !!}">{!! $category->category_name !!}</option>
                                @endif
                            @endforeach
                        </select>
                    </label>
                </div>
                <div class="row">
                    <span class="col-sm-2">Giá bán: </span>
                    <label class="col-sm-10"><input type="text" class="form-control"
                                               name="giaban"
                                               value="{!! $model->giaban !!}"
                        ></label>
                </div>
                <div class="row">
                    <span class="col-sm-2">Số lượng: </span>
                    <label class="col-sm-10"><input type="text" class="form-control"
                                               name="soluong"
                                               value="{!! $model->soluong !!}"
                        ></label>
                </div>
                <div class="row">
                    <span class="col-sm-2">Nhà xuất bản: </span>
                    <label class="col-sm-10"><input type="text" class="form-control"
                                               name="nxb"
                                               value="{!! $model->nxb !!}"></label>
                </div>
                <div class="row">
                    <span class="col-sm-2">Tái bản: </span>
                    <label class="col-sm-10"><input type="text" class="form-control" name="taiban"
                                               value="{!! $model->taiban !!}"
                        ></label>
                </div>
                <div class="row">
                    <span class="col-sm-2">Hình ảnh: </span>
                    <label class="col-sm-10">
                        <input  type="file" name="hinhanh" id="hinhanh" accept="image/*">
                        <span class="card-img mt-2">
                            <img src="{!! asset('images/' . $model->hinhanh) !!}" alt="{!! $model->name !!}"
                                 width="150" height="150" id="preview" >
                        </span>

                    </label>
                </div>
                <div class="row">
                    <span class="col-sm-2">Mô tả: </span>
                    <label class="col-sm-10"><textarea type="text" class="form-control"
                                                  name="description" id="areas"
                        >{!! $model->gioithieu !!}</textarea></label>

                    <script>CKEDITOR.replace( 'areas' );</script>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <a href="#" class="btn btn-default">Quay lại</a>
                <input type="submit" name="save" class="btn btn-success" value="Cập nhật">
            </div>
        </form>
    </div>
@endsection
