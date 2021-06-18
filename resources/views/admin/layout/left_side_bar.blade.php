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
                <li>
                    <div class="dropdown-divider"></div>
                </li>

                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon icon-copy ti-harddrives"></span><span class="mtext">Loại sản phẩm</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ URL::to('admin/all_category') }}">Danh Sách loại sản phẩm</a></li>
                        <li><a href="{{ URL::to('admin/add_category') }}">Thêm loại sản phẩm</a></li>
                    </ul>
                </li>
                <li>
                    <div class="dropdown-divider"></div>
                </li>
            </ul>

        </div>
    </div>
</div>
