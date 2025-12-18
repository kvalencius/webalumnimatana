@extends('layout.layout')

@section('isiWebsite')
<style>
    /* REVISI UTAMA: MENGHILANGKAN SPACE JAUH */
    .management-wrapper {
        /* Gunakan margin-top negatif untuk menarik konten ke atas. 
           Jika -300px dirasa kurang tinggi atau terlalu tinggi, 
           silakan ubah angkanya (misal: -250px atau -400px).
        */
        margin-top: -320px; 
        padding-bottom: 80px;
        position: relative;
        z-index: 10; /* Menaikkan prioritas tumpukan agar di atas dekorasi */
    }

    /* Mematikan interaksi gambar agar klik mouse langsung menembus ke tombol */
    img[src*="dec"], img[src*="dots"], .about-left-image, .about-right-image {
        pointer-events: none !important;
    }

    /* 2. Glassmorphism Header */
    .glass-header {
        background: rgba(255, 255, 255, 0.9); /* Sedikit lebih solid agar kontras */
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.4);
        border-radius: 24px;
        padding: 40px;
        box-shadow: 0 10px 35px rgba(0, 0, 0, 0.07);
        margin-bottom: 40px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* 3. Button Modern */
    .btn-modern {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        color: white !important;
        padding: 14px 28px;
        border-radius: 12px;
        font-weight: 700;
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        box-shadow: 0 10px 20px rgba(78, 115, 223, 0.2);
        cursor: pointer;
        text-decoration: none;
    }

    .btn-modern:hover {
        transform: translateY(-5px) scale(1.02);
        box-shadow: 0 15px 30px rgba(78, 115, 223, 0.4);
    }

    /* 4. Stats Card */
    .stat-card-custom {
        background: white;
        border-radius: 20px;
        padding: 25px;
        text-align: center;
        border: 1px solid #f0f2f5;
        box-shadow: 0 4px 6px rgba(0,0,0,0.02);
        transition: 0.3s;
    }
    .stat-card-custom:hover {
        border-color: #4e73df;
        box-shadow: 0 10px 20px rgba(0,0,0,0.05);
    }
    .stat-val {
        font-size: 2.5rem;
        font-weight: 800;
        background: -webkit-linear-gradient(#4e73df, #224abe);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* 5. List Item */
    .job-row {
        background: white;
        border-radius: 20px;
        padding: 25px;
        margin-bottom: 15px;
        border: 1px solid #f0f2f5;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: 0.3s;
    }
    .job-row:hover {
        transform: translateX(10px);
        border-left: 5px solid #4e73df;
    }
</style>

<div class="management-wrapper">
    <div class="container">
        <div class="glass-header animate__animated animate__fadeInDown">
            <div>
                <h2 style="font-weight: 800; color: #1a202c; margin-bottom: 5px;">Management Lowongan</h2>
                <p style="color: #718096; margin: 0;">Pantau dan kelola performa postingan Anda secara real-time.</p>
            </div>
            <a href="{{ route('jobs.create') }}" class="btn-modern">
                <i class="fas fa-plus-circle"></i> Tambah Lowongan
            </a>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="stat-card-custom">
                    <p style="color: #a0aec0; font-weight: 600; text-transform: uppercase; font-size: 0.8rem;">Total Postingan</p>
                    <div class="stat-val">{{ $jobs->count() }}</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card-custom">
                    <p style="color: #a0aec0; font-weight: 600; text-transform: uppercase; font-size: 0.8rem;">Menunggu Review</p>
                    <div class="stat-val" style="background: linear-gradient(#f6ad55, #ed8936); -webkit-background-clip: text;">{{ $jobs->where('status', 'pending')->count() }}</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card-custom">
                    <p style="color: #a0aec0; font-weight: 600; text-transform: uppercase; font-size: 0.8rem;">Sudah Aktif</p>
                    <div class="stat-val" style="background: linear-gradient(#68d391, #38a169); -webkit-background-clip: text;">{{ $jobs->where('status', 'approved')->count() }}</div>
                </div>
            </div>
        </div>

        <h4 style="font-weight: 700; margin-bottom: 20px; color: #2d3748;">Daftar Lowongan Aktif</h4>
        <div class="job-list-container">
            @forelse($jobs as $job)
            <div class="job-row animate__animated animate__fadeInUp">
                <div class="d-flex align-items-center gap-4">
                    <div style="background: #edf2f7; padding: 15px; border-radius: 15px; color: #4e73df;">
                        <i class="fas fa-briefcase fa-2x"></i>
                    </div>
                    <div>
                        <h5 style="font-weight: 700; margin-bottom: 5px;">{{ $job->judul }}</h5>
                        <p style="color: #718096; font-size: 0.9rem; margin: 0;">
                            <i class="fas fa-building me-1"></i> {{ $job->perusahaan }} | 
                            <i class="fas fa-map-marker-alt me-1 text-danger"></i> {{ $job->lokasi }}
                        </p>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="badge {{ $job->status == 'approved' ? 'bg-success' : 'bg-warning' }}" style="padding: 10px 15px; border-radius: 8px;">
                        {{ strtoupper($job->status) }}
                    </span>
                    <a href="{{ route('jobs.edit', $job->id) }}" class="btn btn-outline-primary" style="border-radius: 10px; padding: 10px 15px;">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-outline-danger" style="border-radius: 10px; padding: 10px 15px;" onclick="return confirm('Hapus lowongan ini?')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
            @empty
            <div class="text-center py-5 glass-header" style="justify-content: center; flex-direction: column;">
                <i class="fas fa-inbox fa-3x text-light mb-3"></i>
                <h5>Belum ada data ditemukan</h5>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection