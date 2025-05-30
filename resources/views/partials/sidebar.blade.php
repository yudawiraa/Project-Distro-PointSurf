<!-- Sidebar -->
<div class="sidebar bg-dark text-white" style="min-height: 100vh; width: 250px; position: fixed; left: 0; top: 0;">
    <div class="sidebar-header p-3 border-bottom">
        <a href="{{ route('home') }}" class="text-decoration-none">
            <div class="d-flex align-items-center">
                <i class="fas fa-tshirt text-white me-2" style="font-size: 24px;"></i>
                <h4 class="text-white mb-0">POINTSURF</h4>
            </div>
        </a>
    </div>
    
    <div class="sidebar-content p-3">
        <div class="user-info mb-4 text-center border-bottom pb-3">
            @auth
                <div class="avatar mb-3">
                    <i class="fas fa-user-circle" style="font-size: 48px;"></i>
                </div>
                <h6 class="mb-1">{{ Auth::user()->nama_pengguna }}</h6>
                <small class="text-muted">{{ ucfirst(Auth::user()->role) }}</small>
            @endauth
        </div>

        <ul class="nav flex-column">
            <li class="nav-item mb-2">
                <a class="nav-link text-white {{ Route::currentRouteName() == 'home' ? 'active bg-primary' : '' }}" 
                   href="{{ route('home') }}">
                    <i class="fas fa-home me-2"></i>
                    Dashboard
                </a>
            </li>

            <li class="nav-item mb-2">
                <a class="nav-link text-white {{ str_contains(Route::currentRouteName(), 'produk.') ? 'active bg-primary' : '' }}" 
                   href="{{ route('produk.index') }}">
                    <i class="fas fa-box me-2"></i>
                    Produk
                    @if(isset($totalProduk))
                        <span class="badge bg-light text-dark float-end">{{ $totalProduk }}</span>
                    @endif
                </a>
            </li>

            <li class="nav-item mb-2">
                <a class="nav-link text-white {{ str_contains(Route::currentRouteName(), 'pelanggan.') ? 'active bg-primary' : '' }}" 
                   href="{{ route('pelanggan.index') }}">
                    <i class="fas fa-users me-2"></i>
                    Pelanggan
                    @if(isset($totalPelanggan))
                        <span class="badge bg-light text-dark float-end">{{ $totalPelanggan }}</span>
                    @endif
                </a>
            </li>

            <li class="nav-item mb-2">
                <a class="nav-link text-white {{ str_contains(Route::currentRouteName(), 'pengguna.') ? 'active bg-primary' : '' }}" 
                   href="{{ route('pengguna.index') }}">
                    <i class="fas fa-user me-2"></i>
                    Pengguna
                    @if(isset($totalPengguna))
                        <span class="badge bg-light text-dark float-end">{{ $totalPengguna }}</span>
                    @endif
                </a>
            </li>

            <li class="nav-item mb-2">
                <a class="nav-link text-white {{ str_contains(Route::currentRouteName(), 'transaksi.') ? 'active bg-primary' : '' }}" 
                   href="{{ route('transaksi.index') }}">
                    <i class="fas fa-shopping-cart me-2"></i>
                    Transaksi
                    @if(isset($totalTransaksi))
                        <span class="badge bg-light text-dark float-end">{{ $totalTransaksi }}</span>
                    @endif
                </a>
            </li>
        </ul>

        @auth
            <div class="mt-4 pt-3 border-top">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-light w-100">
                        <i class="fas fa-sign-out-alt me-2"></i>
                        Logout
                    </button>
                </form>
            </div>
        @endauth
    </div>
</div>

<!-- Add mobile toggle button -->
<button class="btn btn-dark d-md-none position-fixed" 
        style="bottom: 20px; right: 20px; z-index: 1040; width: 45px; height: 45px; border-radius: 50%;"
        onclick="document.querySelector('.sidebar').classList.toggle('active')">
    <i class="fas fa-bars"></i>
</button>
