@extends('layout.admin')

@section('admin_content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-0 shadow-sm" style="border-radius: 15px;">
                <div class="card-header bg-white border-0 pt-4 px-4">
                    <h4 class="fw-bold">Edit Lowongan Pekerjaan</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.jobs.update', $job->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label fw-semibold">Judul Lowongan</label>
                                <input type="text" name="judul" class="form-control" value="{{ $job->judul }}" required>
                            </div>
                            
                            <div class="col-md-12">
                                <label class="form-label fw-semibold">Poster Lowongan (Opsional)</label>
                                @if($job->poster)
                                    <div class="mb-2">
                                        <small class="text-muted d-block mb-1">Poster Saat Ini:</small>
                                        <img src="{{ asset('storage/' . $job->poster) }}" class="rounded shadow-sm" style="max-height: 150px;">
                                    </div>
                                @endif
                                <input type="file" name="poster" class="form-control" accept="image/*" id="posterInput">
                                <small class="text-muted">Pilih file baru jika ingin mengganti poster (JPG/PNG, Max 2MB).</small>
                                <img id="preview" src="#" alt="Preview" class="img-fluid mt-2 rounded d-none" style="max-height: 150px;">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Nama Perusahaan</label>
                                <input type="text" name="perusahaan" class="form-control" value="{{ $job->perusahaan }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Lokasi</label>
                                <input type="text" name="lokasi" class="form-control" value="{{ $job->lokasi }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Tipe Pekerjaan</label>
                                <select name="tipe_pekerjaan" class="form-select">
                                    <option value="full_time" {{ $job->tipe_pekerjaan == 'full_time' ? 'selected' : '' }}>Full Time</option>
                                    <option value="part_time" {{ $job->tipe_pekerjaan == 'part_time' ? 'selected' : '' }}>Part Time</option>
                                    <option value="internship" {{ $job->tipe_pekerjaan == 'internship' ? 'selected' : '' }}>Internship</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-semibold">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control" rows="5" required>{{ $job->deskripsi }}</textarea>
                            </div>
                        </div>
                        <div class="mt-4 d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.jobs.index') }}" class="btn btn-light px-4">Batal</a>
                            <button type="submit" class="btn btn-primary px-4">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Script sederhana untuk preview gambar yang baru dipilih
    posterInput.onchange = evt => {
        const [file] = posterInput.files
        if (file) {
            preview.src = URL.createObjectURL(file)
            preview.classList.remove('d-none')
        }
    }
</script>
@endsection