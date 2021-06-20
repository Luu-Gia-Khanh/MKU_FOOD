@extends('admin.layout_admin')
@section('container')
    <div class="min-height-200px">
        <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ URL::to('admin/dashboard') }}">Trang chủ</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Danh sách quản trị viên</li>
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
        @if (session('delete_success'))
            <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ session('delete_success') }}
            </div>
        @endif
        @if (session('add_admin_success'))
            <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ session('add_admin_success') }}
            </div>
        @endif
        @if (session('update_success_admin'))
            <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ session('update_success_admin') }}
            </div>
        @endif

        <!-- Simple Datatable start -->
        <div class="card-box mb-30">
            <div class="pd-20">
                <h4 class="text-blue h4">Danh Sách Quản Trị Viên</h4>
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
                                    <label>Tìm Kiếm:<input type="search" class="form-control form-control-sm" id="find_admin" placeholder="Tìm Kiếm"
                                        aria-controls="DataTables_Table_0"></label>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="data-table table table-striped nowrap no-footer table-hover"
                                id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                            colspan="1">STT</th>
                                        <th class="table-plus datatable-nosort sorting_asc" rowspan="1" colspan="1"
                                            aria-label="Name">Hình Ảnh</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                            colspan="1">Họ Và Tên</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                            colspan="1">Số Điện Thoại</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                            colspan="1">Email</th>
                                        <th class="datatable-nosort sorting_disabled" rowspan="1" colspan="1"
                                            aria-label="Action">Thao Tác</th>
                                    </tr>
                                </thead>
                                <tbody class="content_find_admin">
                                    @php
                                        $stt = 0;
                                    @endphp
                                    @foreach ($all_admin as $ad)
                                        @php
                                            $stt++;
                                        @endphp
                                        <tr role="row" class="odd">
                                            <td>{{ $stt }}</td>
                                            <td class="table-plus sorting_1" tabindex="0">
                                                <img src="{{ asset('public/upload/' . $ad->avt) }}" alt="hình ảnh"
                                                    srcset="" height="70px" width="70px">
                                            </td>
                                            <td>{{ $ad->admin_name }}</td>
                                            <td>{{ $ad->admin_phone }}</td>
                                            <td>{{ $ad->admin_email }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                        href="#" role="button" data-toggle="dropdown">
                                                        <i class="dw dw-more"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                        <a class="dropdown-item" href="{{ URL::to('admin/view_profile/'.$ad->admin_id) }}"><i class="dw dw-eye"></i>Thông tin cá nhân</a>
                                                        <a class="dropdown-item"
                                                            href="{{ URL::to('admin/update_admin/' . $ad->admin_id) }}"><i
                                                                class="dw dw-edit2"></i>Chỉnh Sửa</a>

                                                        @if (Session::get('admin_id') != $ad->admin_id)
                                                            <button class="dropdown-item soft_delete_admin_class"
                                                                data-id="{{ $ad->admin_id }}" data-toggle="modal"
                                                                data-target="#Modal_delete"><i
                                                                    class="dw dw-delete-3"></i>Xóa</button>

                                                        @endif

                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-5">
                            <a href="{{ URL::to('admin/view_recycle') }}" class="btn color-btn-them ml-10"
                                style="color: white"><i class="dw dw-delete-3"></i> Thùng Rác</a>
                        </div>
                        <div class="col-sm-12 col-md-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                                <ul class="pagination">
                                    {!! $all_admin->links() !!}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- The Modal -->
        <div class="modal fade" id="Modal_delete">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Thông Báo</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        Bạn có muốn xóa dữ liệu này ?
                        <form action="{{ URL::to('admin/soft_delete') }}" method="post" name="form_soft_delete">
                            @csrf
                            <input type="hidden" class="id_delete_admin" name="admin_id" value="">
                        </form>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button class="btn btn-danger btn_delete_soft">Xóa</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                    </div>
                </div>
            </div>
        </div>
    @endsection
