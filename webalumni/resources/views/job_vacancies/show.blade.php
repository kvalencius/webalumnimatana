@extends('layout.layout')

@section('title', 'Detail Lowongan - ' . $job->judul)

@section('isiWebsite')
<style>
    /* Content Spacer untuk Navbar Fixed */
    .job-detail-area {
        padding-top: 140px;
        padding-bottom: 100px;
        background: #f4f7fb;
        min-height: 100vh;
    }

    /* Card Utama dengan Soft Shadow */
    .main-job-card {
        background: white;
        border: none;
        border-radius: 25px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        overflow: hidden;
    }

    /* Hero Section di dalam Card */
    .job-hero-header {
        background: linear-gradient(135deg, #4b8ef1 0%, #2b6ed1 100%);
        padding: 50px 40px;
        color: white;
    }

    .job-badge {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(5px);
        padding: 6px 15px;
        border-radius: 50px;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    /* Animasi Tombol Lamar */
    .btn-apply-animated {
        background: #ffffff;
        color: #4b8ef1;
        padding: 15px 35px;
        border-radius: 50px;
        font-weight: 800;
        text-transform: uppercase;
        border: none;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        display: inline-block;
        text-decoration: none;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .btn-apply-animated:hover {
        transform: scale(1.05) translateY(-5px);
        box-shadow: 0 15px 25px rgba(0,0,0,0.2);
        color: #1a5bb8;
    }

    /* Sidebar Info Box */
    .sidebar-summary {
        background: #ffffff;
        border: 1px solid #edf2f7;
        border-radius: 20px;
        padding: 25px;
    }

    .info-item {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }

    .info-icon {
        width: 45px;
        height: 45px;
        background: #f0f7ff;
        color: #4b8ef1;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        font-size: 18px;
    }

    /* Section Styling */
    .detail-label {
        color: #4b8ef1;
        font-weight: 800;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 1.2px;
        margin-bottom: 15px;
        display: block;
    }
</style>

<div class="job-detail-area">
    <div class="container">
        
        <div class="mb-4">
            <a href="{{ route('jobs.index') }}" class="text-muted text-decoration-none fw-bold">
                <i class="fas fa-chevron-left me-2"></i> Eksplor Lowongan Lain
            </a>
        </div>

        <div class="main-job-card">
            <div class="job-hero-header text-center text-md-start">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <div class="d-flex gap-2 justify-content-center justify-content-md-start mb-3">
                            <span class="job-badge"><i class="fas fa-briefcase me-1"></i> {{ str_replace('_', ' ', $job->tipe_pekerjaan) }}</span>
                            <span class="job-badge bg-white text-primary"><i class="fas fa-check-circle me-1"></i> Aktif</span>
                        </div>
                        <h1 class="display-6 fw-bold mb-2">{{ $job->judul }}</h1>
                        <p class="fs-5 opacity-75 mb-0"><i class="fas fa-building me-2"></i>{{ $job->perusahaan }}</p>
                    </div>
                    <div class="col-md-4 text-center text-md-end mt-4 mt-md-0">
                        <a href="mailto:{{ $job->kontak_email }}" class="btn-apply-animated">
                            Lamar Sekarang <i class="fas fa-paper-plane ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="p-4 p-md-5">
                <div class="row g-5">
                    <div class="col-lg-7">
                        <div class="mb-5">
                            <span class="detail-label">Deskripsi Pekerjaan</span>
                            <div class="text-secondary lh-lg" style="font-size: 1.1rem;">
                                {!! nl2br(e($job->deskripsi)) !!}
                            </div>
                        </div>

                        @if($job->persyaratan)
                        <div class="mb-4">
                            <span class="detail-label">Persyaratan Utama</span>
                            <div class="text-secondary lh-lg" style="font-size: 1.1rem;">
                                {!! nl2br(e($job->persyaratan)) !!}
                            </div>
                        </div>
                        @endif
                    </div>

                    <div class="col-lg-5">
                        <div class="sidebar-summary sticky-top" style="top: 100px;">
                            <h5 class="fw-bold mb-4">Ringkasan Info</h5>
                            
                            <div class="info-item">
                                <div class="info-icon"><i class="fas fa-map-marker-alt"></i></div>
                                <div>
                                    <small class="text-muted d-block">Lokasi</small>
                                    <span class="fw-bold text-dark">{{ $job->lokasi }}</span>
                                </div>
                            </div>

                            <div class="info-item">
                                <div class="info-icon text-success" style="background: #e9fbf0;"><i class="fas fa-wallet"></i></div>
                                <div>
                                    <small class="text-muted d-block">Estimasi Gaji</small>
                                    <span class="fw-bold text-dark">
                                        @if($job->gaji_min)
                                            Rp{{ number_format($job->gaji_min, 0, ',', '.') }} - Rp{{ number_format($job->gaji_max, 0, ',', '.') }}
                                        @else
                                            Negotiable
                                        @endif
                                    </span>
                                </div>
                            </div>

                            <div class="info-item">
                                <div class="info-icon text-danger" style="background: #fff5f5;"><i class="fas fa-envelope"></i></div>
                                <div>
                                    <small class="text-muted d-block">Kontak HRD</small>
                                    <span class="fw-bold text-dark">{{ $job->kontak_email }}</span>
                                </div>
                            </div>

                            @if(Auth::id() == $job->user_id)
                            <hr class="my-4">
                            <div class="d-grid gap-2">
                                <a href="{{ route('jobs.edit', $job->id) }}" class="btn btn-outline-primary rounded-pill fw-bold">
                                    <i class="fas fa-edit me-2"></i> Edit Postingan
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection