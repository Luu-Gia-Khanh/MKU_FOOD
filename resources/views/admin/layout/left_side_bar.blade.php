<div class="left-side-bar">
    <div class="brand-logo">
        <a href="{{ URL::to("/admin") }}">
            <img id="logo_left_side_admin" src="{{ asset('public/upload/logo_mku_9.svg') }}" alt="" style="height: 46px;">
        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu">

            <ul id="accordion-menu">
                @hasrole(['admin','manager'])
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon dw dw-house-1"></span>
                        <span class="mtext">Quản Trị</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ URL::to('admin/all_admin') }}">Danh Sách Quản Trị</a></li>
                        <li><a href="{{ URL::to('admin/add_admin') }}">Thêm Quản Trị Viên</a></li>
                        <li><a href="{{ URL::to('admin/list_permission') }}">Phân Quyền</a></li>
                    </ul>
                </li>
                @endhasrole
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon dw dw-inbox-4"></span>
                        <span class="mtext">Sản Phẩm</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ URL::to('admin/add_product') }}">Thêm Sản Phẩm</a></li>
                        <li><a href="{{ URL::to('admin/all_product') }}">Danh Sách Sản Phẩm</a></li>
                    </ul>
                </li>

                {{-- CATEGORY --}}

                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon dw dw-list3"></span>
                        <span class="mtext">Danh Mục</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ URL::to('admin/all_category') }}">Danh Sách Danh Mục</a></li>
                        <li><a href="{{ URL::to('admin/add_category') }}">Thêm Danh Mục</a></li>
                    </ul>
                </li>

                {{-- STORAGE --}}

                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon dw dw-wallet"></span>
                        <span class="mtext">Kho Hàng</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ URL::to('admin/all_storage') }}">Danh Sách Kho Hàng</a></li>
                    </ul>
                </li>

                {{-- ORDER --}}
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon dw dw-file"></span>
                        <span class="mtext">Đơn Hàng</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ URL::to('admin/all_order') }}">Danh Sách Đơn Hàng</a></li>
                    </ul>
                </li>

                {{-- COMMENT --}}
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon dw dw-chat-4"></span>
                        <span class="mtext">Duyệt Bình Luận</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ URL::to('admin/view_comment_to_process') }}">Bình luận chờ duyệt</a></li>
                    </ul>
                </li>

                {{-- SHIPPING CODE --}}
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon dw dw-file"></span>
                        <span class="mtext">Phí Vận Chuyển</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ URL::to('admin/all_shipping_cost') }}">Danh Sách Phí</a></li>
                        <li><a href="{{ URL::to('admin/add_shipping_cost') }}">Thêm Phí Vận Chuyển</a></li>
                    </ul>
                </li>

                <li>
                    <div class="dropdown-divider"></div>
                </li>

                {{-- CUSTOMER --}}
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon dw dw-user2"></span>
                        <span class="mtext">Khách Hàng</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ URL::to('admin/all_customer') }}">Danh Sách Khách Hàng</a></li>
                    </ul>
                </li>
                <li>
                    <div class="dropdown-divider"></div>
                </li>

            {{-- EVENT DISCOUNT --}}
                <li>
                    <div class="sidebar-small-cap">Sự Kiện</div>
                </li>
                {{-- DISCOUNT --}}
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon dw dw-analytics-111"></span>
                        <span class="mtext">Giảm Giá</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ URL::to('admin/all_discount') }}">Danh Sách Giảm Giá</a></li>
                        <li><a href="{{ URL::to('admin/add_discount') }}">Thêm Giảm Giá</a></li>
                    </ul>
                </li>

                {{-- VOUCHER --}}
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon dw dw-ticket-1"></span>
                        <span class="mtext">Voucher</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ URL::to('admin/all_product_voucher') }}">DS Sản Phẩm Voucher</a></li>
                        <li><a href="{{ URL::to('admin/add_voucher') }}">Thêm Voucher</a></li>
                    </ul>
                </li>


                <li>
                    <div class="dropdown-divider"></div>
                </li>
            {{-- FONT-END --}}
                <li>
                    <div class="sidebar-small-cap">Giao Diện</div>
                </li>
                {{-- SLIDER --}}
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon dw dw-slideshow"></span>
                        <span class="mtext">Slider</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ URL::to('admin/all_slider') }}">Danh sách slider</a></li>
                        <li><a href="{{ URL::to('admin/add_slider') }}">Thêm slider</a></li>
                    </ul>
                </li>


            </ul>
        </div>
    </div>
</div>
