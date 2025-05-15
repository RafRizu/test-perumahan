<nav class="navbar navbar-expand-lg navbar-custom shadow px-4">
    <!-- Logo -->
    <a class="navbar-brand" href="{{ route('dashboard') }}">
        <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" style="width: 50%; height: 50%">
    </a>

    <div class="collapse navbar-collapse justify-content-center">
        <ul class="navbar-nav">
            <li class="nav-item mx-2"><a class="nav-link" href="{{route('dashboard')}}">Dashboard</a></li>
            <li class="nav-item mx-2"><a class="nav-link" href="{{route('unit-group.index')}}">Data Customers</a></li>
            <li class="nav-item mx-2"><a class="nav-link" href="{{route('marketing.create')}}">Add Marketing Team</a></li>
            <li class="nav-item mx-2"><a class="nav-link" href="{{route('referral.create')}}">Add Referrals</a></li>
            <li class="nav-item mx-2"><a class="nav-link" href="{{route('customer.create')}}">Add Customers</a></li>
        </ul>
    </div>

    <div class="d-flex align-items-center">
        <div class="navbar-divider d-none d-md-block"></div>

        <li class="nav-item dropdown no-arrow list-unstyled mb-0">
            <a class="nav-link dropdown-toggle d-flex align-items-center" href="/logout" id="userDropdown" role="button"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 user-text d-none d-lg-inline">{{ Auth::user()->username ?? 'User' }}</span>
                <i class="fas fa-user-circle fa-2x text-dark"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow" aria-labelledby="userDropdown">
                <a class="dropdown-item text-muted" href="/logout" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i>
                    Logout
                </a>
            </div>
        </li>
    </div>
</nav>
