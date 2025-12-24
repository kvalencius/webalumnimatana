@extends('layout.admin')

@section('admin_content')
<div class="container-fluid">
    <div class="mb-4">
        <a href="{{ route('admin.jobs.index') }}" class="text-decoration-none text-muted">
            <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar
        </a>
        <h3 class="fw-bold text-navy mt-2">Tambah Lowongan Kerja Baru</h3>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius: 15px;">
        <div class="card-body p-4">
            <form action="{{ route('admin.jobs.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Judul Lowongan</label>
                            <input type="text" name="judul" class="form-control" placeholder="Contoh: Junior Web Developer" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Perusahaan</label>
                            <input type="text" name="perusahaan" class="form-control" placeholder="Nama Perusahaan" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Deskripsi Pekerjaan</label>
                            <textarea name="deskripsi" class="form-control" rows="5" placeholder="Jelaskan detail pekerjaan..." required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Persyaratan</label>
                            <textarea name="persyaratan" class="form-control" rows="4" placeholder="Kualifikasi yang dibutuhkan..."></textarea>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Lokasi</label>
                            <input type="text" name="lokasi" class="form-control" placeholder="Contoh: Jakarta / Remote" required>
                        </div>

                        <div class="mb-3">
                        <select name="tipe_pekerjaan" class="form-select" required>
                        <option value="full_time">Full Time</option>
                        <option value="part_time">Part Time</option>
                        <option value="internship">Internship</option>
                        <option value="contract">Contract</option>
                        </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold text-primary">Poster Lowongan</label>
                            <div class="border p-3 text-center rounded" style="border-style: dashed !important;">
                                <input type="file" name="poster" class="form-control mb-2" accept="image/*" id="posterInput">
                                <small class="text-muted d-block">Format: JPG, PNG. Maks: 2MB</small>
                            </div>
                            <img id="preview" src="#" alt="Preview" class="img-fluid mt-2 rounded shadow-sm d-none" style="max-height: 200px;">
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary shadow-sm py-2">
                                <i class="fas fa-save me-2"></i>Simpan & Publikasikan
                            </button>
                            <a href="{{ route('admin.jobs.index') }}" class="btn btn-light border py-2">Batal</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    posterInput.onchange = evt => {
        const [file] = posterInput.files
        if (file) {
            preview.src = URL.createObjectURL(file)
            preview.classList.remove('d-none')
        }
    }
</script>
@endsection