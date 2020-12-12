<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('assets/img/logo-login.png') }}" alt="logo">
        </div>
        <div class="sidebar-brand-text mx-3">{{ config('app.name', $default = 'BillsPay') }}</div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Features
    </div>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#user_manage"
        aria-expanded="true" aria-controls="user_manage">
        <i class="fa fa-user"></i>
        <span>User Management</span>
        </a>
        <div id="user_manage" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">User Management</h6>
                <a class="collapse-item" href="{{ route('admin.user.index') }}">All Users</a>
                <a class="collapse-item" href="{{ url('admin/users/list?type=active') }}">Active Users</a>
                <a class="collapse-item" href="{{ url('admin/users/list?type=inactive') }}">Inactive Users</a>
                <a class="collapse-item" href="{{ url('admin/users/list?type=suspended') }}">Suspended Users</a>
                <a class="collapse-item" href="{{ route('admin.user.create') }}">Create New User</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#wallet"
        aria-expanded="true" aria-controls="wallet">
        <i class="fa fa-briefcase"></i>
        <span>Wallet Transactions</span>
        </a>
        <div id="wallet" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Wallet Transactions</h6>
                <a class="collapse-item" href="{{ route('admin.transaction.index') }}">All Wallets</a>
                <a class="collapse-item" href="buttons.html">Active Wallets</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#virtual_cards"
        aria-expanded="true" aria-controls="virtual_cards">
        <i class="fa fa-credit-card"></i>
        <span>Virtual Cards</span>
        </a>
        <div id="virtual_cards" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Virtual Cards</h6>
                <a class="collapse-item" href="alerts.html">All Virtual Cards</a>
                <a class="collapse-item" href="buttons.html">Active Virtual Cards</a>
            </div>
        </div>
    </li>
</ul>
<!-- Sidebar -->