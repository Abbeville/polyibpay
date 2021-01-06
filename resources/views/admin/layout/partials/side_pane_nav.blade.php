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
    
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#user_manage"
        aria-expanded="true" aria-controls="user_manage">
        <i class="fa fa-users"></i>
        <span>Users Management</span>
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
        <i class="fa fa-list"></i>
        <span>Transactions</span>
        </a>
        <div id="wallet" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Transactions</h6>
                <a class="collapse-item" href="{{ route('admin.transaction.index') }}">All Transactions</a>
                <a class="collapse-item" href="{{ url('admin/transaction/index?type=success') }}">Successful Transactions</a>
                <a class="collapse-item" href="{{ url('admin/transaction/index?type=pending') }}">Pending Transactions</a>
                <a class="collapse-item" href="{{ url('admin/transaction/index?type=failed') }}">Failed Transactions</a>
                <a class="collapse-item" href="{{ url('admin/transaction/index?type=canceled') }}">Cancelled Transactions</a>
                <a class="collapse-item" href="{{ url('admin/transaction/index?type=crypto') }}">Crypto Transactions</a>
                <a class="collapse-item" href="{{ url('admin/transaction/index?type=top_up') }}">Top-Up Transactions</a>
                <a class="collapse-item" href="{{ url('admin/transaction/index?type=bill') }}">Bill Transactions</a>
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
                <a class="collapse-item" href="{{ route('admin.vcard.index') }}">All Virtual Cards</a>
                <a class="collapse-item" href="{{ url('admin/vcard/index?type=1') }}">Active Virtual Cards</a>
                <a class="collapse-item" href="{{ url('admin/vcard/index?type=0') }}">Inactive Virtual Cards</a>
                <a class="collapse-item" href="{{ url('admin/vcard/index?type=2') }}">Terminate Virtual Cards</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#settings"
        aria-expanded="true" aria-controls="settings">
        <i class="fa fa-cog"></i>
        <span>Settings</span>
        </a>
        <div id="settings" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Settings</h6>
                <a class="collapse-item" href="{{ route('admin.settings.crypto.index') }}">Crypto Settings</a>
            </div>
        </div>
    </li>
</ul>
<!-- Sidebar -->