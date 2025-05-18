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

<li class="nav-item {{ Route::is('marketing') ? 'active' : '' }} ">
    <a class="nav-link" href="{{ route('marketing') }}">
        <i class="fas fa-fw fa-pie-chart"></i>
        <span>Marketing</span>

    </a>
</li>

<li class="nav-item {{ (Route::is('unit-group.index')) ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('unit-group.index') }}">
        <i class="fas fa-fw fa-address-book"></i>
        <span>Customers</span>
    </a>
</li>
