<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="/admin/dashboard"><img src="{{ url('template/images/aa.png') }}"
                class="mr-2" alt="logo" /></a>
        <a class="navbar-brand brand-logo-mini" href="/admin/dashboard"><img src="" alt="logo" /></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item dropdown">

            </li>
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" href="{{ url('admin/update_admin_details') }}"
                    data-toggle="dropdown" id="profileDropdown">
                    @if (!empty(Auth::guard('admin')->user()->image))
                    <img src="{{ url('template/images/Photo/'.Auth::guard('admin')->user()->image) }}" alt="Profile">
                    @else
                    <img src="{{ url('template/images/noimage.jpg') }}" alt="">
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                    <a href="{{ url('admin/update_admin_details') }}" class="dropdown-item">
                        <i class="ti-settings text-primary"></i>
                        Settings
                    </a>
                    <a href="{{ url('admin/logout') }}" class="dropdown-item">
                        <i class="ti-power-off text-primary"></i>
                        Logout
                    </a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="icon-menu"></span>
        </button>
    </div>
</nav>