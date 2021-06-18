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
        <!-- Simple Datatable start -->
        <div class="pd-20 card-box mb-30">
            <div class="pd-20">
                <h4 class="text-blue h4">Thùng Rác</h4>
            </div>
            @if(count($recycle_item)>0)
                <div class="pb-20">
                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer ">
                        <div class="row">
                            <div class="col-12 table-responsive">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col">STT</th>
                                        <th scope="col">Hình Ảnh</th>
                                        <th scope="col">Họ và Tên</th>
                                        <th scope="col">Số Điện Thoại</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Thao Tác</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $stt = 1;
                                        @endphp
                                    @foreach ($recycle_item as $recy)
                                        <tr>
                                            <td>{{ $stt++ }}</td>
                                            <td>
                                                <img src="{{ asset('public/upload/'.$recy->avt) }}" alt="" srcset="" height="70px" width="70px">
                                            </td>
                                            <td>{{ $recy->admin_name }}</td>
                                            <td>{{ $recy->admin_phone }}</td>
                                            <td>{{ $recy->admin_email }}</td>
                                            <td class="col-4">
                                                <a href="{{ URL::to('admin/re_delete/'.$recy->admin_id) }}" class="btn color-btn-them"
                                                    > Khôi Phục</a>
                                                <button class="btn btn-danger btn_delete_forever" data-id="{{ $recy->admin_id }}" data-toggle="modal" data-target="#delete_forever"> Xóa Vĩnh Viễn</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-12 col-md-7">
                                <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                                    <ul class="pagination">
                                        {{-- {!! $all_admin->links() !!} --}}
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="center">Thùng Rác Rổng</div>
            @endif
        </div>
        <!-- The Modal -->
        <div class="modal fade" id="delete_forever">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title center">Thông Báo</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        Bạn có chắc chắn muốn xóa vĩnh viễn dữ liệu này ?
                        <form action="{{ URL::to('admin/delete_forever') }}" method="post" name="form_delete_forever">
                            @csrf
                            <input type="hidden" value="" name="admin_id_delete_forever" class="admin_id_delete_forever">
                        </form>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn_confirm_delete_forever" data-dismiss="modal">Đồng Ý</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    </div>
                </div>
            </div>
        </div>
    @endsection