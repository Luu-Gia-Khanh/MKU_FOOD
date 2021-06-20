@extends('admin.layout_admin')
@section('container')
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="title">
                        <h4>Thông Tin Cá Nhân</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ URL::to('admin/dashboard') }}">Trang chủ</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Thông tin cá nhân</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        {{-- message --}}
        @if (session('update_profile_success'))
            <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ session('update_profile_success') }}
            </div>
        @endif
        @if (session('change_password_success'))
            <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ session('change_password_success') }}
            </div>
        @endif
        @if (session('change_password_error_confirm'))
            <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ session('change_password_error_confirm') }}
            </div>
        @endif
        @if (session('change_password_error'))
            <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ session('change_password_error') }}
            </div>
        @endif
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
                <div class="pd-20 card-box height-100-p">
                    <div class="profile-photo">
                        <img src="{{ asset('public/upload/'.$view_profile->avt) }}" alt="" id="image_upload" class="avatar-photo">
                        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                        </div>
                    </div>
                    <h5 class="text-center h5 mb-0 following_name">{{ $view_profile->admin_name }}</h5>
                    <p class="text-center text-muted font-14">{{ $view_profile->name }}</p>
                    <div class="profile-info">
                        <h5 class="mb-20 h5 text-blue">Thông Tin Cá Nhân</h5>
                        <ul>
                            <li>
                                <span>Ngày Sinh:</span>
                                <div class="following_birthday">{{ $view_profile->admin_birthday }}</div>
                            </li>
                            <li>
                                <span>Giới Tính:</span>
                                <div class="following_birthday">{{ $view_profile->admin_gender }}</div>
                            </li>
                        </ul>
                    </div>
                    <div class="profile-info">
                        <h5 class="mb-20 h5 text-blue">Thông Tin Liên Hệ</h5>
                        <ul>
                            <li>
                                <span>Địa Chỉ Email:</span>
                                <div class="following_email">{{ $view_profile->admin_email }}</div>
                            </li>
                            <li>
                                <span>Số Điện Thoại:</span>
                                <div class="following_phone">{{ $view_profile->admin_phone }}</div>
                            </li>
                            <li>
                                <span>Địa Chỉ:</span>
                                @php
                                    $address = explode(', ', $view_profile->admin_address);
                                @endphp
                                <div style="display: inline-block">
                                    <div style="display: inline-block" class="following_city">{{ $address[0] }}, </div>
                                    <div style="display: inline-block" class="following_district">{{ $address[1] }}</div>
                                </div>
                                <div class="following_ward">{{ $address[2] }}</div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
                <div class="card-box height-100-p overflow-hidden">
                    <div class="profile-tab height-100-p">
                        <div class="tab height-100-p">
                            <ul class="nav nav-tabs customtab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active tab_timeline" data-toggle="tab" href="#timeline" role="tab" aria-selected="true">Timeline</a>
                                </li>
                                @if (Session::get('admin_id') == 1 || $view_profile->admin_id == Session::get('admin_id'))
                                    <li class="nav-item">
                                        <a class="nav-link tab_change_info" data-toggle="tab" href="#setting" role="tab" aria-selected="false">Cập Nhật Thông Tin</a>
                                    </li>
                                @endif

                            </ul>
                            <div class="tab-content">
                                <!-- Timeline Tab start -->
                                <div class="tab-pane fade active show content_tab_time_line" id="timeline" role="tabpanel">
                                    <div class="pd-20">
                                        <div class="profile-timeline">
                                            <div class="timeline-month">
                                                <h5>August, 2020</h5>
                                            </div>
                                            <div class="profile-timeline-list">
                                                <ul>
                                                    <li>
                                                        <div class="date">12 Aug</div>
                                                        <div class="task-name"><i class="ion-android-alarm-clock"></i> Task Added</div>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                                        <div class="task-time">09:30 am</div>
                                                    </li>
                                                    <li>
                                                        <div class="date">10 Aug</div>
                                                        <div class="task-name"><i class="ion-ios-chatboxes"></i> Task Added</div>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                                        <div class="task-time">09:30 am</div>
                                                    </li>
                                                    <li>
                                                        <div class="date">10 Aug</div>
                                                        <div class="task-name"><i class="ion-ios-clock"></i> Event Added</div>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                                        <div class="task-time">09:30 am</div>
                                                    </li>
                                                    <li>
                                                        <div class="date">10 Aug</div>
                                                        <div class="task-name"><i class="ion-ios-clock"></i> Event Added</div>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                                        <div class="task-time">09:30 am</div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="timeline-month">
                                                <h5>July, 2020</h5>
                                            </div>
                                            <div class="profile-timeline-list">
                                                <ul>
                                                    <li>
                                                        <div class="date">12 July</div>
                                                        <div class="task-name"><i class="ion-android-alarm-clock"></i> Task Added</div>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                                        <div class="task-time">09:30 am</div>
                                                    </li>
                                                    <li>
                                                        <div class="date">10 July</div>
                                                        <div class="task-name"><i class="ion-ios-chatboxes"></i> Task Added</div>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                                        <div class="task-time">09:30 am</div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="timeline-month">
                                                <h5>June, 2020</h5>
                                            </div>
                                            <div class="profile-timeline-list">
                                                <ul>
                                                    <li>
                                                        <div class="date">12 June</div>
                                                        <div class="task-name"><i class="ion-android-alarm-clock"></i> Task Added</div>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                                        <div class="task-time">09:30 am</div>
                                                    </li>
                                                    <li>
                                                        <div class="date">10 June</div>
                                                        <div class="task-name"><i class="ion-ios-chatboxes"></i> Task Added</div>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                                        <div class="task-time">09:30 am</div>
                                                    </li>
                                                    <li>
                                                        <div class="date">10 June</div>
                                                        <div class="task-name"><i class="ion-ios-clock"></i> Event Added</div>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                                        <div class="task-time">09:30 am</div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Timeline Tab End -->
                                <!-- Setting Tab start -->
                                <div class="tab-pane fade height-100-p content_tab_change_info" id="setting" role="tabpanel">
                                    <div class="card">
                                        <div class="card-header">
                                            <button class="btn btn-block collapsed" data-toggle="collapse" data-target="#edit-profile-info" aria-expanded="false">
                                                Cập Nhật Thông Tin Cá Nhân
                                            </button>
                                        </div>
                                        <div id="edit-profile-info" class="collapse" style="">
                                            <div class="card-body">
                                                <div class="profile-setting">
                                                    <form action="{{ URL::to('admin/process_update_profile_admin/'.$view_profile->admin_id) }}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <ul class="profile-edit-list row">
                                                            <li class="weight-500 col-md-6">
                                                                <div class="form-group">
                                                                    <label>Họ Và Tên</label>
                                                                    <input class="form-control upper_val form-control-lg change_name" type="text" name="admin_name"
                                                                        value="{{ $view_profile->admin_name }}" onblur="return upberFirstKey()"
                                                                        placeholder="Nhập Họ Và Tên">
                                                                    @if ($errors->has('admin_name'))
                                                                        <div class="alert alert-danger alert-dismissible mt-1">
                                                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                                            {{ $errors->first('admin_name') }}
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Giới Tính</label>
                                                                    <div class="dropdown bootstrap-select form-control dropup">
                                                                        <select name="admin_gender" class="selectpicker form-control form-control-lg change_gender" data-size="5">
                                                                            @if ($view_profile->admin_gender == 'Nam')
                                                                                <option value="Nam" selected>Nam</option>
                                                                                <option value="Nu">Nữ</option>
                                                                            @else
                                                                                <option value="Nam">Nam</option>
                                                                                <option value="Nu" selected>Nữ</option>
                                                                            @endif

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Số Điện Thoại</label>
                                                                    <input class="form-control form-control-lg change_phone" type="number" name="admin_phone"
                                                                        value="{{ $view_profile->admin_phone }}" placeholder="Nhập Số Điện Thoại">
                                                                    @if ($errors->has('admin_phone'))
                                                                        <div class="alert alert-danger alert-dismissible mt-1">
                                                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                                            {{ $errors->first('admin_phone') }}
                                                                        </div>
                                                                    @endif
                                                                    @if (session('check_phone'))
                                                                        <div class="alert alert-danger alert-dismissible mt-1">
                                                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                                            {{ session('check_phone') }}
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                                @php
                                                                    $address = explode(', ', $view_profile->admin_address);
                                                                @endphp
                                                                <div class="form-group">
                                                                    <label>Quận/Huyện</label>
                                                                    <select name="district" id="district_update_profile_admin"
                                                                        class="custom-select2 form-control select2-hidden-accessible form-control-lg"
                                                                        style="width: 100%; height: 38px;" data-select2-id="5" tabindex="-1" aria-hidden="true">
                                                                        @foreach ($districts as $dis)
                                                                            @if ($dis->name_qh == $address[1])
                                                                                <option value="{{ $dis->maqh }}">{{ $address[1] }}</option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                    @if ($errors->has('district'))
                                                                        <div class="alert alert-danger alert-dismissible mt-1">
                                                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                                            {{ $errors->first('district') }}
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Hình Ảnh</label>
                                                                    <input class="form-control" type="file" name="avt" id="file_upload"
                                                                        onchange="return uploadhinh()" placeholder="">
                                                                </div>
                                                            </li>
                                                            {{--  --}}
                                                            <li class="weight-500 col-md-6">
                                                                <div class="form-group">
                                                                    <label>Ngày Sinh</label>
                                                                    <input class="form-control form-control-lg change_birthday" type="date" name="admin_birthday"
                                                                        value="{{ $view_profile->admin_birthday }}" placeholder="Nhập Ngày Sinh">
                                                                    @if ($errors->has('admin_birthday'))
                                                                        <div class="alert alert-danger alert-dismissible mt-1">
                                                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                                            {{ $errors->first('admin_birthday') }}
                                                                        </div>
                                                                    @endif
                                                                    @if (session('check_age'))
                                                                        <div class="alert alert-danger alert-dismissible mt-1">
                                                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                                            {{ session('check_age') }}
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Thư Điện Tử(Email)</label>
                                                                    <input class="form-control form-control-lg change_email" type="text" name="admin_email"
                                                                        value="{{ $view_profile->admin_email }}"
                                                                        placeholder="Nhập Địa Chỉ Mail(........@.....)">
                                                                    @if ($errors->has('admin_email'))
                                                                        <div class="alert alert-danger alert-dismissible mt-1">
                                                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                                            {{ $errors->first('admin_email') }}
                                                                        </div>
                                                                    @endif
                                                                    @if (session('check_email'))
                                                                        <div class="alert alert-danger alert-dismissible mt-1">
                                                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                                            {{ session('check_email') }}
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                                <div class="form-group" data-select2-id="7">
                                                                    <label>Tỉnh/Thành Phố</label>
                                                                    <select name="city" id="city_update_profile"
                                                                        class="custom-select2 form-control select2-hidden-accessible form-control-lg"
                                                                        style="width: 100%; height: 38px;" data-select2-id="4" tabindex="-1" aria-hidden="true">
                                                                        @foreach ($citys as $city)
                                                                            @if ($address[0] == $city->name_tp)
                                                                                <option value="{{ $city->matp }}" selected>{{ $city->name_tp }}</option>
                                                                            @else
                                                                                <option value="{{ $city->matp }}">{{ $city->name_tp }}</option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                    @if ($errors->has('city'))
                                                                        <div class="alert alert-danger alert-dismissible mt-1">
                                                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                                            {{ $errors->first('city') }}
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Xã/Phường/Thị Trấn</label>
                                                                    <select name="ward" id="ward_update_profile_admin"
                                                                        class="custom-select2 form-control select2-hidden-accessible form-control-lg"
                                                                        style="width: 100%; height: 38px;" data-select2-id="6" tabindex="-1" aria-hidden="true">
                                                                        @foreach ($wards as $ward)
                                                                            @if ($ward->name_xa == $address[2])
                                                                                <option value="{{ $ward->xaid }}">{{ $address[2] }}</option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                    @if ($errors->has('ward'))
                                                                        <div class="alert alert-danger alert-dismissible mt-1">
                                                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                                            {{ $errors->first('ward') }}
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </li>
                                                            <div class="col-4"></div>
                                                            <div class="center mr-t">
                                                                <input type="submit" class="btn color-btn-them" value="Cập Nhật">
                                                                <button type="button" class="btn btn-danger btn_close_change_info" data-toggle="modal" data-target="#modal_close_change_info">Hủy Thay Đổi</button>
                                                            </div>
                                                        </ul>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <button class="btn btn-block collapsed" data-toggle="collapse" data-target="#faq1-1" aria-expanded="false">
                                                Thay đổi mật khẩu
                                            </button>
                                        </div>
                                        <div id="faq1-1" class="collapse" style="">
                                            <div class="card-body">
                                                <form action="{{ URL::to('admin/update_password_admin/'.$view_profile->admin_id) }}" method="post">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label>Mật Khẩu Củ</label>
                                                        <input class="form-control form-control-lg" type="password" name="old_password"
                                                            value="{{ old('old_password') }}" placeholder="Nhập mật khẩu củ">
                                                        @if ($errors->has('old_password'))
                                                            <div class="alert alert-danger alert-dismissible mt-1">
                                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                                {{ $errors->first('old_password') }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Nhập Mật Khẩu Mới</label>
                                                        <input class="form-control form-control-lg" type="password" name="new_password"
                                                            value="{{ old('new_password') }}" placeholder="Nhập mật khẩu mới">
                                                        @if ($errors->has('new_password'))
                                                            <div class="alert alert-danger alert-dismissible mt-1">
                                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                                {{ $errors->first('new_password') }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Nhập Lại Mật Khẩu</label>
                                                        <input class="form-control form-control-lg" type="password" name="confirm_password"
                                                            value="{{ old('confirm_password') }}" placeholder="Nhập lại mật khẩu mới">
                                                        @if ($errors->has('confirm_password'))
                                                            <div class="alert alert-danger alert-dismissible mt-1">
                                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                                {{ $errors->first('confirm_password') }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="center">
                                                        <input type="submit" class="btn color-btn-them" value="Thay Đổi">
                                                        <button type="button" class="btn btn-danger btn_close_change_info" data-toggle="modal" data-target="#modal_close_change_info">Hủy Thay Đổi</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- Setting Tab End -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- The Modal -->
    <div class="modal fade" id="modal_close_change_info">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title center">Thông Báo</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    Bạn Muốn Hủy Thay Đổi
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger confirm" data-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                </div>
            </div>
        </div>
    </div>
@endsection