@extends('admin.layout_admin')
@section('container')
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ URL::to('admin/dashboard') }}">Trang chủ</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Thêm kho hàng</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                </div>
            </div>
        </div>
        <div class="pd-20 card-box mb-30">
            <div class="pd-20">
                <h4 class="text-blue h4">Thêm Kho Hàng</h4>
            </div>
            <div class="pd-20">
                <form action="{{ URL::to('admin/process_add_storage') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Tên Kho Hàng</label>
                                <input class="form-control upper_val" type="text" name="storage_name"
                                    value="{{ old('storage_name') }}" onblur="return upberFirstKey()"
                                    placeholder="Nhập Tên Kho Hàng">
                                @if ($errors->has('storage_name'))
                                    <div class="alert alert-danger alert-dismissible mt-1">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        {{ $errors->first('storage_name') }}
                                    </div>
                                @endif
                                @if (session('check_storage_name'))
                                    <div class="alert alert-danger alert-dismissible mt-1">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        {{ session('check_storage_name') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3"></div>
                    <div class="center mr-t">
                        <input type="submit" class="btn color-btn-them" value="Thêm Kho Hàng">
                    </div>
                </form>
            </div>
        </div>
    @endsection
