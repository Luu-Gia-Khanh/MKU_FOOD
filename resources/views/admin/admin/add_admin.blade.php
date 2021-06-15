@extends('admin.layout_admin')
@section('container')
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">DataTable</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                </div>
            </div>
        </div>
        <div class="pd-20 card-box mb-30">
            <div class="pd-20">
                <h4 class="text-blue h4">Thêm Quản Trị Viên</h4>
            </div>
            <div class="pd-20">
                <form action="{{ URL::to('admin/process_add_admin') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Họ Và Tên</label>
                                <input class="form-control upper_val" type="text" name="name" value="{{ old('name') }}" onblur="return upberFirstKey()" placeholder="Nhập Họ Và Tên">
                                @if ($errors->has('name'))
                                    <div class="alert alert-danger alert-dismissible mt-1">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Thư Điện Tử(Email)</label>
                                <input class="form-control" type="text" name="admin_email" value="{{ old('admin_email') }}" placeholder="Nhập Địa Chỉ Mail(........@.....)">
                                @if ($errors->has('admin_email'))
                                    <div class="alert alert-danger alert-dismissible mt-1">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        {{ $errors->first('admin_email') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Số Điện Thoại</label>
                                <input class="form-control" type="number" name="phone" value="{{ old('phone') }}" placeholder="Nhập Số Điện Thoại">
                                @if ($errors->has('phone'))
                                    <div class="alert alert-danger alert-dismissible mt-1">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        {{ $errors->first('phone') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Hình Ảnh</label>
                                <input class="form-control" type="file" name="avt" id="file_upload" onchange="return uploadhinh()" placeholder="">
                            </div>
                        </div>
                        <div class="" id="content_image_upload op-0">
                            <img src="" class="op-0" alt="hình ảnh" id="image_upload" height="100px" width="100px">
                        </div>
                    </div>
                    <div class="center mr-t">
                        <input type="submit" class="btn color-btn-them" value="Thêm Quản Trị Viên">
                    </div>
                </form>
            </div>
        </div>
    @endsection
