@extends('layout.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    /* 1. HILANGKAN ELEMEN TEMPLATE LAMA */
    .main-banner, .left-image, .right-image, .dots, .circle, canvas, 
    .main-banner:after, .main-banner:before, #top {
        display: none !important;
    }

    /* 2. WRAPPER UTAMA */
    .detail-page-wrapper {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: #f8fafc;
        min-height: 100vh;
        padding-top: 120px;
        padding-bottom: 80px;
    }

    /* 3. HERO SECTION (NAVY BSI STYLE) */
    .hero-detail {
        background: linear-gradient(135deg, #002d72 0%, #001a41 100%);
        padding: 60px 0;
        color: white;
        border-bottom: 5px solid #00a1e4;
        margin-bottom: -100px; /* Menarik konten bawah ke atas */
    }

    /* 4. CONTENT CARD */
    .main-card {
        background: white;
        border-radius: 24px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.05);
        border: 1px solid #eef2f6;
        overflow: hidden;
    }

    .poster-container {
        background: #fff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    .poster-container img {
        width: 100%;
        height: auto;
        display: block;
    }

    .badge-blue {
        background: #e0f2fe;
        color: #0369a1;
        padding: 6px 16px;
        border-radius: 100px;
        font-weight: 600;
        font-size: 0.85rem;
    }

    .info-label {
        color: #64748b;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 700;
        margin-bottom: 5px;
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
        box-shadow: 0 10px 20px rgba(0, 161, 228, 0.2);
    }

    .btn-apply:hover {
        background: #002d72;
        transform: translateY(-3px);
    }

    .content-section {
        border-bottom: 1px solid #f1f5f9;
        padding-bottom: 25px;
        margin-bottom: 25px;
    }

    .content-section:last-child {
        border-bottom: none;
    }
</style>

<div class="detail-page-wrapper">
    <header class="hero-detail">
        <div class="container text-center">
            <a href="{{ url('lowongan') }}" class="text-white-50 text-decoration-none mb-3 d-inline-block hover:text-white">
                <i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar
            </a>
            <h1 class="fw-800 display-6">{{ $job->judul }}</h1>
            <p class="fs-5 opacity-75">{{ $job->perusahaan }}</p>
        </div>
    </header>

    <div class="container" style="position: relative; z-index: 20;">
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="main-card p-4 p-md-5">
                    
                    <div class="d-flex flex-wrap gap-2 mb-4 d-lg-none">
                        <span class="badge-blue"><i class="fas fa-map-marker-alt me-1"></i> {{ $job->lokasi }}</span>
                        <span class="badge-blue"><i class="fas fa-calendar-alt me-1"></i> Batas: {{ $job->deadline ?? '-' }}</span>
                    </div>

                    <div class="content-section">
                        <h4 class="fw-800 mb-3 text-navy">Deskripsi Pekerjaan</h4>
                        <div class="text-secondary leading-relaxed">
                            {!! nl2br(e($job->deskripsi)) !!}
                        </div>
                    </div>

                    <div class="content-section">
                        <h4 class="fw-800 mb-3 text-navy">Persyaratan / Kualifikasi</h4>
                        <div class="text-secondary leading-relaxed">
                            {!! nl2br(e($job->syarat)) !!}
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-lg-4">
                <div class="sticky-top" style="top: 130px; z-index: 5;">
                    <div class="poster-container mb-4">
                        @if($job->poster_image)
                            <img src="{{ asset('storage/'.$job->poster_image) }}" alt="Poster Detail">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center p-5 text-muted">
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

                        <a href="{{ $job->link_lamar ?? '#' }}" target="_blank" class="btn-apply">
                            Lamar Sekarang <i class="fas fa-external-link-alt ms-2"></i>
                        </a>
                        
                        <div class="mt-4 text-center">
                            <small class="text-muted">Bagikan lowongan ini:</small>
                            <div class="mt-2 d-flex justify-content-center gap-3">
                                <a href="https://wa.me/?text={{ urlencode(url()->current()) }}" target="_blank" class="text-success"><i class="fab fa-whatsapp fa-lg"></i></a>
                                <a href="#" class="text-primary"><i class="fab fa-facebook fa-lg"></i></a>
                                <a href="#" class="text-info"><i class="fab fa-linkedin fa-lg"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection