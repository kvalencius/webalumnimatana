{{-- Sesuaikan @extends dengan lokasi file sidebar/layout Anda --}}
@extends('layout.admin')

@section('admin_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold" style="color: #002d72;">Manajemen Jurusan</h3>
    <button class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambah">
        <i class="fas fa-plus me-2"></i> Tambah Jurusan
    </button>
</div>

@if(session('success'))
    <div class="alert alert-success border-0 shadow-sm mb-4">
        {{ session('success') }}
    </div>
@endif

<div class="card border-0 shadow-sm p-4" style="border-radius: 15px;">
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th width="10%">No</th>
                    <th>Nama Jurusan</th>
                    <th width="15%" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($majors as $index => $m)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td class="fw-bold">{{ $m->name }}</td>
                    <td class="text-center">
                        <form action="{{ route('admin.majors.destroy', $m->id) }}" method="POST" onsubmit="return confirm('Hapus jurusan ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-link text-danger p-0">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center py-4 text-muted">Belum ada data jurusan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="{{ route('admin.majors.store') }}" method="POST" class="modal-content border-0 shadow">
            @csrf
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">Tambah Jurusan Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Jurusan</label>
                    <input type="text" name="name" class="form-control" placeholder="Contoh: Informatika" required>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary px-4">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection