<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">
            <i class="fas fa-tshirt me-2"></i>
            POINTSURF
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="fas fa-home me-1"></i>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('produk.index') }}">
                        <i class="fas fa-box me-1"></i>
                        Produk
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pelanggan.index') }}">
                        <i class="fas fa-users me-1"></i>
                        Pelanggan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pengguna.index') }}">
                        <i class="fas fa-user me-1"></i>
                        Pengguna
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('transaksi.index') }}">
                        <i class="fas fa-shopping-cart me-1"></i>
                        Transaksi
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav">
                @auth
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user-circle me-1"></i>
                        {{ Auth::user()->nama_pengguna }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
<hr>