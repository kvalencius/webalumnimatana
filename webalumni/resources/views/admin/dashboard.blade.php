@extends('layout.admin')

@section('admin_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold text-navy">Dashboard Overview</h3>
    <div class="dropdown">
        <button class="btn btn-white shadow-sm dropdown-toggle border-0 px-4 py-2" type="button">
            Admin Profile
        </button>
    </div>
</div>

<div class="row g-4 mb-5">
    <div class="col-md-4">
        <div class="card stat-card p-4 bg-primary text-white border-0 shadow-sm">
            <small class="fw-bold opacity-75">TOTAL DATA ALUMNI</small>
            <h2 class="fw-bold mt-2">{{ number_format($totalAlumni) }}</h2>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card stat-card p-4 bg-warning text-dark border-0 shadow-sm">
            <small class="fw-bold opacity-75">MAHASISWA AKTIF</small>
            <h2 class="fw-bold mt-2">{{ number_format($totalMahasiswa ?? 0) }}</h2>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card stat-card p-4 bg-info text-white border-0 shadow-sm">
            <small class="fw-bold opacity-75">TOTAL LOKER AKTIF</small>
            <h2 class="fw-bold mt-2">{{ number_format($totalLoker) }}</h2>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4 p-4">
    <h5 class="fw-bold mb-4">Alumni Terbaru</h5>
    <table class="table align-middle">
        <thead class="table-light text-secondary">
            <tr>
                <th>Nama</th>
                <th>Angkatan</th>
                <th>Jurusan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($latestAlumni ?? [] as $alumni)
            <tr>
                <td>{{ $alumni->user->name ?? 'User Tidak Ditemukan' }}</td>
                <td>{{ $alumni->graduation_year }}</td>
                <td>{{ $alumni->major }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection