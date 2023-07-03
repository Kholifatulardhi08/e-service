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
                        <a @if (Session::get('page')=='brands' ) style="background: #4B4BAC !important; 
                        color: #fff !important;" @else style="background: #fff !important; color: #4B4BAC !important;"
                            @endif class="nav-link" href="{{ url('admin/brands') }}">Brand</a>
                    </li>
                    <li class="nav-item">
                        <a @if (Session::get('page')=='categories' ) style="background: #4B4BAC !important; 
                        color: #fff !important;" @else style="background: #fff !important; color: #4B4BAC !important;"
                            @endif class="nav-link" href="{{ url('admin/category') }}">Category</a>
                    </li>
                    <li class="nav-item">
                        <a @if (Session::get('page')=='products' ) style="background: #4B4BAC !important; 
                        color: #fff !important;" @else style="background: #fff !important; color: #4B4BAC !important;"
                            @endif class="nav-link" href="{{ url('admin/products') }}">Product</a>
                    </li>
                    <li class="nav-item">
                        <a @if (Session::get('page')=='sections' ) style="background: #4B4BAC !important; 
                        color: #fff !important;" @else style="background: #fff !important; color: #4B4BAC !important;"
                            @endif class="nav-link" href="{{ url('admin/section') }}">Sections</a>
                    </li>
                </ul>
            </div>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
                <i class="icon-bar-graph menu-icon"></i>
                <span class="menu-title">Charts</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="charts">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="pages/charts/chartjs.html">ChartJs</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
                <i class="icon-contract menu-icon"></i>
                <span class="menu-title">Icons</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="icons">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="pages/icons/mdi.html">Mdi icons</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <i class="icon-head menu-icon"></i>
                <span class="menu-title">User Pages</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="pages/samples/login.html">
                            Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pages/samples/register.html">
                            Register
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#error" aria-expanded="false" aria-controls="error">
                <i class="icon-ban menu-icon"></i>
                <span class="menu-title">Error pages</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="error">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="pages/samples/error-404.html">
                            404
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pages/samples/error-500.html">
                            500
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="pages/documentation/documentation.html">
                <i class="icon-paper menu-icon"></i>
                <span class="menu-title">Documentation</span>
            </a>
        </li> --}}
    </ul>
</nav>