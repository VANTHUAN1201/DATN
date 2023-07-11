<nav class="topnav navbar navbar-light">
    <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
        <i class="fe fe-menu navbar-toggler-icon"></i>
    </button>
    <form class="form-inline mr-auto searchform text-muted">
        <input class="form-control mr-sm-2 bg-transparent border-0 pl-4 text-muted" type="search" placeholder="Tìm kiếm" aria-label="Search">
    </form>
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link text-muted my-2" href="#" id="modeSwitcher" data-mode="light">
                <i class="fe fe-sun fe-16"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-muted my-2" href="#" data-toggle="modal" data-target=".modal-shortcut">
                <span class="fe fe-grid fe-16"></span>
            </a>
        </li>
        <li class="nav-item nav-notif">
            <a class="nav-link text-muted my-2" href="#" data-toggle="modal" data-target=".modal-notif">
                <span class="fe fe-bell fe-16"></span>
                <span class="dot dot-md bg-success"></span>
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-muted pr-0" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="avatar avatar-sm mt-2">
                <img src="{{\Illuminate\Support\Facades\Auth::user()->images}}" alt="..." class="avatar-img rounded-circle">
              </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="{{\Illuminate\Support\Facades\URL::to('admin/admin-profile')}}"><span class="fe fe-user"></span>Tài khoản</a>
                <a class="dropdown-item" href="{{\Illuminate\Support\Facades\URL::to('logout')}}"><span class="fe fe-log-out"></span>Đăng xuất</a>
            </div>
        </li>
    </ul>
</nav>
<aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
    <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
        <i class="fe fe-x"><span class="sr-only"></span></i>
    </a>
    <nav class="vertnav navbar navbar-light">
        <!-- nav bar -->
        <div class="w-100 mb-4 d-flex">
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="{{\Illuminate\Support\Facades\URL::to('admin/administrator')}}">
                <img src="/client/images/logo.png" class="img-fluid" alt="logo">
            </a>
        </div>
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item">
                <a class="nav-link pl-3" href="{{\Illuminate\Support\Facades\URL::to('admin/category')}}">
                    <i class="fe fe-list fe-16"></i><span class="ml-1 item-text">Danh mục</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link pl-3" href="{{\Illuminate\Support\Facades\URL::to('admin/brand')}}">
                    <i class="fe fe-git-branch fe-16"></i><span class="ml-1 item-text">Thương hiệu sản phẩm</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link pl-3" href="{{\Illuminate\Support\Facades\URL::to('admin/shoe')}}">
                    <i class="fe fe-shopping-bag fe-16"></i>
                    <span class="ml-1 item-text">Giày</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link pl-3" href="{{\Illuminate\Support\Facades\URL::to('admin/user')}}">
                    <i class="fe fe-user fe-16"></i>
                    <span class="ml-1 item-text">Tài khoản người dùng</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link pl-3" href="{{\Illuminate\Support\Facades\URL::to('admin/oder')}}">
                    <i class="fe fe-credit-card fe-16"></i>
                    <span class="ml-1 item-text">Đơn hàng</span></a>
            </li>
           
        </ul>
    </nav>
</aside>
