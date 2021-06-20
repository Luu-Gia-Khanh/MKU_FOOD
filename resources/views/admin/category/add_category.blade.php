@extends('admin.layout_admin')
@section('container')
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Thêm loại sản phẩm</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                </div>
            </div>
        </div>
        <div class="pd-20 card-box mb-30">
            <div class="pd-20">
                <h4 class="text-blue h4">Thêm loại sản phẩm</h4>
            </div>
            <div class="pd-20">
                <form action="{{ URL::to('admin/process_add_category') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Tên loại sản phẩm</label>
                                <input class="form-control upper_val" type="text" name="cate_name"
                                    value="{{ old('cate_name') }}" onblur="return upberFirstKey()"
                                    placeholder="Nhập loại sản phẩm">
                                @if ($errors->has('cate_name'))
                                    <div class="alert alert-danger alert-dismissible mt-1">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        {{ $errors->first('cate_name') }}
                                    </div>
                                @endif
                                @if (session('check_cate_name'))
                                    <div class="alert alert-danger alert-dismissible mt-1">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        {{ session('check_cate_name') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Hình Ảnh</label>
                                <input class="form-control" type="file" name="cate_image" id="file_upload"
                                    onchange="return uploadhinh()" placeholder="" value="no_image">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="ml-3" id="content_image_upload op-0">
                            <img src="" class="op-0" alt="hình ảnh" id="image_upload" width="500" height="500">
                        </div>
                    </div>
                    <div class="center mr-t">
                        <input type="submit" class="btn color-btn-them" value="Thêm loại sản phẩm">
                    </div>
                </form>
            </div>
        </div>
    @endsection