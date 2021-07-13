@extends('admin.layout_admin')
@section('container')
<div class="mb-4">

    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ URL::to('admin/dashboard') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Danh sách đơn hàng</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="title pb-20">
        <h2 class="h3 mb-0">Thống Kê Đơn Hàng</h2>
    </div>

    <div class="row pb-10">
        <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
            <div class="card-box height-100-p widget-style3">
                <a href="#">
                    <div class="d-flex flex-wrap">
                        <div class="widget-data">
                            <div class="weight-700 font-24 text-dark">75</div>
                            <div class="font-14 text-secondary weight-500">Chờ Xác Nhận</div>
                        </div>
                        <div class="widget-icon">
                            <div class="icon" data-color="#ffc107"><i class="icon-copy dw dw-warning-1"></i></div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
            <div class="card-box height-100-p widget-style3">
                <a href="#">
                    <div class="d-flex flex-wrap">
                        <div class="widget-data">
                            <div class="weight-700 font-24 text-dark">124,551</div>
                            <div class="font-14 text-secondary weight-500">Đã Xác Nhận</div>
                        </div>
                        <div class="widget-icon">
                            {{-- <i class="icon-copy dw dw-down-chevron"></i> --}}
                            <div class="icon" data-color="#17a2b8"><i class="icon-copy dw dw-check"></i></div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
            <div class="card-box height-100-p widget-style3">
                <a href="#">
                    <div class="d-flex flex-wrap">
                        <div class="widget-data">
                            <div class="weight-700 font-24 text-dark">400+</div>
                            <div class="font-14 text-secondary weight-500">Đang Giao</div>
                        </div>
                        <div class="widget-icon">
                            <div class="icon" data-color="rgb(0, 180, 137)"><i class="icon-copy dw dw-truck" aria-hidden="true"></i></div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
            <div class="card-box height-100-p widget-style3">
                <a href="#">
                    <div class="d-flex flex-wrap">
                        <div class="widget-data">
                            <div class="weight-700 font-24 text-dark">40+</div>
                            <div class="font-14 text-secondary weight-500">Đã Giao</div>
                        </div>
                        <div class="widget-icon">
                            <div class="icon" data-color="#28a745"><i class="icon-copy dw dw-checked" aria-hidden="true"></i></div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 mb-20">
            <div class="card-box height-100-p widget-style3">
                <a href="#">
                    <div class="d-flex flex-wrap">
                        <div class="widget-data">
                            <div class="weight-700 font-24 text-dark">300+</div>
                            <div class="font-14 text-secondary weight-500">Đã Hủy</div>
                        </div>
                        <div class="widget-icon">
                            <div class="icon" data-color="#dc3545"><i class="icon-copy dw dw-cancel" aria-hidden="true"></i></div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 mb-20">
            <div class="card-box height-100-p widget-style3">
                <a href="#">
                    <div class="d-flex flex-wrap">
                        <div class="widget-data">
                            <div class="weight-700 font-24 text-dark">4000+</div>
                            <div class="font-14 text-secondary weight-500">Tổng Đơn Hàng</div>
                        </div>
                        <div class="widget-icon">
                            <div class="icon" data-color="#09cc06"><i class="icon-copy fa fa-money" aria-hidden="true"></i></div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="card-box mb-30">
        <div class="row pd-20">
            <div class="pd-20">
                <h4 class="text-blue h4">Danh Sách Đơn Hàng</h4>
            </div>
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
                                <label>Tìm Kiếm:<input type="search" class="form-control form-control-sm"  placeholder="Tìm Kiếm"
                                    aria-controls="DataTables_Table_0"></label>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="content_find_category">
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="data-table table table-hover multiple-select-row nowrap no-footer dtr-inline sortable"
                            id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                                <thead>
                                    <tr role="row">
                                        <th style="width: 5%;" class="sorting text-center" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                            colspan="1">STT</th>
                                        <th style="width: 13%;" class="sorting text-center" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                            colspan="1" data-defaultsort="disabled">Mã Đơn Hàng</th>
                                        <th style="width: 19%;" class="table-plus datatable-nosort sorting_asc text-center" rowspan="1" colspan="1"
                                            aria-label="Name" data-defaultsign="AZ">Họ Và Tên</th>
                                        <th style="width: 13%;" class="sorting text-center" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                            colspan="1" data-defaultsort="disabled">Số Điện Thoại</th>
                                        <th style="width: 30%;" class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                            colspan="1" data-defaultsort="disabled">Địa Chỉ</th>
                                        <th style="width: 15%;" class="datatable-nosort sorting_disabled" rowspan="1" colspan="1"
                                            aria-label="Action" data-defaultsort="disabled">Trạng Thái</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr role="row" class="odd">
                                        <td class="text-center">1</td>
                                        <td class="text-center">
                                            <b>#120720213333</b>
                                        </td>
                                        <td class="text-center">Nguyễn Hoàng Quốc Bảo</td>
                                        <td class="text-center">0911635153</td>
                                        <td>Ấp 3, xã Láng Biển, huyện Tháp Mười, tỉnh Đồng Tháp Ấp 3, xã Láng Biển, huyện Tháp Mười, tỉnh Đồng Tháp</td>
                                        <td>
                                            <span class="badge badge-success" style="width: 88.5px;">Đã Giao</span>
                                        </td>
                                    </tr>
                                    <tr role="row" class="odd">
                                        <td class="text-center">1</td>
                                        <td class="text-center">
                                            <b>#120720213333</b>
                                        </td>
                                        <td class="text-center">Phan Hoài Kha</td>
                                        <td class="text-center">0911635153</td>
                                        <td>Ấp 3, xã Láng Biển, huyện Tháp Mười, tỉnh Đồng Tháp</td>
                                        <td>
                                            <span class="badge badge-warning" style="width: 88.5px;">Chờ Xác Nhận</span>
                                        </td>
                                    </tr>
                                    <tr role="row" class="odd">
                                        <td class="text-center">1</td>
                                        <td class="text-center">
                                            <b>#120720213333</b>
                                        </td>
                                        <td class="text-center">Phan Hoài Kha</td>
                                        <td class="text-center">0911635153</td>
                                        <td>Ấp 3, xã Láng Biển, huyện Tháp Mười, tỉnh Đồng Tháp</td>
                                        <td>
                                            <span class="badge badge-danger" style="width: 88.5px;">Đã Hủy</span>
                                        </td>
                                    </tr>
                                    <tr role="row" class="odd">
                                        <td class="text-center">1</td>
                                        <td class="text-center">
                                            <b>#120720213333</b>
                                        </td>
                                        <td class="text-center">Phan Hoài Kha</td>
                                        <td class="text-center">0911635153</td>
                                        <td>Ấp 3, xã Láng Biển, huyện Tháp Mười, tỉnh Đồng Tháp</td>
                                        <td>
                                            <span class="badge badge-info" style="width: 88.5px;">Đã Xác Nhận</span>
                                        </td>
                                    </tr>
                                    <tr role="row" class="odd">
                                        <td class="text-center">1</td>
                                        <td class="text-center">
                                            <b>#120720213333</b>
                                        </td>
                                        <td class="text-center">Phan Hoài Kha</td>
                                        <td class="text-center">0911635153</td>
                                        <td>Ấp 3, xã Láng Biển, huyện Tháp Mười, tỉnh Đồng Tháp</td>
                                        <td>
                                            <span class="badge" style="background-color:rgb(0, 180, 137); color: white; width: 88.5px;">Đang Giao</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-7">
                        <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                            <ul class="pagination">
                                {{-- {!! $all_category->links() !!} --}}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
