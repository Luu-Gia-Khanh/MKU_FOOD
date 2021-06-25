@if (count($all_admin) > 0)
    <div class="row">
        <div class="col-12 table-responsive">
            <table class="data-table table table-hover multiple-select-row nowrap no-footer dtr-inline" id="DataTables_Table_0"
                role="grid" aria-describedby="DataTables_Table_0_info">
                <thead>
                    <tr role="row">
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">STT
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Họ
                            Và Tên</th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Số
                            Điện Thoại</th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">
                            Email</th>
                        <th class="datatable-nosort sorting_disabled" rowspan="1" colspan="1" aria-label="Action">Thao
                            Tác</th>
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
                            <td>
                                <div class="name-avatar d-flex align-items-center">
                                    <div class="avatar mr-2 flex-shrink-0">
                                        <img src="{{ asset('public/upload/'. $ad->avt) }}" class="border-radius-100 shadow" width="50" height="50" alt="">
                                    </div>
                                    <div class="txt">
                                        <div class="weight-600">{{ $ad->admin_name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $ad->admin_phone }}</td>
                            <td>{{ $ad->admin_email }}</td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#"
                                        role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                        <a class="dropdown-item"
                                            href="{{ URL::to('admin/view_profile/'.$ad->admin_id) }}"><i
                                                class="dw dw-eye"></i>Thông tin cá nhân</a>
                                        <a class="dropdown-item"
                                            href="{{ URL::to('admin/update_admin/'.$ad->admin_id) }}"><i
                                                class="dw dw-edit2"></i>Chỉnh Sửa</a>

                                        @if (Session::get('admin_id') != $ad->admin_id)
                                            <a href="{{ URL::to('admin/delete_when_find/'.$ad->admin_id) }}" class="dropdown-item test"
                                                ><i class="dw dw-delete-3"></i>Xóa</a>
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
            <a href="{{ URL::to('admin/view_recycle') }}" class="btn color-btn-them ml-10" style="color: white"><i
                    class="dw dw-delete-3"></i> Thùng Rác</a>
        </div>
        <div class="col-sm-12 col-md-7">
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
@else
    <div class="center">Không tìm thấy kết quả nào</div>
@endif
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
</script>
