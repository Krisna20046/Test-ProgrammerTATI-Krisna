<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Tati<sup>App</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="/dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <?php if (in_array(auth()->user()->role ? auth()->user()->role->role_name : 'User', ['Developer', 'Kepala Dinas'])): ?>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Data Master
    </div>
    <li class="nav-item {{ request()->is('role') ? 'active' : '' }}">
        <a class="nav-link" href="/role">
            <i class="fas fa-fw fa-user-lock"></i>
            <span>Role</span>
        </a>
    </li>
    <li class="nav-item {{ request()->is('user') ? 'active' : '' }}">
        <a class="nav-link" href="/user">
            <i class="fas fa-fw fa-user-tag"></i>
            <span>User</span>
        </a>
    </li>
    <?php endif; ?>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Soal 1
    </div>

    <li class="nav-item {{ request()->is('log-harian') ? 'active' : '' }}">
        <a class="nav-link" href="/log-harian">
            <i class="fas fa-fw fa-file-medical"></i>
            <span>Log Harian</span>
        </a>
    </li>

    <?php if (!in_array(auth()->user()->role ? auth()->user()->role->role_name : 'User', ['Staff'])): ?>
    <li class="nav-item {{ request()->is('verifikasi') ? 'active' : '' }}">
        <a class="nav-link" href="/verifikasi">
            <i class="fas fa-fw fa-check-circle"></i>
            <span>Verifikasi Log Harian</span>
        </a>
    </li>
    <?php endif; ?>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Soal 2
    </div>

    <li class="nav-item {{ request()->is('provinsi') ? 'active' : '' }}">
        <a class="nav-link" href="/provinsi">
            <i class="fas fa-fw fa-file-medical"></i>
            <span>Provinsi Rest Api</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Soal 3
    </div>

    <li class="nav-item {{ request()->is('predikat') ? 'active' : '' }}">
        <a class="nav-link" href="/predikat">
            <i class="fas fa-fw fa-file-medical"></i>
            <span>Predikat Kinerja</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Soal 4
    </div>

    <li class="nav-item {{ request()->is('deret-bilangan') ? 'active' : '' }}">
        <a class="nav-link" href="/deret-bilangan">
            <i class="fas fa-fw fa-file-medical"></i>
            <span>Deret Bilangan</span>
        </a>
    </li>
</ul>
<!-- End of Sidebar -->
