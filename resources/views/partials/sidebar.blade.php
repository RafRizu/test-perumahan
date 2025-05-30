<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled-md" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center bg-primary" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon">
            <i class="fas fa-home"></i>
        </div>
        <div class="sidebar-brand-text mx-2">BUMI DAHAYU SEJAHTERA</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ (Route::is('dashboard') ? 'active' : '') }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    @includeWhen($user->role == "admin", 'partials.sidenav.admin')
    @includeWhen($user->role == "marketing", 'partials.sidenav.marketing')
    @includeWhen($user->role == "superadmin", 'partials.sidenav.superadmin')

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->
    <div class="sidebar-card d-none d-lg-flex">
        <p class="text-center mb-2"><strong>Demo Site</strong> this is demo site, on devlopment</p>
        <a class="btn btn-success btn-sm">Revisi</a>
    </div>

</ul>
<!-- End of Sidebar -->
