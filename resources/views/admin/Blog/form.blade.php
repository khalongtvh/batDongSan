@extends('admin.layout_admin')
@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            <h6 class="mb-0">Thêm tin tức</h6>
                        </div>
                    </div>
                </div>
                {{-- error --}}
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif
                {{-- --}}
                <div class="container">
                    <form method="POST" action="{{route('tin_tuc.store')}}" class="needs-validation" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="uname">Tiêu Đề:</label>
                            <input type="text" class="form-control" value="" placeholder="Tiêu đề" name="tieuDe">
                            <div class="invalid-feedback">Vui lòng nhập tên bài viết.</div>
                        </div>
                        <div class="form-group">
                            <label>Danh mục:</label>
                            <select name="maHangMuc" class="form-select">
                                @foreach ($danhmuc as $item)
                                <option value="{{$item->maHangMuc}}">{{$item->tieuDe}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Chi tiết bài viết:</label>
                            <textarea name="noiDung" class="form-control" id="ckeditor1" rows="7"></textarea>
                            <div class="invalid-feedback">Vui lòng nhập chi tiết bài viết.</div>
                        </div>
                        <div class="form-group">
                            <label>Trạng thái:</label>
                            <select name="trangThai" class="form-select">
                                <option value="1">Kích hoạt</option>
                                <option value="0">Không kích hoạt</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Ảnh Chính:</label>
                            <input type="file" class="form-control" name="image" id="">
                            <div class="invalid-feedback">Vui lòng chọn ảnh.</div>
                        </div>                        
                        <div class="form-group">
                                <label for="">Bộ Sưu Tập Ảnh:</label>
                                <input type="file" class="form-control" multiple name="images[]" id="">
                                <div class="invalid-feedback">Chưa Chọn Ảnh.</div>
                            </div>

                        <button type="submit" class="btn btn-outline-primary btn-sm mb-0 mb-4">Thêm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>


@endsection