<!-- Heading -->
<div class="sidebar-heading">
    SuperAdmin
</div>

<li class="nav-item {{ Route::is('marketing') ? 'active' : '' }} ">
    <a class="nav-link" href="{{ route('marketing') }}">
        <i class="fas fa-fw fa-pie-chart"></i>
        <span>Marketing</span>

    </a>
</li>

<li class="nav-item {{ (Route::is('customer')) ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('customer') }}">
        <i class="fas fa-fw fa-address-book"></i>
        <span>Customers</span>
    </a>
</li>

<li class="nav-item {{ (Route::is('unit-group.index')) ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('unit-group.index') }}">
        <i class="fas fa-fw fa-book"></i>
        <span>Units</span>
    </a>
</li>
