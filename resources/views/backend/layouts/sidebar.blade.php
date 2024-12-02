<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="#" class="logo text-decoration-none">
                <h1 class="mb-0">
                    <span class="text-primary">Si</span><span class="text-light fw-bold">Absensi</span>
                </h1>
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
                @auth
                    <li class="nav-item {{ request()->routeIs('panel.dashboard.*') ? 'active show' : '' }}">
                        <a data-bs-toggle="collapse" href="#dashboard" class="{{ request()->routeIs('panel.dashboard.*') ? '' : 'collapsed' }}" aria-expanded="{{ request()->routeIs('panel.dashboard.*') ? 'true' : 'false' }}">
                            <i class="fas fa-home"></i>
                            <p>Dashboard</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse {{ request()->routeIs('panel.dashboard.*') ? 'show' : '' }}" id="dashboard">
                            <ul class="nav nav-collapse">
                                <li class="nav-item {{ request()->routeIs('panel.dashboard.*') ? 'active' : '' }}">
                                    <a href="{{ route('panel.dashboard.index') }}">
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

                    @if (auth()->user()->role == 'admin')
                        <li
                            class="nav-item {{ request()->routeIs('siswa.*') || request()->routeIs('kelas.*') || request()->routeIs('panel.guru.*') ? 'show' : '' }}">
                            <a data-bs-toggle="collapse" href="#base"
                                class="{{ request()->routeIs('siswa.*') || request()->routeIs('kelas.*') || request()->routeIs('panel.guru.*') ? '' : 'collapsed' }}">
                                <i class="fas fa-layer-group"></i>
                                <p>Data Umum</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse {{ request()->routeIs('siswa.*') || request()->routeIs('kelas.*') || request()->routeIs('panel.guru.*') ? 'show' : '' }}"
                                id="base">
                                <ul class="nav nav-collapse">
                                    <li class="nav-item {{ request()->routeIs('kelas.*') ? 'active' : '' }}">
                                        <a href="/kelas">
                                            <span class="sub-item">Daftar Kelas</span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{ request()->routeIs('panel.guru.*') ? 'active' : '' }}">
                                        <a href="{{ route('panel.guru.index') }}">
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
                    @endif

                    <li
                        class="nav-item {{ request()->routeIs('absensi.*') || request()->routeIs('nilai.*') ? 'show' : '' }}">
                        <a data-bs-toggle="collapse" href="#tables"
                            class="{{ request()->routeIs('absensi.*') || request()->routeIs('nilai.*') ? '' : 'collapsed' }}">
                            <i class="fas fa-check-circle"></i>
                            <p>Absensi Siswa</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse {{ request()->routeIs('absensi.*') ? 'show' : '' }}" id="tables">
                            <ul class="nav nav-collapse">
                                <li class="nav-item {{ request()->routeIs('absensi.*') ? 'active' : '' }}">
                                    <a href="/absensi">
                                        <span class="sub-item">Data Absensi</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i>
                            <p>Logout</p>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</div>
