<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/custom-style.css') }}">
    <style>
        body { font-family: 'Arial', sans-serif; background-color: #f5f7fb; }
        .navbar-brand { font-weight: bold; }
        .navbar { box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); }
        .hero-section { color: white; padding: 40px 0; text-align: center; }
        .produk-card { border: 0; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.08); height: 100%; }
        .produk-card .harga { color: #1e5bb8; font-weight: bold; font-size: 1.1rem; }
        .footer { margin-top: 50px; padding: 20px 0; background-color: #e9ecef; text-align: center; }
        .footer p { margin: 0; font-size: 0.9rem; color: #6c757d; }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" height="36" class="me-2">
                My Laravel App
            </a>
            <ul class="navbar-nav ms-auto flex-row gap-3">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link active" href="{{ route('katalog') }}">Katalog</a></li>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1 class="display-6 mb-1 font-custom">Katalog Produk</h1>
            <p class="lead mb-0">Data produk dan kategori yang dikelola dari halaman Admin.</p>
        </div>
    </section>

    <!-- Content Section -->
    <section class="container mt-4">
        <form method="GET" action="{{ route('katalog') }}" class="row g-2 mb-4">
            <div class="col-md-4">
                <select name="kategori" class="form-select" onchange="this.form.submit()">
                    <option value="">Semua Kategori</option>
                    @foreach ($dataKategori as $kategori)
                        <option value="{{ $kategori->slug }}" {{ request('kategori') == $kategori->slug ? 'selected' : '' }}>
                            {{ $kategori->nama }} ({{ $kategori->produk_count }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" value="{{ request('search') }}" placeholder="Cari nama atau deskripsi produk">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
            </div>
        </form>

        <div class="row g-4">
            @forelse ($dataProduk as $produk)
                <div class="col-md-4">
                    <div class="card produk-card">
                        <div class="card-body">
                            <span class="badge text-bg-primary mb-2">{{ $produk->kategori->nama }}</span>
                            <h5 class="card-title">{{ $produk->nama }}</h5>
                            <p class="card-text text-muted small">{{ $produk->deskripsi }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="harga">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
                                <span class="small text-muted">Stok: {{ $produk->stok }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-warning">Produk tidak ditemukan.</div>
                </div>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $dataProduk->links('pagination::bootstrap-5') }}
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; {{ date('Y') }} My Laravel App. All Rights Reserved.</p>
        </div>
    </footer>
</body>

</html>
