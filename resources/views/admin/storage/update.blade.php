@extends('admin.layout_admin')
@section('container')
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ URL::to('admin/dashboard') }}">Trang chủ</a></li>
                            <li class="breadcrumb-item"><a href="{{ URL::to('admin/all_storage/') }}">Danh sách kho hàng</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Sửa kho hàng</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                </div>
            </div>
        </div>

        <div class="pd-20 card-box mb-30">
            <div class="pd-20">
                <h4 class="text-blue h4">Sửa Kho Hàng</h4>
            </div>
            <div class="pd-20">
                <form action="{{ URL::to('admin/process_update_storage/' . $update_storage->storage_id) }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Tên Kho hàng</label>
                                <input class="form-control upper_val" type="text" name="storage_name"
                                    value="{{ $update_storage->storage_name }}" onblur="return upberFirstKey()"
                                    placeholder="Nhập Tên Kho hàng">
                                    @if ($errors->has('storage_name'))
                                    <div class="alert alert-danger alert-dismissible mt-1">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        {{ $errors->first('storage_name') }}
                                    </div>
                                @endif
                                @if (session('check_storage_name'))
                                    <div class="alert alert-danger alert-dismissible mt-1" role="alert">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        {{ session('check_storage_name') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-3"></div>
                    </div>
                    <div class="center mr-t mt-5">
                        <button type="submit" class="btn color-btn-them" value="Chỉnh Sửa Kho Hàng"><i class="icon-copy fi-page-edit"></i> Chỉnh Sửa Kho Hàng</button>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">
                            <i class="icon-copy fi-x"></i> Hủy Thay Đổi
                        </button>
                    </div>
                </form>
            </div>
        </div>
         <!-- The Modal -->
         <div class="modal fade" id="myModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title center">Thông Báo</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        Bạn Muốn Hủy Thay Đổi
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger confirm" data-dismiss="modal">Hủy</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                    </div>
                </div>
            </div>
        </div>
    @endsection
