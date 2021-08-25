<div class="left-side-bar">
    <div class="brand-logo">
        <a href="index.html">
            <img src="{{ asset('public/back_end/vendors/images/deskapp-logo.svg') }}" alt="" class="dark-logo">
            <img src="{{ asset('public/back_end/vendors/images/deskapp-logo-white.svg') }}" alt="" class="light-logo">
        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu">

            <ul id="accordion-menu">
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon dw dw-house-1"></span><span class="mtext">Quản Trị</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ URL::to('admin/all_admin') }}">Danh Sách Quản Trị</a></li>
                        <li><a href="{{ URL::to('admin/add_admin') }}">Thêm Quản Trị Viên</a></li>
                        <li><a href="{{ URL::to('admin/list_permission') }}">Phân Quyền</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon dw dw-house-1"></span><span class="mtext">Sản Phẩm</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ URL::to('admin/add_product') }}">Thêm Sản Phẩm</a></li>
                        <li><a href="{{ URL::to('admin/all_product') }}">Danh Sách Sản Phẩm</a></li>
                    </ul>
                </li>

                {{-- CUSTOMER --}}
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon icon-copy ti-harddrives"></span><span class="mtext">Khách Hàng</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ URL::to('admin/all_customer') }}">Danh Sách Khách Hàng</a></li>
                    </ul>
                </li>

                {{-- CATEGORY --}}

                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon icon-copy ti-harddrive"></span><span class="mtext">Loại Sản Phẩm</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ URL::to('admin/all_category') }}">Danh Sách Loại Sản Phẩm</a></li>
                        <li><a href="{{ URL::to('admin/add_category') }}">Thêm Loại Sản Phẩm</a></li>
                    </ul>
                </li>

                {{-- STORAGE --}}

                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon icon-copy ti-harddrives"></span><span class="mtext">Kho Hàng</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ URL::to('admin/all_storage') }}">Danh Sách Kho Hàng</a></li>
                    </ul>
                </li>

                {{-- ORDER --}}
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon icon-copy ti-harddrives"></span><span class="mtext">Đơn Hàng</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ URL::to('admin/all_order') }}">Danh Sách Đơn Hàng</a></li>
                    </ul>
                </li>

                {{-- DISCOUNT --}}
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon icon-copy ti-harddrives"></span><span class="mtext">Giảm Giá</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ URL::to('admin/all_discount') }}">Danh Sách Giảm Giá</a></li>
                        <li><a href="{{ URL::to('admin/add_discount') }}">Thêm Giảm Giá</a></li>
                    </ul>
                </li>

                {{-- VOUCHER --}}
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon icon-copy ti-harddrives"></span><span class="mtext">Voucher</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ URL::to('admin/all_product_voucher') }}">DS Sản Phẩm Voucher</a></li>
                        <li><a href="{{ URL::to('admin/add_voucher') }}">Thêm Voucher</a></li>
                    </ul>
                </li>

                {{-- SLIDER --}}
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon icon-copy ti-harddrives"></span><span class="mtext">Slider</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ URL::to('admin/all_slider') }}">Danh sách slider</a></li>
                        <li><a href="{{ URL::to('admin/add_slider') }}">Thêm slider</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon icon-copy ti-harddrives"></span><span class="mtext">Duyệt Bình Luận</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ URL::to('admin/view_comment_to_process') }}">Bình luận chờ duyệt</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
