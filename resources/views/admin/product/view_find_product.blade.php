@if (count($all_product)>0)
    <div class="row">
        <div class="col-12 table-responsive">
            <table class="data-table table table-hover multiple-select-row nowrap no-footer dtr-inline" id="DataTables_Table_0"
                role="grid" aria-describedby="DataTables_Table_0_info">
                <thead>
                    <tr role="row">
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">STT
                        </th>
                        <th class="table-plus datatable-nosort sorting_asc" rowspan="1" colspan="1" aria-label="Name">
                            Hình
                            Ảnh</th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Tên
                            Sản
                            Phẩm</th>
                        {{-- <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Đơn
                            vị
                            tính</th> --}}
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Loại
                            Sản
                            Phẩm</th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Giá
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                            colspan="1">Kho</th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Mới
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Đặc
                            Trưng</th>
                        <th class="datatable-nosort sorting_disabled" rowspan="1" colspan="1" aria-label="Action">Thao
                            Tác
                        </th>
                    </tr>
                </thead>
                <tbody class="">
                    @php
                        $stt = 1;
                    @endphp
                    @foreach ($all_product as $prod)
                        <tr role="row" class="odd">
                            <td>{{ $stt++ }}</td>
                            <td class="table-plus sorting_1" tabindex="0">
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
                                                {{ $storage->storage_name }}
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </td>
                            <td class="center">
                                @if ($prod->is_new == 1)
                                    <i class="icon-copy fa fa-check" aria-hidden="true"
                                        style="font-size: 25px; color: rgb(5, 199, 30)"></i>
                                @else
                                    <i class="icon-copy fa fa-close" aria-hidden="true"
                                        style="font-size: 25px; color: rgb(207, 51, 11)"></i>
                                @endif
                            </td>
                            <td class="center">
                                @if ($prod->is_featured == 1)
                                    <a href="{{ URL::to('admin/is_not_featured/' . $prod->product_id) }}"><i
                                            class="icon-copy fa fa-check" aria-hidden="true"
                                            style="font-size: 25px; color: rgb(5, 199, 30)"></i></a>
                                @else
                                    <a href="{{ URL::to('admin/is_featured/' . $prod->product_id) }}"><i
                                            class="icon-copy fa fa-close" aria-hidden="true"
                                            style="font-size: 25px; color: rgb(207, 51, 11)"></i></a>
                                @endif
                            </td>
                            <td class="">
                                <div class="dropdown">
                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#"
                                        role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                        <a class="dropdown-item" href=""><i class="dw dw-eye"></i>Thông tin sản phẩm</a>
                                        <a class="dropdown-item"
                                            href="{{ URL::to('admin/update_product/' . $prod->product_id) }}"><i
                                                class="dw dw-edit2"></i>Chỉnh Sửa</a>
                                        <button class="dropdown-item soft_delete_product_class"
                                            data-id="{{ $prod->product_id }}" data-toggle="modal"
                                            data-target="#Modal_delete_product"><i
                                                class="dw dw-delete-3"></i>Xóa</button>
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
            <a href="{{ URL::to('admin/view_recycle_product') }}" class="btn color-btn-them ml-10"
                style="color: white"><i class="dw dw-delete-3"></i> Thùng Rác</a>
        </div>
        <div class="col-sm-12 col-md-7">
            {{-- <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
            <ul class="pagination">
                {!! $all_product->links() !!}
            </ul>
        </div> --}}
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
@else
    <div class="content_message center">
        Không tìm thấy kết quả nào
    </div>
@endif
<script>
    $('.soft_delete_product_class').click(function(){
        var product_id = $(this).attr('data-id');
        $('.id_delete_product').val(product_id);
    });
    $('.btn_delete_soft_product').click(function(){
        var form_delete = document.forms['form_soft_delete_product'];
        form_delete.submit();
    });
</script>
