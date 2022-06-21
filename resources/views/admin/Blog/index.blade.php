@extends('admin.layout_admin')
@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            <h6 class="mb-0">Posts</h6>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('tin_tuc.create') }}" class="btn btn-outline-primary btn-sm mb-0">Thêm</a>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">STT</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tiêu Đề</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Hình Ảnh</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nội dung</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Hạng Mục</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Trạng Thái</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Thao Tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($blog as $key => $item)
                                <tr>
                                    <td>
                                        <p class="text-xs ms-sm-3 font-weight-bold mb-0">{{$key + 1}}</p>
                                    </td>
                                    <td>
                                        <p style="width: 100px; white-space: normal " class="text-xs font-weight-bold mb-0">{{$item->tieuDe}}</p>
                                    </td>
                                    <td>
                                        <img class="rounded-2" width="250" height="150" src="{{asset('admin/uploads/images/'.$item->hinhAnh)}}" alt="">
                                    </td>
                                    <td class="block-ellipsis">
                                        <p class="text-xs font-weight-bold mb-0">{!!$item->noiDung!!}</p>
                                    </td>

                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{$item->hangMuc->tieuDe}}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{$item->trangThai}}</p>
                                    </td>
                                    <td>
                                        <form class="float-start mt-2" action="{{route('tin_tuc.destroy',[$item->maTinTuc])}}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button href="" class="btn  btn-link text-danger text-gradient px-3 mb-0 m-sm-n3">
                                                <i class="far fa-trash-alt me-2"></i>
                                            </button>
                                        </form>
                                        <a href="{{route('tin_tuc.edit',[$item->maTinTuc])}}" class="btn btn-link text-dark px-3 mx-n2 mb-0">
                                            <i class="fas fa-pencil-alt text-dark me-2"></i>
                                        </a>
                                        <a href="{{route('tin_tuc.show',[$item->maTinTuc])}}" class="btn btn-link  mx-n2 mb-0">
                                            <i class="fas fa-eye text-primary me-2"></i>
                                        </a>
                                    </td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                        <div class="p-2">
                            {{$blog->links()}}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .block-ellipsis {
        width: 300px;
        display: block;
        display: -webkit-box;
        max-width: 100%;
        height: 250px;
        margin: 0 auto;
        font-size: 14px;
        line-height: 1;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
@endsection