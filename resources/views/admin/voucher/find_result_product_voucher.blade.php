@if (count($all_product_voucher) > 0)
<div class="row">
    <div class="col-12">
        <table class="data-table table table-hover multiple-select-row nowrap no-footer dtr-inline sortable"
        id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
            <thead>
                <tr role="row" class="text-center">
                    <th style="width: 5%;" class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                        colspan="1">STT</th>
                    <th style="width: 40%;" class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                        colspan="1" data-defaultsign="AZ">Tên Voucher</th>
                    <th style="width: 30%;" class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                        colspan="1">Số Lượng Voucher</th>
                    <th style="width: 30%;" class="datatable-nosort sorting_disabled" rowspan="1" colspan="1"
                        aria-label="Action" data-defaultsort="disabled">Thao Tác</th>
                </tr>
            </thead>
            <tbody class="content_find_product_voucher">
                @php
                    $stt = 0;
                @endphp
                @foreach ($all_product_voucher as $product_voucher)
                    @php
                        $stt++;
                    @endphp
                <tr role="row" class="odd text-center">
                    <td>{{ $stt }}</td>
                    <td>{{ $product_voucher->product_name }}</td>
                    <td>
                        @php
                            $count_voucher = 0;
                        @endphp
                        @foreach ($all_voucher as $voucher)
                            @if ($voucher->product_id == $product_voucher->product_id)
                                @php
                                    $count_voucher++;
                                @endphp                                                       
                            @endif
                        @endforeach
                        {{ $count_voucher }}
                    </td>
                    <td>
                        <div class="dropdown">
                            <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                href="#" role="button" data-toggle="dropdown">
                                <i class="dw dw-more"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                <a class="dropdown-item" href="{{ URL::to('admin/all_voucher/'.$product_voucher->product_id) }}"><i class="dw dw-eye"></i>Xem danh sách voucher</a>
                                <a class="dropdown-item" href="{{ URL::to('admin/add_voucher') }}"><i class="icon-copy dw dw-add"></i>Thêm voucher</a>                                                  
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