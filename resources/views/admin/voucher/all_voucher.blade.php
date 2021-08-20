@extends('admin.layout_admin')
@section('container')
<link rel="stylesheet" href="{{ asset('public/back_end/custom_voucher/modal_voucher_css.css') }}">
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ URL::to('admin/dashboard') }}">Trang chủ</a></li>
                            <li class="breadcrumb-item"><a href="{{ URL::to('admin/all_product_voucher') }}">Danh sách sản phẩm voucher</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Danh sách Voucher</li>
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
            @if (session('add_voucher_success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{ session('add_voucher_success') }}
                    </div>
                @endif
        </div>

        <div class="card-box mb-30">
            @if (session('update_voucher_success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{ session('update_voucher_success') }}
                    </div>
                @endif
        </div>

        <!-- Simple Datatable start -->
        <div class="card-box mb-30">
            <div class="row pd-20">
                <div class="col-10 pd-20">
                    <h4 class="text-blue h4">Danh Sách Voucher - {{ $product_name }}</h4>
                </div>
            </div>
            <div class="pb-20">
                @if (count($all_voucher) > 0)
                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer ">
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="data-table table table-hover multiple-select-row nowrap no-footer dtr-inline sortable"
                                id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                                    <thead>
                                        <tr role="row" class="text-center">
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                                colspan="1">STT</th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                                colspan="1" data-defaultsort="disabled">Mã Voucher</th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                                colspan="1" data-defaultsign="AZ">Tên Voucher</th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                                colspan="1">Ngày Bắt Đầu</th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                                colspan="1">Ngày Kết Thúc</th>
                                            <th class="datatable-nosort sorting_disabled" rowspan="1" colspan="1"
                                                aria-label="Action" data-defaultsort="disabled">Tình Trạng</th>
                                            <th class="datatable-nosort sorting_disabled" rowspan="1" colspan="1"
                                                aria-label="Action" data-defaultsort="disabled">Thao Tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $stt = 0;
                                        @endphp
                                        @foreach ($all_voucher as $voucher)
                                            @php
                                                $stt++;
                                            @endphp
                                        <tr role="row" class="odd text-center">
                                            <td>{{ $stt }}</td>
                                            <td>
                                                {{ $voucher->voucher_code }}
                                            </td>
                                            <td class="text-left" id="voucher_name">
                                                {{ $voucher->voucher_name }}
                                            </td>
                                            <td> 
                                                {{ date("d-m-y H:i a", strtotime($voucher->start_date)) }}                                         
                                            </td>
                                            <td>
                                                {{ date("d-m-y H:i a", strtotime($voucher->end_date)) }}                                              </td>
                                            <td>
                                                @php
                                                    $now = Carbon\Carbon::now();
                                                @endphp
                                                @if ($voucher->start_date <= $now && $now <= $voucher->end_date && $voucher->voucher_quantity > 0)
                                                    <span class="badge badge-success" style="width: 105px;">Đang áp dụng</span>
                                                @elseif ($voucher->start_date > $now)
                                                    <span class="badge badge-warning" style="width: 105px;">Chưa áp dụng</span>
                                                @else
                                                    <span class="badge badge-danger" style="width: 105px;">Ngưng áp dụng</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                        href="#" role="button" data-toggle="dropdown">
                                                        <i class="dw dw-more"></i>
                                                    </a>

                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                        <button 
                                                            class="dropdown-item btn_open_modal" data-id={{ $voucher->voucher_id }} data-toggle="modal" data-target="#modal_voucher"><i class="dw dw-eye"></i>Xem chi tiết</button>
                                                        <a class="dropdown-item" href="{{ URL::to('admin/update_voucher/'.$voucher->voucher_id) }}"><i class="dw dw-edit2"></i>Chỉnh Sửa</a>                                                    
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
                            </div>
                            <div class="col-sm-12 col-md-7">
                                <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                                    <ul class="pagination">
                                        {!! $all_voucher->links() !!}
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="center">Hiện sản phẩm chưa có voucher</div>
                @endif
            </div>
        </div>
        {{-- <div class="modal_delete_order modal" id="modal_voucher_detail"> --}}
            <!-- Modal content -->
            {{-- <div class="modal-content container" style="max-width: 800px; height: 450px;">
                <div class="modal-header-cus">
                    <span class="close btn_close_modal">&times;</span>
                    <h4>Chi Tiết Voucher</h4>
                </div>
                <div class="modal-body-cus">
                    <div class="content" style="border-radius: 5px">
                        <div class="content__voucher-top">
                            <span class="voucher-label">Code:</span>
                            <span class="voucher-text voucher_code"></span>
                        </div>
                        <div class="content__voucher-top">
                            <span class="voucher-label">Tên voucher:</span>
                            <span class="voucher-text voucher_name"></span>
                        </div>
                        <div class="content__voucher-top">
                            <span class="voucher-label">Áp dụng cho sản phẩm:</span>
                            <span class="voucher-text voucher_product"></span>
                        </div>
                        <div class="content__voucher-top">
                            <span class="voucher-label">Ngày bắt đầu:</span>
                            <span class="voucher-text voucher_start_date"></span>
                        </div>
                        <div class="content__voucher-top">
                            <span class="voucher-label">Ngày kết thúc:</span>
                            <span class="voucher-text voucher_end_date"></span>
                        </div>
                        
                    </div>
                    <div class="separation"></div>
                    <div class="content" style="border-radius: 6px">
                        <div class="content__voucher-info">
                            <div class="content__voucher-info--amount">
                                <span class="voucher-label">Số tiền được giảm:</span>
                                <span class="voucher-text voucher_amount"></span>
                            </div>
                            <div class="content__voucher-info--quantity">
                                <span class="voucher-label">Số lượng voucher:</span>
                                <span class="voucher-text voucher_quantity"></span>
                            </div>
                            <div class="content__voucher-info--status">
                                <span class="voucher-label">Trạng thái:</span>
                                <span class="voucher-text voucher_status"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-modal-footer">
                    <button class="btn btn-secondary btn_close_modal" style="margin-right: 10px">TRỞ LẠI</button>
                </div>
            </div> --}}
            <div class="modal fade" id="modal_voucher">
                <div class="modal-dialog modal-dialog-centered" style="max-width: 900px;">
                    <div class="modal-content" style="height: 550px;">
    
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Chi Tiết Voucher</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
    
                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="content content_top">
                                <div class="content_top--left">
                                    <img src="{{ asset('public/upload/voucher_admin.png') }}" alt="voucher image" class="voucher_img">
                                </div>
                                <div class="content_top--right">
                                    <div class="content__voucher-top">
                                        <span class="voucher-label">Code:</span>
                                        <span class="voucher-text voucher_code"></span>
                                    </div>
                                    <div class="content__voucher-top">
                                        <span class="voucher-label">Tên voucher:</span>
                                        <span class="voucher-text voucher_name"></span>
                                    </div>
                                    <div class="content__voucher-top">
                                        <span class="voucher-label">Áp dụng cho sản phẩm:</span>
                                        <span class="voucher-text voucher_product"></span>
                                    </div>
                                    <div class="content__voucher-top">
                                        <span class="voucher-label">Ngày bắt đầu:</span>
                                        <span class="voucher-text voucher_start_date"></span>
                                    </div>
                                    <div class="content__voucher-top">
                                        <span class="voucher-label">Ngày kết thúc:</span>
                                        <span class="voucher-text voucher_end_date"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="content content_bottom">
                                <div class="content__voucher-info">
                                    <div class="content__voucher-info--bottom">
                                        <span class="voucher-label">Số tiền được giảm:</span>
                                        <span class="voucher-text voucher_amount"></span>
                                    </div>
                                    <div class="content__voucher-info--bottom">
                                        <span class="voucher-label">Số lượng voucher:</span>
                                        <span class="voucher-text voucher_quantity"></span>
                                    </div>
                                    <div class="content__voucher-info--bottom">
                                        <span class="voucher-label">Trạng thái:</span>
                                        <span class="voucher-text voucher_status"></span>
                                    </div>
                                </div>
                            </div> 
                        </div>
    
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('public/font_end/assets/js/jquery-3.4.1.min.js') }}"></script>
        <script src="{{ asset('public/back_end/custom_voucher/modal_voucher.js') }}"></script>
        <script src="{{ asset('public/back_end/custom_voucher/search_voucher.js') }}"></script>
    @endsection
