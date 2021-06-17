<div class="user-info-dropdown">
    <div class="dropdown">
        <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
            <span class="user-icon">

                @if(Session::get('admin_image'))

                    <img src="{{ asset('public/upload/'.Session::get('admin_image')) }}" alt="">

                @endif
            </span>
            <span class="user-name">
                @if (Session::get('admin_name'))
                    {{ Session::get('admin_name') }}
                @endif
            </span>
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
            <a class="dropdown-item" href="profile.html"><i class="dw dw-user1"></i> Profile</a>
            <a class="dropdown-item" href="profile.html"><i class="dw dw-settings2"></i> Setting</a>
            <a class="dropdown-item" href="faq.html"><i class="dw dw-help"></i> Help</a>
            <a class="dropdown-item" href="{{ URL::to('logout_admin') }}"><i class="dw dw-logout"></i> Log Out</a>
        </div>
    </div>
</div>
