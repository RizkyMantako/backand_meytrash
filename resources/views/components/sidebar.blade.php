<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">MeyTrash</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">
                <img src="{{ asset('img/logo-MT.png') }}"
                    alt="image"
                    width="35"
                    data-toggle="logo"></a>

        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Admin </li>
            <li class="{{ Request::is('blank-page') ? 'active' : '' }}">
                <a class="nav-link"
                    href="{{ url('users') }}"><i class="fas fa-user"></i> <span>User</span></a>
            </li>
            <hr>
            <li class="{{ Request::is('blank-page') ? 'active' : '' }}">
                <a class="nav-link"
                    href="{{ url('edukasi') }}"><i class="fas fa-book-open-reader"></i> <span>Edukasi</span></a>
            </li>
            <hr>
             <li class="{{ Request::is('blank-page') ? 'active' : '' }}">
                <a class="nav-link"
                    href="{{ url('sampah') }}"><i class="fas fa-trash-can"></i> <span>Sampah</span></a>
            </li>
            <li class="{{ Request::is('blank-page') ? 'active' : '' }}">
                <a class="nav-link"
                    href="{{ url('donasi') }}"><i class="fas fa-donate"></i> <span>Donasi</span></a>
            </li>
            <hr>
            <li class="nav-item dropdown">
                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Proses</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('dashboard-general-dashboard') ? 'active' : '' }}'>
                        <a class="nav-link"
                            href="{{ url('proses_sampah') }}">Proses Sampah</a>
                    </li>
                </ul>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('dashboard-general-dashboard') ? 'active' : '' }}'>
                        <a class="nav-link"
                            href="{{ url('proses_donasi') }}">Proses Donasi</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-history"></i><span>Riwayat</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('dashboard-general-dashboard') ? 'active' : '' }}'>
                        <a class="nav-link"
                            href="{{ url('riwayat_sampah') }}">Riwayat Sampah</a>
                    </li>
                </ul>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('dashboard-general-dashboard') ? 'active' : '' }}'>
                        <a class="nav-link"
                            href="{{ url('riwayat_donasi') }}">Riwayat Donasi</a>
                    </li>
                </ul>
            </li>
    </aside>
</div>
