@extends('admin.layout_admin')
@section('container')
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Loại Sản Phẩm</li>
                        </ol>
                    </nav>
                </div>

                <div class="col-md-6 col-sm-12">
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

        <div class="card-box mb-30">
            @if (session('success_add_category'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success_add_category') }}
                    </div>
                @endif
        </div>

        <div class="card-box mb-30">
            @if (session('success_update_category'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success_update_category') }}
                    </div>
                @endif
        </div>

        <div class="card-box mb-30">
            @if (session('success_delete_soft_category'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success_delete_soft_category') }}
                    </div>
                @endif
        </div>

        <div class="card-box mb-30">
            @if (session('success_delete_category'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success_delete_category') }}
                    </div>
                @endif
        </div>

        <!-- Simple Datatable start -->
        <div class="card-box mb-30">
            {{-- <div class="pd-20">
                <h4 class="text-blue h4">Danh sách loại sản phẩm</h4>
                <form class="form-inline">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div> --}}
            <div class="row pd-20">
                <div class="col-md-8 col-sm-12">
                    <h4 class="text-blue h4">Danh sách loại sản phẩm</h4>
                </div>
                <div class="col-md-4 col-sm-12">
                    {{-- <input type="text" class="text-input form-control" id="search_category" value="" placeholder="Tìm kiếm..."/> --}}
                    <form action="">
                        @csrf
                        <label for="">Tìm kiếm: <input type="search" class="form-control" id="find_category" name="value_find"></label>
                    </form>
                </div>
            </div>
            <div class="pb-20">
                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer ">
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="data-table table stripe hover nowrap dataTable no-footer dtr-inline"
                                id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                            colspan="1">STT</th>
                                        <th class="table-plus datatable-nosort sorting_asc" rowspan="1" colspan="1"
                                            aria-label="Name">Hình Ảnh</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                            colspan="1" >Tên loại</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                            colspan="1">Ngày</th>
                                        <th class="datatable-nosort sorting_disabled" rowspan="1" colspan="1"
                                            aria-label="Action">Thao Tác</th>
                                    </tr>
                                </thead>
                                <tbody class="content_find_category">
                                    @php
                                        $stt = 0;
                                    @endphp
                                    @foreach ($all_category as $cate)
                                        @php
                                            $stt++;
                                        @endphp
                                    <tr role="row" class="odd">
                                        <td>{{ $stt }}</td>
                                        <td class="table-plus sorting_1" tabindex="0">
                                            <img src="{{ asset('public/upload/'.$cate->cate_image) }}" alt="hình ảnh" srcset="" width="200" height="200">
                                        </td>
                                        <td>{{ $cate->cate_name }}</td>
                                        <td>{{ $cate->created_at }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                    href="#" role="button" data-toggle="dropdown">
                                                    <i class="dw dw-more"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                    <a class="dropdown-item" href="{{ URL::to('admin/update_category/'.$cate->cate_id) }}"><i class="dw dw-edit2"></i>Chỉnh Sửa</a>
                                                    <button class="dropdown-item soft_delete_category_class" data-id="{{ $cate->cate_id }}" data-toggle="modal" data-target="#Modal_delete"><i class="dw dw-delete-3"></i>Xóa</button>
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
                            <a href="{{ URL::to('admin/view_recycle_cate') }}" class="btn color-btn-them ml-10"
                                style="color: white"><i class="dw dw-delete-3"></i> Thùng Rác</a>
                        </div>
                        <div class="col-sm-12 col-md-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                                <ul class="pagination">
                                    {!! $all_category->links() !!}
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
                        <form action="{{ URL::to('admin/soft_delete_cate') }}" method="post" name="form_soft_delete">
                            @csrf
                            <input type="hidden" class="id_delete_category" name="cate_id" value="">
                        </form>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button class="btn btn-danger btn_delete_soft">Xóa</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endsection
