<link rel="stylesheet" href="{{ asset('public/font_end/bootstrap/css/bootstrap.min.css') }}">
@extends('client.layout_client')
@section('content_body')
<link rel="stylesheet" href="{{ asset('public/font_end/custom_account/user_sidebar_content.css') }}">
<link rel="stylesheet" href="{{ asset('public/font_end/custom_account/user_address_account.css') }}">
<link rel="stylesheet" href="{{ asset('public/font_end/custom_account/modal_address.css') }}">
    <div class="container">
        <nav class="biolife-nav">
            <ul>
                <li class="nav-item"><a href="index-2.html" class="permal-link">Home</a></li>
                <li class="nav-item"><a href="#" class="permal-link">Natural Organic</a></li>
                <li class="nav-item"><span class="current-page">Fresh Fruit</span></li>
            </ul>
        </nav>
    </div>
    <div class="page-contain">

        <!-- Main content -->
        <div id="main-content" class="main-content">
            <div class="container">
                <div class="row">

                    <!--sidebar-->
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <nav class="user">
                            <div class="user-heading">
                                <img src="{{ asset('public/upload/'.$customer_info->customer_avt) }}" alt="" class="user-img">
                                <span class="user-name">{{ $customer->username }}</span>
                            </div>
                            <ul class="user-list-module">
                                <li class="user-module-item">
                                    <a href="{{ URL::to('user/account') }}" class="user-module-item--link">Hồ sơ</a>
                                </li>
                                <li class="user-module-item user-module-item--active">
                                    <a href="{{ URL::to('user/address') }}" class="user-module-item--link">Địa chỉ</a>
                                </li>
                                <li class="user-module-item">
                                    <a href="{{ URL::to('user/resetpassword') }}" class="user-module-item--link">Đổi mật khẩu</a>
                                </li>
                                <li class="user-module-item">
                                    <a href="{{ URL::to('user/order') }}" class="user-module-item--link">Đơn mua</a>
                                </li>
                                <li class="user-module-item">
                                    <a href="#" class="user-module-item--link">Thông báo</a>
                                </li>
                                <li class="user-module-item">
                                    <a href="#" class="user-module-item--link">Kho Voucher</a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                    <!--content-user-->
                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12" style="background-color: rgb(245, 245, 245); height:auto; margin-bottom: 32px; border-bottom: 1px solid #ddd;">
                        <div class="card-box-mb-30" style="margin-top: 8px">
                            @if($errors->any())
                                <div class="alert alert-danger alert-blog">{{ $errors->first() }}</div>
                            @endif
                        </div>
                        <div class="content__user-address">
                            <div class="content__user-address-heading">
                                <span class="user-heading-address-title">Địa chỉ của tôi</span>
                                <button class="btn-add-address lookup" id="btn-open-model-add_address" data-toggle="modal_add_address"
                                data-target="#add_address_account"><span class="icon-copy ti-plus"></span> Thêm địa chỉ</button>
                            </div>

                            @foreach ($all_address as $address)
                                
                            
                            <div class="address-card">
                                <div class="address-dislay__left">
                                    <div class="address-display__field-container">
                                        <div class="address-display__field-label">Họ và Tên</div>
                                        <div class="address-display__field-content">
                                            <span class="address-display__name-text">
                                                {{ $address->trans_fullname }}
                                            </span>
                                            @if ($address->trans_status == 1)
                                                <div class="address-default">Mặc Định</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="address-display__field-container">
                                        <div class="address-display__field-label">Số điện thoại</div>
                                        <div class="address-display__field-content">
                                            {{ $address->trans_phone }}
                                        </div>
                                    </div>

                                    <div class="address-display__field-container">
                                        <div class="address-display__field-label">Địa chỉ</div>
                                        <div class="address-display__field-content">
                                            <span>{{ $address->trans_address }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="address-display__button">
                                    <div class="address-display__button-group">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                        <span  class="address-btn-action update_address get_trans_id_update_address" data-id = {{ $address->trans_id }} id="btn-open-model-update_address_{{ $address->trans_id }}" data-toggle="modal_update_address" 
                                            data-target="#modal_update_address">Sửa</span>
                                        @if ($address->trans_status == 0)
                                            <span class="address-btn-action delete_address get_trans_id" data-id = {{ $address->trans_id }} id="btn-open-model-delete_address_{{ $address->trans_id }}" data-toggle="modal_delete_address" 
                                                data-target="#modal_delete_address">Xóa</span>
                                        @endif
                                    </div>
                                    <div class="address-display__button-group">
                                        @if($address->trans_status == 1)
                                            <button class="address-btn-action-primary--disable">Thiết Lập Mặc Định</button>
                                        @else
                                            <form action="{{ URL::to('process_mode_default') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="trans_id" value="{{ $address->trans_id }}">
                                                <button type="submit" class="address-btn-action-primary">Thiết Lập Mặc Định</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            @endforeach

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- The Modal Add Address Trans -->
    <div class="modal_add_address modal" id="modal_add_address">
        <!-- Modal content -->
        <div class="modal-content_address container">
            <div class="modal-header-cus modal-header-address">
                <span class="close close_modal_address">&times;</span>
                <h4>Địa Chỉ Mới</h4>
            </div>
            <div class="modal-body-cus">
                <div class="content-add-address">
                    <form action="{{ URL::to('process_add_address') }}" method="post" name="add_transport">
                        @csrf
                        <div class="line">
                            <input type="text" class="form-control input upper_val" name="trans_fullname"
                            value="{{ old('trans_fullname') }}" onblur="return upberFirstKey()" placeholder="Họ và tên">
                            <div class="" style="width: 50px"></div>

                            <input type="text" class="form-control input upper_val" name="trans_phone"
                            value="{{ old('trans_phone') }}" onblur="return upberFirstKey()" placeholder="Số điện thoại">
                        </div>
                        <div class="line">
                            <select name="city" id="city_add_address" value="{{ old('city') }}" class="select" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                <option value="">Chọn Tỉnh/TP</option>
                                @foreach ($citys as $city)
                                    <option value="{{ $city->matp }}">{{ $city->name_tp }}</option>
                                @endforeach
                            </select>

                            <select name="district" id="district_add_address" value="{{ old('district') }}" class="select">
                                <option value="">Chọn Quận/Huyện</option>
                            </select>

                            <select name="ward" id="ward_add_address" value="{{ old('ward') }}" class="select">
                                <option value="">Chọn Phường/Xã</option>
                            </select>
                        </div>
                        <div class="line">
                            <textarea name="trans_address_detail" cols="80" rows="3" value="{{ old('trans_address_detail') }}" placeholder="Địa chỉ cụ thể"></textarea>
                        </div>
                    </form>
                </div>
            </div>
            <div class="content-modal-footer-address">
                <button class="btn btn-secondary btn-back-modal-address" id="close" style="margin-right: 10px">TRỞ LẠI</button>
                <button class="btn btn-success btn_add_address">HOÀN THÀNH</button>
            </div>
        </div>
    </div>

    <div class="modal_delete_address modal" id="modal_delete_address">
        <!-- Modal content -->
        <div class="modal-content_delete_address container">
            <div class="modal-header-cus modal-header-address">
                <span class="close_delete_address close">&times;</span>
                <h4>Thông báo</h4>
            </div>
            <div class="modal-body-cus">
                <div class="content-delete-address">
                    Bạn có thực sự muốn xóa địa chỉ này không?
                    <form action="{{ URL::to('process_delete_address') }}" method="post" name="form_delete_address">
                        @csrf
                        <input type="hidden" name="trans_id" class="delete_address">
                    </form>
                </div>
            </div>
            <div class="content-modal-footer-address">
                <button class="btn btn-secondary btn-back-modal-address" id="close_delete_address" style="margin-right: 10px">TRỞ LẠI</button>
                <button class="btn btn-success btn_delete_address">XÓA</button>
            </div>
        </div>
    </div>

    <div class="modal_update_address modal" id="modal_update_address">
        <!-- Modal content -->
        <div class="modal-content_address container">
            <div class="modal-header-cus modal-header-address">
                <span class="close_update_address close">&times;</span>
                <h4>Địa Chỉ Mới</h4>
            </div>
            <div class="modal-body-cus">
                <div class="content-add-address">
                    {{-- <form action="{{ URL::to('process_update_address') }}" method="post" name="update_transport">
                        @csrf
                        <label>Họ Và Tên</label>
                        
                        <input class="form-control upper_val fullname_address_update" type="text" name="trans_fullname"
                        onblur="return upberFirstKey()" value=""
                        placeholder="Nhập Họ Và Tên">

                        <label>Số Điện Thoại</label>
                        <input class="form-control upper_val phone_address_update" type="text" name="trans_phone"
                            onblur="return upberFirstKey()" value=""
                        placeholder="Nhập Số Điện Thoại">
                    </form> --}}



                    <form action="{{ URL::to('process_update_address') }}" method="post" name="update_transport">
                        @csrf
                        <div class="line">
                            <input type="hidden" class="trans_id" name="trans_id">
                            <input type="text" class="form-control input upper_val fullname_address_update" name="trans_fullname"
                            value="{{ old('trans_fullname') }}" onblur="return upberFirstKey()" placeholder="Họ và tên">
                            <div class="" style="width: 50px"></div>

                            <input type="text" class="form-control input upper_val phone_address_update" name="trans_phone"
                            value="{{ old('trans_phone') }}" onblur="return upberFirstKey()" placeholder="Số điện thoại">
                        </div>
                        <div class="line">
                            <select name="city" id="city_update_address" value="{{ old('city') }}" class="select" data-select2-id="4" tabindex="-1" aria-hidden="true">
                                <option value="">Chọn Tỉnh/TP</option>
                                @foreach ($citys as $city)
                                    <option value="{{ $city->matp }}">{{ $city->name_tp }}</option>
                                    {{-- @if ($address[0] == $city->name_tp)
                                        <option value="{{ $city->matp }}" selected>{{ $city->name_tp }}</option>
                                    @else
                                        <option value="{{ $city->matp }}">{{ $city->name_tp }}</option>
                                    @endif --}}
                                @endforeach
                            </select>

                            <select name="district" id="district_update_address" value="{{ old('district') }}" class="select">
                                <option value="">Chọn Quận/Huyện</option>
                                {{-- @foreach ($districts as $dis)
                                    @if ($dis->name_qh == $address[1])
                                        <option value="{{ $dis->maqh }}">{{ $address[1] }}</option>
                                    @endif
                                @endforeach --}}
                            </select>

                            <select name="ward" id="ward_update_address" value="{{ old('ward') }}" class="select">
                                <option value="">Chọn Phường/Xã</option>
                                {{-- @foreach ($wards as $ward)
                                    @if ($ward->name_xa == $address[2])
                                        <option value="{{ $ward->xaid }}">{{ $address[2] }}</option>
                                    @endif
                                @endforeach --}}
                            </select>
                        </div>
                        <div class="line">
                            <textarea class="address_detail_trans_update" name="trans_address_detail" cols="80" rows="3" value="{{ old('trans_address_detail') }}" placeholder="Địa chỉ cụ thể"></textarea>
                        </div>
                    </form>
                </div>
            </div>
            <div class="content-modal-footer-address">
                <button class="btn btn-secondary btn-back-modal-address" id="close_update_address" style="margin-right: 10px">TRỞ LẠI</button>
                <button class="btn btn-success btn_update_address">HOÀN THÀNH</button>
            </div>
        </div>
    </div>

    <script src="{{ asset('public/font_end/assets/js/jquery-3.4.1.min.js') }}"></script>
    {{-- check out custom --}}
    <script src="{{ asset('public/font_end/custom_account/custom.js') }}"></script>
    <script src="{{ asset('public/font_end/custom_account/modal_delete_address.js') }}"></script>
    <script src="{{ asset('public/font_end/custom_account/address.js') }}"></script>
@endsection
