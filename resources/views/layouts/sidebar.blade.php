<ul class="navbar-nav bg-black sidebar sidebar-dark accordion " id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center">
        <div class="sidebar-brand-text mx-3">Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::routeIs('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fa fa-home"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Menu
    </div>
    <!-- Nav Item - Pages Collapse Menu -->
    <li
        class="nav-item {{ Request::routeIs('data_jabatan.index') || Request::routeIs('shifts.index') || Request::routeIs('divisi.index') || Request::routeIs('karyawan.index') ? 'active' : '' }}">
        <a class="nav-link {{ Request::routeIs('data_jabatan.index') || Request::routeIs('shifts.index') || Request::routeIs('divisi.index') || Request::routeIs('karyawan.index') ? '' : 'collapsed' }}"
            href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="{{ Request::routeIs('data_jabatan.index') || Request::routeIs('shifts.index') || Request::routeIs('divisi.index') || Request::routeIs('karyawan.index') ? 'false' : '' }}"
            aria-controls="collapseTwo">
            <i class="fa-solid fa-folder"></i>
            <span>Master Data</span>
        </a>
        <div id="collapseTwo"
            class="collapse {{ Request::routeIs('data_jabatan.index') || Request::routeIs('shifts.index') || Request::routeIs('divisi.index') || Request::routeIs('karyawan.index') ? 'show' : '' }}"
            aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ Request::routeIs('karyawan.index') ? 'active' : '' }} "
                    href="{{ route('karyawan.index') }}">Data Karyawan</a>
                <a class="collapse-item {{ Request::routeIs('data_jabatan.index') ? 'active' : '' }} "
                    href="{{ route('data_jabatan.index') }}">Data Jabatan</a>
                <a class="collapse-item {{ Request::routeIs('divisi.index') ? 'active' : '' }} "
                    href="{{ route('divisi.index') }}">Data Divisi</a>
                <a class="collapse-item {{ Request::routeIs('shifts.index') ? 'active' : '' }} "
                    href="{{ route('shifts.index') }}">Data Shift</a>
            </div>
        </div>
    </li>
    <!-- Nav Item - Charts -->
    <li
        class="nav-item {{ Request::routeIs('rekap_absensi.index') || Request::routeIs('pembagian_shift.index') || Request::routeIs('history_absensi.index') || Request::routeIs('data_kehadiran.index') ? 'active' : '' }}">
        <a class="nav-link {{ Request::routeIs('rekap_absensi.index') || Request::routeIs('pembagian_shift.index') || Request::routeIs('history_absensi.index') || Request::routeIs('data_kehadiran.index') ? '' : 'collapsed' }}"
            href="#" data-toggle="collapse" data-target="#collapseOne"
            aria-expanded="{{ Request::routeIs('rekap_absensi.index') || Request::routeIs('pembagian_shift.index') || Request::routeIs('history_absensi.index') || Request::routeIs('data_kehadiran.index') ? 'false' : '' }}"
            aria-controls="collapseTwo">
            <i class="fa-solid fa-calendar-days"></i>
            <span>Absensi</span>
        </a>
        <div id="collapseOne"
            class="collapse {{ Request::routeIs('rekap_absensi.index') || Request::routeIs('pembagian_shift.index') || Request::routeIs('history_absensi.index') || Request::routeIs('data_kehadiran.index') ? 'show' : '' }}"
            aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ Request::routeIs('pembagian_shift.index') ? 'active' : '' }} "
                    href="{{ route('pembagian_shift.index') }}">Pembagian shift</a>
                <a class="collapse-item {{ Request::routeIs('data_kehadiran.index') ? 'active' : '' }} "
                    href="{{ route('data_kehadiran.index') }}">data kehadiran</a>
                <a class="collapse-item {{ Request::routeIs('rekap_absensi.index') ? 'active' : '' }}"
                    href="{{ route('rekap_absensi.index') }}">Rekap Absensi</a>
            </div>
        </div>
    </li>
    <li class="nav-item {{ Request::routeIs('users.index') ? 'active' : '' }}">
        <a class="nav-link pt-3" href="{{ route('users.index') }}">
            <i class="fa-solid fa-user"></i>
            <span>Users</span></a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
