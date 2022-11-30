@extends('admin.layout')
@section('content')
    @include('message.flash')
    <div class="col-lg-6 col-7 pt-3">
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item"><span class="text-dark">Quản lý sách</span></li>
            </ol>
        </nav>
    </div>
    <div class="container-fluid">
        <!-- blank-page -->
        <div class="row">
            <div class="col-md-8">
                <p>Tổng số đầu sách: <strong>{{$num}}</strong></p>
                <p>Tổng số lượng sách: <strong>{{number_format($total)}}</strong></p>
            </div>
            <div class="col">
                <a class="btn btn-primary text-white" type="submit" data-toggle="modal"
                   data-target=".bd-xml-add-modal-lg"><i class="fa fa-plus" aria-hidden="true"></i> Thêm</a>
            </div>
            <div class="col">
                <a class="btn btn-primary text-white" type="submit" data-toggle="modal"
                   data-target=".bd-xml-add-list-modal-lg"><i class="fas fa-file-import"></i> Nhập</a>
            </div>
            <div class="col">
                <a class="btn btn-primary text-white" href="{{route('book.export')}}"><i class="fas fa-file-export"></i> Xuất</a>
            </div>
        </div>

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
                        <th colspan="1">Tên sách</th>
                        <th colspan="1">Tác giả</th>
                        <th colspan="1">Giá bán</th>
                        <th colspan="1">Số lượng</th>
                        <th colspan="3" class="text-center">Hành động</th>
                    </tr>
                    </thead>
                    <tbody id="myData">
                    @foreach($books as $item)
                        <tr>
                            <td colspan="1"><strong>{{$stt++}}</strong></td>
                            <td colspan="1"><strong>{!! $item->name !!}</strong></td>
                            <td colspan="1"><strong>{!! $item->tacgia !!}</strong></td>
                            <td colspan="1"><strong>{!! number_format($item->giaban) . " VNĐ" !!}</strong></td>
                            <td colspan="1"><strong>{!! $item->soluong !!}</strong></td>
                            <td colspan="1" class="text-center">
                                <a class="btn btn-primary" href="#" data-toggle="modal"
                                   data-target=".bd-view-modal-lg-{{$item->id}}"><i class="fa fa-eye"></i> </a>
                                <a class="btn btn-success" href="{{route('book.edit', $item->id)}}"><i
                                        class="fa fa-edit"></i> </a>
                                <a class="btn btn-danger"
                                   onclick="return confirm('Bạn có chắc muốn xóa {{$item->name}}?')"
                                   href="{{route('book.delete', $item->id)}}">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <div class="modal fade bd-view-modal-lg-{{$item->id}}" id="viewBook" tabindex="-1"
                             role="dialog" aria-labelledby="myLargeModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"
                                            id="exampleModalLabel">{{'Chi tiết sách ' . $item->name}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="table">
                                            <div class="row">
                                                <span class="col-sm-3">Tên sách: </span>
                                                <label class="w-75">{!! $item->name !!}</label>
                                            </div>
                                            <div class="row">
                                                <span class="col-sm-3">Chủ đề: </span>
                                                @foreach ($categories as $category)
                                                    @if ($category->id == $item->category_id)
                                                        <label class="w-75">{!! $category->category_name !!}</label>
                                                    @endif
                                                @endforeach
                                            </div>
                                            <div class="row">
                                                <span class="col-sm-3">Tác giả: </span>
                                                <label class="w-75">{!! $item->tacgia !!}</label>
                                            </div>
                                            <div class="row">
                                                <span class="col-sm-3">Giá bán: </span>
                                                <label
                                                    class="w-75">{!! number_format($item->giaban) . ' VNĐ' !!}</label>
                                            </div>
                                            <div class="row">
                                                <span class="col-sm-3">Số lượng: </span>
                                                <label class="w-75">{!! $item->soluong !!}</label>
                                            </div>
                                            <div class="row">
                                                <span class="col-sm-3">Nhà xuất bản: </span>
                                                <label class="w-75">{!! $item->nxb !!}</label>
                                            </div>
                                            <div class="row">
                                                <span class="col-sm-3">Tái bản: </span>
                                                <label class="w-75">{!! $item->taiban !!}</label>
                                            </div>
                                            <div class="row">
                                                <span class="col-sm-3">Hình ảnh: </span>
                                                <label class="w-75">
                                                    <div class="card-img mt-2">
                                                        <img src="{!! asset('images/' . $item->hinhanh) !!}"
                                                             alt="{!! $item->name !!}" width="150" height="150"
                                                             id="preview">
                                                    </div>
                                                </label>
                                            </div>
                                            <div class="row">
                                                <span class="col-sm-3">Mô tả: </span>
                                                <label class="w-75">{!! $item->gioithieu !!}</label>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary" data-dismiss="modal">Đóng</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </tbody>
                </table>
                <div class="modal fade bd-xml-add-modal-lg" id="viewBook" tabindex="-1"
                     role="dialog" aria-labelledby="myLargeModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"
                                    id="exampleModalLabel">{{'Thêm sách'}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{route('book.store')}}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="table">
                                        <div class="row">
                                            <span class="col-sm-3">Chọn file xml: </span>
                                            <label class="w-75"><input type="file" class="form-control-file"
                                                                       id="xmlChooser"
                                                                       name="xmlFile"></label>
                                        </div>
                                        <div class="row">
                                            <span class="col-sm-3">Tên sách: </span>
                                            <label class="w-75"><input type="text" class="form-control" id="xName"
                                                                       name="name"></label>
                                        </div>
                                        <div class="row">
                                            <span class="col-sm-3">Tác giả: </span>
                                            <label class="w-75"><input type="text" class="form-control" id="xTg"
                                                                       name="tacgia"></label>
                                        </div>
                                        <div class="row">
                                            <span class="col-sm-3">Chủ đề: </span>
                                            <label class="w-75"><select class="form-control" name="category_id"
                                                                        id="xCd">
                                                    @foreach($categories as $category)
                                                        <option
                                                            value="{!! $category->id !!}">{!! $category->category_name !!}</option>
                                                    @endforeach
                                                </select>
                                            </label>
                                        </div>
                                        <div class="row">
                                            <span class="col-sm-3">Giá bán: </span>
                                            <label class="w-75"><input type="text" class="form-control" id="xCost"
                                                                       name="giaban"></label>
                                        </div>
                                        <div class="row">
                                            <span class="col-sm-3">Số lượng: </span>
                                            <label class="w-75"><input type="text" class="form-control" id="xQty"
                                                                       name="soluong"></label>
                                        </div>
                                        <div class="row">
                                            <span class="col-sm-3">Nhà xuất bản: </span>
                                            <label class="w-75"><input type="text" class="form-control" id="xNxb"
                                                                       name="nxb"></label>
                                        </div>
                                        <div class="row">
                                            <span class="col-sm-3">Tái bản: </span>
                                            <label class="w-75"><input type="text" class="form-control" id="xTaiban"
                                                                       name="taiban"></label>
                                        </div>
                                        <div class="row">
                                            <span class="col-sm-3">Hình ảnh: </span>
                                            <label class="w-75">
                                                <input type="file" name="hinhanh" id="hinhanh" accept="image/*"
                                                       id="xImg">
                                                <div class="card-img mt-2">
                                                    <img src=""
                                                         alt="{!! 'Vui lòng chọn ảnh' !!}" width="150" height="150"
                                                         id="preview">
                                                </div>
                                            </label>
                                        </div>
                                        <div class="row">
                                            <span class="col-sm-3">Mô tả: </span>
                                            <label class="w-75"><textarea type="text" class="form-control"
                                                                          name="description"
                                                                          id="xareas"></textarea></label>
                                            <script>CKEDITOR.replace('xareas');</script>
                                        </div>
                                    </div>
                                    <div class="float-right">
                                        <button class="btn btn-primary" data-dismiss="modal">Đóng</button>
                                        <input type="submit" name="save" class="btn btn-success" value="Thêm sách">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade bd-xml-add-list-modal-lg" id="viewBook" tabindex="-1"
                     role="dialog" aria-labelledby="myLargeModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"
                                    id="exampleModalLabel">{{'Thêm sách'}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{route('book.insert.list')}}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="table">
                                        <div class="row">
                                            <span class="col-sm-3">Chọn file xml: </span>
                                            <label class="w-75"><input type="file" class="form-control-file"
                                                                       id="xmlList"
                                                                       name="xmlFile"></label>
                                        </div>
                                        <h3>Danh sách được thêm vào</h3>

                                        <div class="row" id="listBook">
                                        </div>
                                    </div>
                                    <button class="btn btn-primary" data-dismiss="modal">Đóng</button>
                                    <input type="submit" name="save" class="btn btn-success" value="Thêm sách">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{ $books->links() }}
            </div>
        </div>


    </div>
@endsection
