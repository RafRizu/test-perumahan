<!-- Heading -->
<div class="sidebar-heading">
    Admin
</div>

<li class="nav-item {{ (Route::is('referral')) ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('referral') }}">
        <i class="fas fa-fw fa-address-book"></i>
        <span>Referrals</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="#">
        <i class="fas fa-fw fa-pie-chart"></i>
        <span>Marketing</span>

    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="#">
        <i class="fas fa-fw fa-user-pen"></i>
        <span>Customers</span>
    </a>
</li>
