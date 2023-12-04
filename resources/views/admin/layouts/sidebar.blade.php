<div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Anggur Kita</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item {{ request()->is('role/admin/dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('role.admin.dashboard') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <!-- User -->
        <li class="nav-item {{ request()->is('role/admin/user*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('role.admin.user') }}">
                <i class="fas fa-fw fa-user"></i>
                <span>User</span>
            </a>
        </li>

        <!-- Product -->
        <li class="nav-item {{ request()->is('role/admin/product*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('role.admin.product') }}">
                <i class="fas fa-fw fa-shopping-cart"></i>
                <span>Product</span>
            </a>
        </li>

        <!-- Transaction -->
        <li class="nav-item {{ request()->is('role/admin/transaction*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('role.admin.transactions') }}">
                <i class="fas fa-fw fa-dollar-sign"></i>
                <span>Transaction</span>
            </a>
        </li>

        <!-- Perusahaan -->
        <li class="nav-item {{ request()->is('role/admin/perusahaan*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('role.admin.perusahaan') }}">
                <i class="fas fa-fw fa-building"></i>
                <span>Perusahaan</span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    </ul>
    <!-- End of Sidebar -->
</div>
