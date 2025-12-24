@extends('layout.admin')

@section('admin_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold text-navy">Dashboard Overview</h3>
    <div class="dropdown">
        <button class="btn btn-white shadow-sm dropdown-toggle" type="button">Admin Profile</button>
    </div>
</div>

<div class="row g-4 mb-5">
    <div class="col-md-4">
        <div class="card stat-card p-4 bg-primary text-white">
            <small>TOTAL ALUMNI</small>
            <h2 class="fw-bold">1,250</h2>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stat-card p-4 bg-warning text-dark">
            <small>MENUNGGU VERIFIKASI</small>
            <h2 class="fw-bold">5</h2>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stat-card p-4 bg-info text-white">
            <small>LOKER AKTIF</small>
            <h2 class="fw-bold">12</h2>
        </div>
    </div>
</div>

<div class="card stat-card p-4">
    <h5 class="fw-bold mb-4">New Registered Alumni (Perlu Verifikasi)</h5>
    <table class="table align-middle">
        <thead class="table-light">
            <tr>
                <th>Nama</th>
                <th>Angkatan</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Budi Santoso</td>
                <td>2018</td>
                <td><span class="badge bg-warning">Pending</span></td>
                <td>
                    <button class="btn btn-sm btn-success">[V]</button>
                    <button class="btn btn-sm btn-danger">[X]</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection