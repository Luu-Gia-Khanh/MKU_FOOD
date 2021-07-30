@if (count($all_voucher) > 0)
<div class="row">
    <div class="col-12">
        <table class="data-table table table-striped nowrap no-footer table-hover"
            id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
            <thead>
                <tr role="row" class="text-center">
                    <th style="width: 2%;" class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                        colspan="1">STT</th>
                    <th style="width: 11%;" class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                        colspan="1" data-defaultsort="disabled">Mã Voucher</th>
                    <th style="width: 26%;" class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                        colspan="1" data-defaultsign="AZ">Tên Voucher</th>
                    <th style="width: 17%;" class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                        colspan="1">Ngày Bắt Đầu</th>
                    <th style="width: 17%;" class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                        colspan="1">Ngày Kết Thúc</th>
                    <th style="width: 15%;" class="datatable-nosort sorting_disabled" rowspan="1" colspan="1"
                        aria-label="Action" data-defaultsort="disabled">Tình Trạng</th>
                    <th style="width: 12%;" class="datatable-nosort sorting_disabled" rowspan="1" colspan="1"
                        aria-label="Action" data-defaultsort="disabled">Thao Tác</th>
                </tr>
            </thead>
            <tbody class="content_find_voucher">
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
                        @if ($voucher->status == 1)
                            <span class="badge badge-success" style="width: 105px;">Đang áp dụng</span>
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
                                <button class="dropdown-item btn_open_modal" data-id={{ $voucher->voucher_id }}><i class="dw dw-eye"></i>Xem chi tiết</button>
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
@else
    <div class="center">Không tìm thấy kết quả nào</div>
@endif
<script src="{{ asset('public/font_end/assets/js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('public/back_end/custom_voucher/modal_voucher.js') }}"></script>
