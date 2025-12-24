@extends('layout.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    /* 1. HILANGKAN ELEMEN TEMPLATE LAMA (Sama dengan Index Anda) */
    .main-banner, .left-image, .right-image, .dots, .circle, canvas, 
    .main-banner:after, .main-banner:before, #top {
        display: none !important;
    }

    /* 2. WRAPPER UTAMA (Sesuai dengan gaya Index) */
    .lowongan-page-wrapper {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: #f8fafc;
        min-height: 100vh;
        padding-top: 100px; /* Ruang untuk Navbar */
        padding-bottom: 80px;
    }

    /* 3. HEADER BIRU (Sama dengan Index Anda) */
    .header-bsi-style {
        background: linear-gradient(135deg, #002d72 0%, #001a41 100%);
        padding: 50px 0 100px 0;
        color: white;
        border-bottom: 5px solid #00a1e4;
    }

    /* 4. CONTENT CARD */
    .detail-container {
        margin-top: -60px; /* Membuat konten sedikit menimpa header biru */
        position: relative;
        z-index: 20;
    }

    .main-card {
        background: white;
        border-radius: 24px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.05);
        border: 1px solid #eef2f6;
    }

    .poster-container img {
        width: 100%;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    .btn-apply {
        background: #00a1e4;
        color: white !important;
        padding: 15px 30px;
        border-radius: 14px;
        font-weight: 800;
        text-align: center;
        display: block;
        transition: 0.3s;
        text-decoration: none;
    }

    .btn-apply:hover {
        background: #002d72;
        transform: translateY(-3px);
    }

    .info-label {
        color: #64748b;
        font-size: 0.85rem;
        text-transform: uppercase;
        font-weight: 700;
        margin-bottom: 5px;
    }
</style>

<div class="lowongan-page-wrapper">
    <header class="header-bsi-style">
        <div class="container text-center mx-auto px-4">
            <a href="{{ url('lowongan') }}" class="text-white/70 no-underline mb-3 d-inline-block hover:text-white">
                <i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar
            </a>
            <h1 class="fw-800 text-white display-6">{{ $job->tipe_pekerjaan }}</h1>
            <p class="text-white-50 fs-5">{{ $job->perusahaan }}</p>
        </div>
    </header>

    <div class="container mx-auto px-4 detail-container">
        <div class="row g-4 flex flex-wrap">
            <div class="col-lg-8 w-full lg:w-2/3 px-2">
                <div class="main-card p-4 p-md-5">
                    <div class="mb-5 pb-4 border-b border-gray-100">
                        <h4 class="fw-800 mb-3 text-primary">Deskripsi Pekerjaan</h4>
                        <div class="text-secondary leading-relaxed">
                            {!! nl2br(e($job->deskripsi)) !!}
                        </div>
                    </div>

                    <div>
                        <h4 class="fw-800 mb-3 text-primary">Persyaratan / Kualifikasi</h4>
                        <div class="text-secondary leading-relaxed">
                            {!! nl2br(e($job->persyaratan)) !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 w-full lg:w-1/3 px-2">
                <div class="sticky top-24">
                    <div class="poster-container mb-4">
                        @if($job->poster)
                            <img src="{{ asset('storage/'.$job->poster) }}" alt="Poster Detail">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center p-5 text-muted rounded-xl border">
                                <i class="fas fa-image fa-3x"></i>
                            </div>
                        @endif
                    </div>

                    <div class="main-card p-4">
                        <div class="mb-4">
                            <p class="info-label">Lokasi Penempatan</p>
                            <p class="fw-bold text-dark"><i class="fas fa-map-pin text-primary me-2"></i> {{ $job->lokasi }}</p>
                        </div>
                        
                        <div class="mb-4">
                            <p class="info-label">Batas Lamaran</p>
                            <p class="fw-bold text-danger"><i class="fas fa-clock me-2"></i> {{ $job->deadline ?? 'Hingga Terpenuhi' }}</p>
                        </div>

                        <a href="#" class="btn-apply">
                            Lamar Sekarang <i class="fas fa-external-link-alt ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection