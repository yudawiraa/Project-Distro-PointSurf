<!-- Sidebar -->
<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="{{ route('home') }}" class="logo d-flex align-items-center">
                <h2 class="text-white mb-0 me-2">POINTSURF</h2>
                <i class="fas fa-tshirt text-white" style="font-size: 24px;"></i>
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
    </div>

    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
                    <a href="{{ route('home') }}">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#base">
                        <i class="fas fa-layer-group"></i>
                        <p>Entitas</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->is('produk*', 'pelanggan*', 'pengguna*', 'transaksi*') ? 'show' : '' }}" id="base">
                        <ul class="nav nav-collapse">
                            <li class="{{ request()->routeIs('produk.*') ? 'active' : '' }}">
                                <a href="{{ route('produk.index') }}">
                                    <span class="sub-item">Produk</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('pelanggan.*') ? 'active' : '' }}">
                                <a href="{{ route('pelanggan.index') }}">
                                    <span class="sub-item">Pelanggan</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('pengguna.*') ? 'active' : '' }}">
                                <a href="{{ route('pengguna.index') }}">
                                    <span class="sub-item">Pengguna</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('transaksi.*') ? 'active' : '' }}">
                                <a href="{{ route('transaksi.index') }}">
                                    <span class="sub-item">Transaksi</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->
