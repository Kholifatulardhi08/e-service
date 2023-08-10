{{-- Sidebar layout --}}
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a @if (Session::get('page')=='dashboard' ) style="background: #4B4BAC !important;
                color: #fff !important;" @endif class="nav-link" href="{{ url('admin/dashboard') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        @if (Auth::guard('admin')->user()->type=="superadmin")
        <li class="nav-item">
            <a @if ( Session::get('page')=='view_penyedia' || Session::get('page')=='view_all' ) style="background: #4B4BAC !important;
            color: #fff !important;" @endif class="nav-link" data-toggle="collapse" href="#tables"
                aria-expanded="false" aria-controls="#tables">
                <i class="icon-columns menu-icon"></i>
                <span class="menu-title">Manage Admin</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="tables">
                <ul class="nav flex-column sub-menu" style="background: #fff !important; color: #4B4BAC !important;">
                    <li class="nav-item">
                        <a @if (Session::get('page')=='view_penyedia' ) style="background: #4B4BAC !important; 
                        color: #fff !important;" @else style="background: #fff !important; color: #4B4BAC !important;"
                            @endif class="nav-link" href="{{ url('admin/admins/penyedia') }}">Penyedia</a>
                    </li>
                    <li class="nav-item">
                        <a @if (Session::get('page')=='view_all' ) style="background: #4B4BAC !important; 
                        color: #fff !important;" @else style="background: #fff !important; color: #4B4BAC !important;"
                            @endif class="nav-link" href="{{ url('admin/admins') }}">All</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a @if ( Session::get('page')=='banners' ) style="background: #4B4BAC !important;
            color: #fff !important;" @endif class="nav-link" data-toggle="collapse" href="#banner"
                aria-expanded="false" aria-controls="#banner">
                <i class="icon-columns menu-icon"></i>
                <span class="menu-title">Manage Banners</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="banner">
                <ul class="nav flex-column sub-menu" style="background: #fff !important; color: #4B4BAC !important;">
                    <li class="nav-item">
                        <a @if (Session::get('page')=='banners' ) style="background: #4B4BAC !important; 
                        color: #fff !important;" @else style="background: #fff !important; color: #4B4BAC !important;"
                            @endif class="nav-link" href="{{ url('admin/banners') }}">Banners</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a @if (Session::get('page')=='penyewa' ) style="background: #4B4BAC !important;
            color: #fff !important;" @endif class="nav-link" data-toggle="collapse" href="#penyewa"
                aria-expanded="false" aria-controls="#penyewa">
                <i class="icon-columns menu-icon"></i>
                <span class="menu-title">Manage Users</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="penyewa">
                <ul class="nav flex-column sub-menu" style="background: #fff !important; color: #4B4BAC !important;">
                    <li class="nav-item">
                        <a @if (Session::get('page')=='penyewa' ) style="background: #4B4BAC !important; 
                        color: #fff !important;" @else style="background: #fff !important; color: #4B4BAC !important;"
                            @endif class="nav-link" href="{{ url('admin/penyewa') }}">Users</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item" @if (Session::get('page')=='sections' || Session::get('page')=='category' ||
            Session::get('page')=='products' ) style="background: #4B4BAC !important;
            color: #fff !important;" @endif>
            <a class="nav-link" data-toggle="collapse" href="#catalog-element" aria-expanded="false"
                aria-controls="#catalog-element">
                <i class="mdi mdi-application menu-icon"></i>
                <span class="menu-title">Manage Catalog</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="catalog-element">
                <ul class="nav flex-column sub-menu" style="background: #fff !important; color: #4B4BAC !important;">
                    <li class="nav-item">
                        <a @if (Session::get('page')=='sections' ) style="background: #4B4BAC !important; 
                        color: #fff !important;" @else style="background: #fff !important; color: #4B4BAC !important;"
                            @endif class="nav-link" href="{{ url('admin/section') }}">Sections</a>
                    </li>
                    <li class="nav-item">
                        <a @if (Session::get('page')=='categories' ) style="background: #4B4BAC !important; 
                        color: #fff !important;" @else style="background: #fff !important; color: #4B4BAC !important;"
                            @endif class="nav-link" href="{{ url('admin/category') }}">Category</a>
                    </li>
                    <li class="nav-item">
                        <a @if (Session::get('page')=='brands' ) style="background: #4B4BAC !important; 
                        color: #fff !important;" @else style="background: #fff !important; color: #4B4BAC !important;"
                            @endif class="nav-link" href="{{ url('admin/brands') }}">Brand</a>
                    </li>
                    <li class="nav-item">
                        <a @if (Session::get('page')=='products' ) style="background: #4B4BAC !important; 
                        color: #fff !important;" @else style="background: #fff !important; color: #4B4BAC !important;"
                            @endif class="nav-link" href="{{ url('admin/products') }}">Product</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a @if (Session::get('page')=='filter' ) style="background: #4B4BAC !important;
            color: #fff !important;" @endif class="nav-link" data-toggle="collapse" href="#filteres"
                aria-expanded="false" aria-controls="#filteres">
                <i class="icon-columns menu-icon"></i>
                <span class="menu-title">Manage Filter</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="filteres">
                <ul class="nav flex-column sub-menu" style="background: #fff !important; color: #4B4BAC !important;">
                    <li class="nav-item">
                        <a @if (Session::get('page')=='filter' ) style="background: #4B4BAC !important; 
                        color: #fff !important;" @else style="background: #fff !important; color: #4B4BAC !important;"
                            @endif class="nav-link" href="{{ url('admin/filters') }}">Filters</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a @if (Session::get('page')=='order' ) style="background: #4B4BAC !important;
            color: #fff !important;" @endif class="nav-link" data-toggle="collapse" href="#order" aria-expanded="false"
                aria-controls="#order">
                <i class="icon-columns menu-icon"></i>
                <span class="menu-title">Manage Order</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="order">
                <ul class="nav flex-column sub-menu" style="background: #fff !important; color: #4B4BAC !important;">
                    <li class="nav-item">
                        <a @if (Session::get('page')=='order' ) style="background: #4B4BAC !important; 
                        color: #fff !important;" @else style="background: #fff !important; color: #4B4BAC !important;"
                            @endif class="nav-link" href="{{ url('admin/orders') }}">Order</a>
                    </li>
                    <li class="nav-item">
                        <a @if (Session::get('page')=='rating' ) style="background: #4B4BAC !important; 
                        color: #fff !important;" @else style="background: #fff !important; color: #4B4BAC !important;"
                            @endif class="nav-link" href="{{ url('admin/ratings') }}">Ratings</a>
                    </li>
                </ul>
            </div>
        </li>
        @endif
        @if(Auth::guard('admin')->user()->type=="penyedia")
        <li class="nav-item">
            <a @if (Session::get('page')=='penyedia' || Session::get('page')=='jasadetail' ||
                Session::get('page')=='bank' ) style="background: #4B4BAC !important;
        color: #fff !important;" @endif class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false"
                aria-controls="ui-basic">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Setting Account</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu" style="background: #fff !important; color: #4B4BAC !important;">
                    <li class="nav-item">
                        <a @if (Session::get('page')=='update_admin_password' ) style="background: #4B4BAC !important; 
                        color: #fff !important;" @else style="background: #fff !important; color: #4B4BAC !important;"
                            @endif class="nav-link" href="{{ url('admin/update_admin_password') }}">Update Password</a>
                    </li>
                    <li class="nav-item">
                        <a @if (Session::get('page')=='penyedia' ) style="background: #4B4BAC !important; 
                        color: #fff !important;" @else style="background: #fff !important; color: #4B4BAC !important;"
                            @endif class="nav-link" href="{{ url('admin/update_penyedia_details/penyedia') }}">Personal
                            Details</a>
                    </li>
                    <li class="nav-item">
                        <a @if (Session::get('page')=='jasadetail' ) style="background: #4B4BAC !important; 
                        color: #fff !important;" @else style="background: #fff !important; color: #4B4BAC !important;"
                            @endif class="nav-link" href="{{ url('admin/update_penyedia_details/jasadetail') }}">Jasa
                            Details</a>
                    </li>
                    <li class="nav-item">
                        <a @if (Session::get('page')=='bank' ) style="background: #4B4BAC !important; 
                        color: #fff !important;" @else style="background: #fff !important; color: #4B4BAC !important;"
                            @endif class="nav-link" href="{{ url('admin/update_penyedia_details/bank') }}">Bank
                            Details</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item" @if (Session::get('page')=='sections' || Session::get('page')=='category' ||
            Session::get('page')=='products' ) style="background: #4B4BAC !important;
            color: #fff !important;" @endif>
            <a class="nav-link" data-toggle="collapse" href="#catalog-element" aria-expanded="false"
                aria-controls="#catalog-element">
                <i class="mdi mdi-application menu-icon"></i>
                <span class="menu-title">Manage Catalog</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="catalog-element">
                <ul class="nav flex-column sub-menu" style="background: #fff !important; color: #4B4BAC !important;">
                    <li class="nav-item">
                        <a @if (Session::get('page')=='products' ) style="background: #4B4BAC !important; 
                        color: #fff !important;" @else style="background: #fff !important; color: #4B4BAC !important;"
                            @endif class="nav-link" href="{{ url('admin/products') }}">Product</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a @if (Session::get('page')=='order' ) style="background: #4B4BAC !important;
            color: #fff !important;" @endif class="nav-link" data-toggle="collapse" href="#order" aria-expanded="false"
                aria-controls="#order">
                <i class="icon-columns menu-icon"></i>
                <span class="menu-title">Manage Orders</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="order">
                <ul class="nav flex-column sub-menu" style="background: #fff !important; color: #4B4BAC !important;">
                    <li class="nav-item">
                        <a @if (Session::get('page')=='penyewa' ) style="background: #4B4BAC !important; 
                        color: #fff !important;" @else style="background: #fff !important; color: #4B4BAC !important;"
                            @endif class="nav-link" href="{{ url('admin/orders') }}">Order</a>
                    </li>
                    <li class="nav-item">
                        <a @if (Session::get('page')=='rating' ) style="background: #4B4BAC !important; 
                        color: #fff !important;" @else style="background: #fff !important; color: #4B4BAC !important;"
                            @endif class="nav-link" href="{{ url('admin/ratings') }}">Ratings</a>
                    </li>
                </ul>
            </div>
        </li>
        @else
        <li @if (Session::get('page')=='update_admin_password' || Session::get('page')=='update_admin_details' ) style="background: #4B4BAC !important;
        color: #fff !important;" @endif class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Settings</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu" style="background: #fff !important; color: #4B4BAC !important;">
                    <li class="nav-item">
                        <a @if (Session::get('page')=='update_admin_password' ) style="background: #4B4BAC !important; 
                        color: #fff !important;" @else style="background: #fff !important; color: #4B4BAC !important;"
                            @endif class="nav-link" href="{{ url('admin/update_admin_password') }}">Update Password</a>
                    </li>
                    <li class="nav-item">
                        <a @if (Session::get('page')=='update_admin_details' ) style="background: #4B4BAC !important;
                        color: #fff !important;" @else style="background: #fff !important; color: #4B4BAC !important;"
                            @endif class="nav-link" href="{{ url('admin/update_admin_details') }}">Update Detail</a>
                    </li>
                </ul>
            </div>
        </li>
        @endif
    </ul>
</nav>