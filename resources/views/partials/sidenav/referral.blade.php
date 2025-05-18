<!-- Heading -->
<div class="sidebar-heading">
    Referral
</div>

<li class="nav-item {{ (Route::is('unit-group.index')) ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('unit-group.index') }}">
        <i class="fas fa-fw fa-address-book"></i>
        <span>Customers</span>
    </a>
</li>

<li class="nav-item {{ (Route::is('customer.create')) ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('customer.create') }}">
        <i class="fas fa-fw fa-user-pen"></i>
        <span>Add Customers</span>
    </a>
</li>
