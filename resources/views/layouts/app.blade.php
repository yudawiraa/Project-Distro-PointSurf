<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'DISTRO POINTSURF')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->    <style>
        .navbar-brand {
            font-weight: bold;
        }
        .action-buttons {
            white-space: nowrap;
        }
        .sidebar {
            transition: all 0.3s ease;
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            z-index: 1030;
        }
        .sidebar-header {
            background-color: rgba(0, 0, 0, 0.2);
        }
        .sidebar-header a:hover {
            opacity: 0.8;
        }
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .content-wrapper {
                margin-left: 0 !important;
            }
            .sidebar.active {
                transform: translateX(0);
            }
        }
        .nav-link {
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
        }
        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 4px;
        }
        body.has-navbar .content-wrapper {
            margin-top: 56px;
        }
    </style>
</head>
<body class="{{ !in_array(Route::currentRouteName(), ['produk.index', 'produk.create', 'produk.edit', 'produk.show', 'pelanggan.index', 'pelanggan.create', 'pelanggan.edit', 'pelanggan.show', 'pengguna.index', 'pengguna.create', 'pengguna.edit', 'pengguna.show', 'transaksi.index', 'transaksi.create', 'transaksi.edit', 'transaksi.show']) ? 'has-navbar' : '' }}">
    @if(!in_array(Route::currentRouteName(), ['produk.index', 'produk.create', 'produk.edit', 'produk.show', 'pelanggan.index', 'pelanggan.create', 'pelanggan.edit', 'pelanggan.show', 'pengguna.index', 'pengguna.create', 'pengguna.edit', 'pengguna.show', 'transaksi.index', 'transaksi.create', 'transaksi.edit', 'transaksi.show']))
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-tshirt me-2"></i>
                POINTSURF
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
    @endif

    @include('partials.sidebar')    <div class="content-wrapper" style="margin-left: 250px; padding: 20px;">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('status'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>