<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo">
                <img src="{{ asset('/assets/backend/img/kaiadmin/logo_light.svg') }}" alt="navbar brand" class="navbar-brand" height="20"/>
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item active">
                    <a data-bs-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="dashboard">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="/home">
                                    <span class="sub-item">Dashboard</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Menu Pengguna</h4>
                </li>
                <li class="nav-item {{ request()->routeIs('siswa.*') || request()->routeIs('kelas.*') || request()->routeIs('guru.*') ? 'show' : '' }}">
                    <a data-bs-toggle="collapse" href="#base"
                       class="{{ request()->routeIs('siswa.*') || request()->routeIs('kelas.*') || request()->routeIs('guru.*') ? '' : 'collapsed' }}">
                        <i class="fas fa-layer-group"></i>
                        <p>Data Umum</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('siswa.*') || request()->routeIs('kelas.*') || request()->routeIs('guru.*') ? 'show' : '' }}" id="base">
                        <ul class="nav nav-collapse">
                            <li class="nav-item {{ request()->routeIs('kelas.*') ? 'active' : '' }}">
                                <a href="/kelas">
                                    <span class="sub-item">Daftar Kelas</span>
                                </a>
                            </li>
                            <li class="nav-item {{ request()->routeIs('guru.*') ? 'active' : '' }}">
                                <a href="/guru">
                                    <span class="sub-item">Daftar Guru</span>
                                </a>
                            </li>
                            <li class="nav-item {{ request()->routeIs('siswa.*') ? 'active' : '' }}">
                                <a href="/siswa">
                                    <span class="sub-item">Daftar Siswa</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#tables">
                        <i class="fas fa-check-circle"></i>
                        <p>Absensi Siswa</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="tables">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="/absensi">
                                    <span class="sub-item">Data Absensi</span>
                                </a>
                            </li><li>
                                <a href="/rekap">
                                    <span class="sub-item">Rekap Absensi</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="/profile_guru">
                        <i class="fas fa-user"></i>
                        <p>Profile Guru</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>

