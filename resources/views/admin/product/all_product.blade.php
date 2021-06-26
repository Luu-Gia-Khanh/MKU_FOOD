@extends('admin.layout_admin')
@section('container')
    <div class="min-height-200px">
        <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ URL::to('admin/dashboard') }}">Trang chủ</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Danh sách sản phẩm</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right">
                        {{-- <div class="dropdown">
                        <a class="btn btn-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                            January 2018
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#">Export List</a>
                            <a class="dropdown-item" href="#">Policies</a>
                            <a class="dropdown-item" href="#">View Assets</a>
                        </div>
                    </div> --}}
                    </div>
                </div>
        </div>
        {{-- Message  --}}
        @if (session('change_status'))
            <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ session('change_status') }}
            </div>
        @endif
        @if (session('update_product_success'))
            <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ session('update_product_success') }}
            </div>
        @endif
        @if (session('add_product_success'))
            <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ session('add_product_success') }}
            </div>
        @endif
        @if (session('delete_success'))
            <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ session('delete_success') }}
            </div>
        @endif
        @if (session('delete_error'))
            <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ session('delete_error') }}
            </div>
        @endif
        <!-- Simple Datatable start -->
        <div class="card-box mb-30">
            <div class="pd-20">
                <h4 class="text-blue h4">Danh Sách Sản Phẩm</h4>
            </div>
            <div class="pb-20">
                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer ">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div id="DataTables_Table_0_filter" class="dataTables_filter">
                                <form action="">
                                    @csrf
                                    <label>Tìm Kiếm:<input type="search" class="form-control form-control-sm" id="find_product" placeholder="Tìm Kiếm"
                                        aria-controls="DataTables_Table_0"></label>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="content_find_product">
                    @if (count($all_product) > 0)
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="data-table table table-hover multiple-select-row nowrap no-footer dtr-inline sortable"
                                    id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                                colspan="1">STT</th>
                                            <th class="table-plus datatable-nosort sorting_asc" rowspan="1" colspan="1"
                                                aria-label="Name" data-defaultsort="disabled">Hình Ảnh</th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                                colspan="1">Tên Sản Phẩm</th>
                                            {{-- <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                                colspan="1">Đơn vị tính</th> --}}
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                                colspan="1">Loại Sản Phẩm</th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                            colspan="1">Giá</th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                            colspan="1">Kho</th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                            colspan="1" data-defaultsort="disabled">Mới</th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                            colspan="1" data-defaultsort="disabled">Đặc Trưng</th>
                                            <th class="datatable-nosort sorting_disabled" rowspan="1" colspan="1"
                                                aria-label="Action" data-defaultsort="disabled">Thao Tác</th>
                                        </tr>
                                    </thead>
                                    <tbody class="">
                                        @php
                                            $stt = 1;
                                        @endphp
                                        @foreach ($all_product as $prod)
                                        <tr role="row" class="odd">
                                            <td>{{ $stt++ }}</td>
                                            <td class="table-plus" tabindex="0">
                                                    <div class="da-card box-shadow" style="height: 80px; width: 80px">
                                                        <div class="da-card-photo">
                                                            <img src="{{ asset('public/upload/' . $prod->product_image) }}" alt="hình ảnh"
                                                                srcset="" style="height: 80px; width: 80px">
                                                            <div class="da-overlay">
                                                                <div class="da-social">
                                                                    <ul class="clearfix">
                                                                        <li><a href="{{ URL::to('admin/all_gallery_product/'.$prod->product_id) }}"><i class="icon-copy dw dw-eye"></i></a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </td>
                                            <td>
                                                <a href="{{ URL::to('admin/view_detail_product/'.$prod->product_id) }}">{{ $prod->product_name }}</a>
                                            </td>

                                            {{-- <td>
                                                @foreach ($all_unit as $unit)
                                                    @if ($unit->unit_id == $prod->unit_id)
                                                        {{ $unit->unit_name }}
                                                    @endif
                                                @endforeach
                                            </td> --}}
                                            <td>
                                                @foreach ($all_cate as $cate)
                                                    @if ($cate->cate_id == $prod->category_id)
                                                        {{ $cate->cate_name }}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($product_price as $price)
                                                    @if ($price->product_id == $prod->product_id)
                                                    <a href="{{ URL::to('admin/history_price_product/'.$prod->product_id) }}">{{ number_format($price->price, 0, ',', '.') }} vnđ</a>
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                @php
                                                    $val_id_storage = 0;
                                                @endphp
                                                @foreach ($storage_product as $st_prod)
                                                    @if ($st_prod->product_id == $prod->product_id)
                                                        @php
                                                            $val_id_storage = $st_prod->storage_id;
                                                        @endphp
                                                        @foreach ($all_storage as $storage)
                                                            @if ($storage->storage_id == $val_id_storage)
                                                                <a href="{{ URL::to('admin/all_storage_product/'.$storage->storage_id) }}">{{ $storage->storage_name }}</a>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td class="center">
                                                @if ($prod->is_new == 1)
                                                <i class="icon-copy fa fa-check" aria-hidden="true" style="font-size: 25px; color: rgb(5, 199, 30)"></i>
                                                @else
                                                    <i class="icon-copy fa fa-close" aria-hidden="true" style="font-size: 25px; color: rgb(207, 51, 11)"></i>
                                                @endif
                                            </td>
                                            <td class="center">
                                                @if ($prod->is_featured == 1)
                                                    <a href="{{ URL::to('admin/is_not_featured/'.$prod->product_id) }}"><i class="icon-copy fa fa-check" aria-hidden="true" style="font-size: 25px; color: rgb(5, 199, 30)"></i></a>
                                                @else
                                                <a href="{{ URL::to('admin/is_featured/'.$prod->product_id) }}"><i class="icon-copy fa fa-close" aria-hidden="true" style="font-size: 25px; color: rgb(207, 51, 11)"></i></a>
                                                @endif
                                            </td>
                                            <td class="">
                                                <div class="dropdown">
                                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                        href="#" role="button" data-toggle="dropdown">
                                                        <i class="dw dw-more"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                        <a class="dropdown-item" href="{{ URL::to('admin/view_detail_product/'.$prod->product_id) }}"><i class="dw dw-eye"></i>Thông tin sản phẩm</a>
                                                        <a class="dropdown-item" href="{{ URL::to('admin/update_product/'.$prod->product_id) }}"><i class="dw dw-edit2"></i>Chỉnh Sửa</a>
                                                        <button class="dropdown-item soft_delete_product_class"
                                                                data-id="{{ $prod->product_id }}" data-toggle="modal"
                                                                data-target="#Modal_delete_product"><i class="dw dw-delete-3"
                                                                    ></i>Xóa</button>
                                                    </div>
                                                </div>
                                            </td>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        <div class="center">Chưa có sản phẩm nào</div>
                    @endif

                        <div class="row">
                            <div class="col-sm-12 col-md-5">
                                <a href="{{ URL::to('admin/view_recycle_product') }}" class="btn color-btn-them ml-10"
                                    style="color: white"><i class="dw dw-delete-3"></i> Thùng Rác</a>
                            </div>
                            <div class="col-sm-12 col-md-7">
                                <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                                    <ul class="pagination">
                                        {!! $all_product->links() !!}
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- The Modal -->
        <div class="modal fade" id="Modal_delete_product">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Thông Báo</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        Bạn có muốn xóa sản phẩm này ?
                        <form action="{{ URL::to('admin/soft_delete_product') }}" method="post" name="form_soft_delete_product">
                            @csrf
                            <input type="hidden" class="id_delete_product" name="product_id" value="">
                        </form>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button class="btn btn-danger btn_delete_soft_product">Xóa</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                    </div>
                </div>
            </div>
        </div>
    @endsection
