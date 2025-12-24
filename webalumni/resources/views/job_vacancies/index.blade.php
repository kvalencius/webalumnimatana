@extends('layout.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    /* 1. FORCE KILL SEMUA ELEMEN BAWAAN TEMPLATE LAMA */
    /* Kita hilangkan paksa gambar HP, lingkaran biru, dan titik-titik */
    .main-banner, .left-image, .right-image, .dots, .circle, canvas, 
    .main-banner:after, .main-banner:before, #top {
        display: none !important;
        height: 0 !important;
        opacity: 0 !important;
        visibility: hidden !important;
    }

    /* 2. LAYOUT BARU (ISOLATED) */
    .lowongan-page-wrapper {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: #f8fafc;
        min-height: 100vh;
        padding-top: 120px; /* Jarak agar tidak tertutup Navbar */
        position: relative;
        z-index: 10;
    }

    /* 3. HEADER BIRU (Seperti Referensi BSI) */
    .header-bsi-style {
        background: linear-gradient(135deg, #002d72 0%, #001a41 100%);
        padding: 50px 0 80px 0;
        color: white;
        border-bottom: 5px solid #00a1e4;
    }

    /* 4. SEARCH BOX MELAYANG */
    .search-wrapper-floating {
        max-width: 700px;
        margin: -40px auto 0 auto;
        position: relative;
        z-index: 20;
    }

    .search-card {
        background: white;
        padding: 10px;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        display: flex;
        border: 1px solid #e2e8f0;
    }

    .search-card input {
        border: none !important;
        outline: none !important;
        box-shadow: none !important;
        padding: 10px 20px;
        width: 100%;
        font-size: 1rem;
    }

    .btn-cari-modern {
        background: #00a1e4;
        color: white;
        border: none;
        padding: 10px 30px;
        border-radius: 15px;
        font-weight: 700;
        transition: 0.3s;
    }

    .btn-cari-modern:hover {
        background: #002d72;
        transform: translateY(-2px);
    }

    /* 5. GRID LOWONGAN (PORTRAIT STYLE) */
    .grid-container {
        padding: 60px 0;
    }

    .card-lowongan {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid #eef2f6;
        transition: 0.4s;
        height: 100%;
        display: block;
        text-decoration: none !important;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
    }

    .card-lowongan:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1);
        border-color: #00a1e4;
    }

    .image-box {
        height: 320px; /* Tinggi portrait seperti BSI */
        background: #f1f5f9;
        overflow: hidden;
    }

    .image-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .info-box {
        padding: 20px;
        text-align: center;
    }

    .job-title {
        color: #1e293b;
        font-weight: 800;
        font-size: 1.1rem;
        margin-bottom: 5px;
        line-height: 1.3;
    }

    .company-name {
        color: #64748b;
        font-size: 0.9rem;
        margin-bottom: 15px;
    }

    .location-tag {
        font-size: 0.8rem;
        color: #94a3b8;
        font-style: italic;
    }

    /* 6. PAGINATION STYLING */
    .custom-pagination {
        display: flex;
        justify-content: center;
        margin-top: 50px;
    }

    .pagination .page-link {
        border-radius: 10px !important;
        margin: 0 5px;
        border: none;
        color: #002d72;
        font-weight: bold;
    }

    .pagination .page-item.active .page-link {
        background-color: #00a1e4 !important;
    }
</style>

<div class="lowongan-page-wrapper">
    <header class="header-bsi-style">
        <div class="container text-center">
            <h1 class="fw-800 text-white display-5">Lowongan Kerja</h1>
            <p class="text-white-50">Temukan karir impian Anda bersama mitra perusahaan kami</p>
        </div>
    </header>

    <div class="search-wrapper-floating">
        <div class="container">
            <form action="{{ url()->current() }}" method="GET">
                <div class="search-card">
                    <i class="fas fa-search d-flex align-items-center ps-3 text-muted"></i>
                    <input type="text" name="search" placeholder="Cari posisi atau perusahaan..." value="{{ request('search') }}">
                    <button type="submit" class="btn-cari-modern">Cari</button>
                </div>
            </form>
        </div>
    </div>

    <main class="grid-container">
        <div class="container">
            <div class="row g-4">
                @forelse($jobs as $job)
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <a href="{{ url('lowongan/'.$job->id) }}" class="card-lowongan">
                        <div class="image-box">
                            @if($job->poster) 
                                <img src="{{ asset('storage/'.$job->poster) }}" alt="Poster">
                            @else
                                <div class="d-flex h-100 align-items-center justify-content-center text-muted">
                                    <span>No Poster</span>
                                </div>
                            @endif
                        </div>
                        <div class="info-box">
                            <h3 class="job-title">{{ Str::limit($job->judul, 40) }}</h3>
                            <p class="company-name">{{ $job->perusahaan }}</p>
                            <p class="location-tag"><i class="fas fa-map-marker-alt me-1"></i> {{ $job->lokasi }}</p>
                        </div>
                    </a>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <h3 class="text-muted">Maaf, saat ini belum ada lowongan kerja tersedia.</h3>
                </div>
                @endforelse
            </div>

            <div class="custom-pagination">
                {{ $jobs->appends(request()->input())->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </main>
</div>
@endsection