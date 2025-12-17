@extends('layout.layout_login')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Tracer Study Alumni</h3>
                    <p class="mb-0 small">Survei Pelacakan Karir Alumni Pascasarjana</p>
                </div>
                <div class="card-body">
                    <!-- Peringatan Data Tidak Lengkap -->
                    @php
                        $incompleteData = [];
                        if (!$alumni->nim) $incompleteData[] = 'NIM';
                        if (!$alumni->graduation_year) $incompleteData[] = 'Tahun Lulus';
                        if (!$alumni->major) $incompleteData[] = 'Program Studi';
                        if (!$alumni->current_job) $incompleteData[] = 'Status Pekerjaan';
                        if ($alumni->current_job === 'bekerja' && !$alumni->company_name) $incompleteData[] = 'Nama Perusahaan';
                        if ($alumni->current_job === 'bekerja' && !$alumni->job_position) $incompleteData[] = 'Posisi Pekerjaan';
                        if (!$alumni->phone) $incompleteData[] = 'Nomor Telepon';
                    @endphp

                    @if (count($incompleteData) > 0)
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong><i class="fas fa-exclamation-triangle"></i> Perhatian!</strong>
                            <p class="mb-2">Data profil Anda belum lengkap. Silahkan lengkapi data berikut sebelum mengisi tracer study:</p>
                            <ul class="mb-2">
                                @foreach ($incompleteData as $field)
                                    <li>{{ $field }}</li>
                                @endforeach
                            </ul>
                            <a href="{{ route('profil') }}" class="btn btn-sm btn-warning">Lengkapi Data Profil</a>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Terjadi Kesalahan!</strong>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('tracer.store') }}" method="POST">
                        @csrf

                        <!-- Status Pekerjaan -->
                        <div class="mb-3">
                            <label for="status" class="form-label fw-bold">Status Pekerjaan <span class="text-danger">*</span></label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required onchange="toggleJobFields()">
                                <option value="">-- Pilih Status Pekerjaan --</option>
                                <option value="bekerja_full_time" {{ old('status', $existingTracer->status ?? '') === 'bekerja_full_time' ? 'selected' : '' }}>Bekerja Full Time</option>
                                <option value="bekerja_part_time" {{ old('status', $existingTracer->status ?? '') === 'bekerja_part_time' ? 'selected' : '' }}>Bekerja Part Time</option>
                                <option value="wiraswasta" {{ old('status', $existingTracer->status ?? '') === 'wiraswasta' ? 'selected' : '' }}>Wiraswasta</option>
                                <option value="lanjut_pendidikan" {{ old('status', $existingTracer->status ?? '') === 'lanjut_pendidikan' ? 'selected' : '' }}>Lanjut Pendidikan</option>
                                <option value="tidak_kerja_sedang_cari" {{ old('status', $existingTracer->status ?? '') === 'tidak_kerja_sedang_cari' ? 'selected' : '' }}>Tidak Bekerja (Sedang Cari)</option>
                                <option value="belum_memungkinkan_kerja" {{ old('status', $existingTracer->status ?? '') === 'belum_memungkinkan_kerja' ? 'selected' : '' }}>Belum Memungkinkan Bekerja</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Perusahaan dari Alumni Data (Read-only untuk bekerja full/part time) -->
                        <div class="mb-3" id="company-field" style="display: none;">
                            <label for="current_company" class="form-label fw-bold">Perusahaan / Institusi <span class="text-danger">*</span></label>
                            <div class="alert alert-info small mb-2">
                                <i class="fas fa-info-circle"></i> Data diambil dari profil Anda. Jika ingin mengubah, silahkan update profil terlebih dahulu.
                            </div>
                            <input type="text" class="form-control @error('current_company') is-invalid @enderror" 
                                id="current_company" name="current_company" 
                                value="{{ old('current_company', $existingTracer->current_company ?? $alumni->company_name ?? '') }}" 
                                placeholder="Nama perusahaan atau institusi" readonly>
                            @error('current_company')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Posisi dari Alumni Data (Read-only untuk bekerja full/part time) -->
                        <div class="mb-3" id="position-field" style="display: none;">
                            <label for="current_position" class="form-label fw-bold">Posisi / Jabatan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('current_position') is-invalid @enderror" 
                                id="current_position" name="current_position" 
                                value="{{ old('current_position', $existingTracer->current_position ?? $alumni->job_position ?? '') }}" 
                                placeholder="Posisi atau jabatan Anda" readonly>
                            @error('current_position')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Sumber Pendanaan -->
                        <div class="mb-3">
                            <label for="funding_source" class="form-label fw-bold">Sumber Pendanaan <span class="text-danger">*</span></label>
                            <select class="form-select @error('funding_source') is-invalid @enderror" id="funding_source" name="funding_source" required>
                                <option value="">-- Pilih Sumber Pendanaan --</option>
                                <option value="biaya_sendiri" {{ old('funding_source', $existingTracer->funding_source ?? '') === 'biaya_sendiri' ? 'selected' : '' }}>Biaya Sendiri</option>
                                <option value="beasiswa_adik" {{ old('funding_source', $existingTracer->funding_source ?? '') === 'beasiswa_adik' ? 'selected' : '' }}>Beasiswa ADIK</option>
                                <option value="beasiswa_bidikmisi" {{ old('funding_source', $existingTracer->funding_source ?? '') === 'beasiswa_bidikmisi' ? 'selected' : '' }}>Beasiswa Bidikmisi</option>
                                <option value="beasiswa_ppa" {{ old('funding_source', $existingTracer->funding_source ?? '') === 'beasiswa_ppa' ? 'selected' : '' }}>Beasiswa PPA</option>
                                <option value="beasiswa_afirmasi" {{ old('funding_source', $existingTracer->funding_source ?? '') === 'beasiswa_afirmasi' ? 'selected' : '' }}>Beasiswa Afirmasi</option>
                                <option value="beasiswa_swasta" {{ old('funding_source', $existingTracer->funding_source ?? '') === 'beasiswa_swasta' ? 'selected' : '' }}>Beasiswa Swasta</option>
                                <option value="lainnya" {{ old('funding_source', $existingTracer->funding_source ?? '') === 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('funding_source')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Divider -->
                        <hr class="my-4">

                        <!-- Rating Scales Section -->
                        <div class="mb-4">
                            <h5 class="mb-3">Penilaian Kualitas Pembelajaran</h5>
                            <p class="text-muted small">Berikan penilaian Anda terhadap aspek-aspek berikut (1 = Sangat Kurang, 5 = Sangat Baik) <span class="text-danger">*</span></p>

                            <!-- F21 - Perkuliahan -->
                            <div class="mb-3">
                                <label for="f21_perkuliahan" class="form-label">1. Kualitas Perkuliahan dan Metode Pengajaran</label>
                                <select class="form-select @error('f21_perkuliahan') is-invalid @enderror" id="f21_perkuliahan" name="f21_perkuliahan" required>
                                    <option value="">-- Pilih Rating --</option>
                                    <option value="1" {{ old('f21_perkuliahan', $existingTracer->f21_perkuliahan ?? '') == '1' ? 'selected' : '' }}>1 - Sangat Kurang</option>
                                    <option value="2" {{ old('f21_perkuliahan', $existingTracer->f21_perkuliahan ?? '') == '2' ? 'selected' : '' }}>2 - Kurang</option>
                                    <option value="3" {{ old('f21_perkuliahan', $existingTracer->f21_perkuliahan ?? '') == '3' ? 'selected' : '' }}>3 - Cukup</option>
                                    <option value="4" {{ old('f21_perkuliahan', $existingTracer->f21_perkuliahan ?? '') == '4' ? 'selected' : '' }}>4 - Baik</option>
                                    <option value="5" {{ old('f21_perkuliahan', $existingTracer->f21_perkuliahan ?? '') == '5' ? 'selected' : '' }}>5 - Sangat Baik</option>
                                </select>
                                @error('f21_perkuliahan')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- F22 - Demonstrasi -->
                            <div class="mb-3">
                                <label for="f22_demonstrasi" class="form-label">2. Demonstrasi / Praktik Langsung</label>
                                <select class="form-select @error('f22_demonstrasi') is-invalid @enderror" id="f22_demonstrasi" name="f22_demonstrasi" required>
                                    <option value="">-- Pilih Rating --</option>
                                    <option value="1" {{ old('f22_demonstrasi', $existingTracer->f22_demonstrasi ?? '') == '1' ? 'selected' : '' }}>1 - Sangat Kurang</option>
                                    <option value="2" {{ old('f22_demonstrasi', $existingTracer->f22_demonstrasi ?? '') == '2' ? 'selected' : '' }}>2 - Kurang</option>
                                    <option value="3" {{ old('f22_demonstrasi', $existingTracer->f22_demonstrasi ?? '') == '3' ? 'selected' : '' }}>3 - Cukup</option>
                                    <option value="4" {{ old('f22_demonstrasi', $existingTracer->f22_demonstrasi ?? '') == '4' ? 'selected' : '' }}>4 - Baik</option>
                                    <option value="5" {{ old('f22_demonstrasi', $existingTracer->f22_demonstrasi ?? '') == '5' ? 'selected' : '' }}>5 - Sangat Baik</option>
                                </select>
                                @error('f22_demonstrasi')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- F23 - Riset Project -->
                            <div class="mb-3">
                                <label for="f23_riset_project" class="form-label">3. Riset dan Project-Based Learning</label>
                                <select class="form-select @error('f23_riset_project') is-invalid @enderror" id="f23_riset_project" name="f23_riset_project" required>
                                    <option value="">-- Pilih Rating --</option>
                                    <option value="1" {{ old('f23_riset_project', $existingTracer->f23_riset_project ?? '') == '1' ? 'selected' : '' }}>1 - Sangat Kurang</option>
                                    <option value="2" {{ old('f23_riset_project', $existingTracer->f23_riset_project ?? '') == '2' ? 'selected' : '' }}>2 - Kurang</option>
                                    <option value="3" {{ old('f23_riset_project', $existingTracer->f23_riset_project ?? '') == '3' ? 'selected' : '' }}>3 - Cukup</option>
                                    <option value="4" {{ old('f23_riset_project', $existingTracer->f23_riset_project ?? '') == '4' ? 'selected' : '' }}>4 - Baik</option>
                                    <option value="5" {{ old('f23_riset_project', $existingTracer->f23_riset_project ?? '') == '5' ? 'selected' : '' }}>5 - Sangat Baik</option>
                                </select>
                                @error('f23_riset_project')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- F24 - Magang -->
                            <div class="mb-3">
                                <label for="f24_magang" class="form-label">4. Program Magang dan Pengalaman Kerja</label>
                                <select class="form-select @error('f24_magang') is-invalid @enderror" id="f24_magang" name="f24_magang" required>
                                    <option value="">-- Pilih Rating --</option>
                                    <option value="1" {{ old('f24_magang', $existingTracer->f24_magang ?? '') == '1' ? 'selected' : '' }}>1 - Sangat Kurang</option>
                                    <option value="2" {{ old('f24_magang', $existingTracer->f24_magang ?? '') == '2' ? 'selected' : '' }}>2 - Kurang</option>
                                    <option value="3" {{ old('f24_magang', $existingTracer->f24_magang ?? '') == '3' ? 'selected' : '' }}>3 - Cukup</option>
                                    <option value="4" {{ old('f24_magang', $existingTracer->f24_magang ?? '') == '4' ? 'selected' : '' }}>4 - Baik</option>
                                    <option value="5" {{ old('f24_magang', $existingTracer->f24_magang ?? '') == '5' ? 'selected' : '' }}>5 - Sangat Baik</option>
                                </select>
                                @error('f24_magang')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- F25 - Praktikum -->
                            <div class="mb-3">
                                <label for="f25_praktikum" class="form-label">5. Praktikum dan Laboratorium</label>
                                <select class="form-select @error('f25_praktikum') is-invalid @enderror" id="f25_praktikum" name="f25_praktikum" required>
                                    <option value="">-- Pilih Rating --</option>
                                    <option value="1" {{ old('f25_praktikum', $existingTracer->f25_praktikum ?? '') == '1' ? 'selected' : '' }}>1 - Sangat Kurang</option>
                                    <option value="2" {{ old('f25_praktikum', $existingTracer->f25_praktikum ?? '') == '2' ? 'selected' : '' }}>2 - Kurang</option>
                                    <option value="3" {{ old('f25_praktikum', $existingTracer->f25_praktikum ?? '') == '3' ? 'selected' : '' }}>3 - Cukup</option>
                                    <option value="4" {{ old('f25_praktikum', $existingTracer->f25_praktikum ?? '') == '4' ? 'selected' : '' }}>4 - Baik</option>
                                    <option value="5" {{ old('f25_praktikum', $existingTracer->f25_praktikum ?? '') == '5' ? 'selected' : '' }}>5 - Sangat Baik</option>
                                </select>
                                @error('f25_praktikum')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- F26 - Kerja Lapangan -->
                            <div class="mb-3">
                                <label for="f26_kerja_lapangan" class="form-label">6. Kerja Lapangan dan Study Tour</label>
                                <select class="form-select @error('f26_kerja_lapangan') is-invalid @enderror" id="f26_kerja_lapangan" name="f26_kerja_lapangan" required>
                                    <option value="">-- Pilih Rating --</option>
                                    <option value="1" {{ old('f26_kerja_lapangan', $existingTracer->f26_kerja_lapangan ?? '') == '1' ? 'selected' : '' }}>1 - Sangat Kurang</option>
                                    <option value="2" {{ old('f26_kerja_lapangan', $existingTracer->f26_kerja_lapangan ?? '') == '2' ? 'selected' : '' }}>2 - Kurang</option>
                                    <option value="3" {{ old('f26_kerja_lapangan', $existingTracer->f26_kerja_lapangan ?? '') == '3' ? 'selected' : '' }}>3 - Cukup</option>
                                    <option value="4" {{ old('f26_kerja_lapangan', $existingTracer->f26_kerja_lapangan ?? '') == '4' ? 'selected' : '' }}>4 - Baik</option>
                                    <option value="5" {{ old('f26_kerja_lapangan', $existingTracer->f26_kerja_lapangan ?? '') == '5' ? 'selected' : '' }}>5 - Sangat Baik</option>
                                </select>
                                @error('f26_kerja_lapangan')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- F27 - Diskusi -->
                            <div class="mb-3">
                                <label for="f27_diskusi" class="form-label">7. Diskusi dan Interaksi Akademik</label>
                                <select class="form-select @error('f27_diskusi') is-invalid @enderror" id="f27_diskusi" name="f27_diskusi" required>
                                    <option value="">-- Pilih Rating --</option>
                                    <option value="1" {{ old('f27_diskusi', $existingTracer->f27_diskusi ?? '') == '1' ? 'selected' : '' }}>1 - Sangat Kurang</option>
                                    <option value="2" {{ old('f27_diskusi', $existingTracer->f27_diskusi ?? '') == '2' ? 'selected' : '' }}>2 - Kurang</option>
                                    <option value="3" {{ old('f27_diskusi', $existingTracer->f27_diskusi ?? '') == '3' ? 'selected' : '' }}>3 - Cukup</option>
                                    <option value="4" {{ old('f27_diskusi', $existingTracer->f27_diskusi ?? '') == '4' ? 'selected' : '' }}>4 - Baik</option>
                                    <option value="5" {{ old('f27_diskusi', $existingTracer->f27_diskusi ?? '') == '5' ? 'selected' : '' }}>5 - Sangat Baik</option>
                                </select>
                                @error('f27_diskusi')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="d-flex gap-2 justify-content-between">
                            <a href="{{ route('profil') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan Tracer Study</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function toggleJobFields() {
    const status = document.getElementById('status').value;
    const companyField = document.getElementById('company-field');
    const positionField = document.getElementById('position-field');

    if (status === 'bekerja_full_time' || status === 'bekerja_part_time' || status === 'wiraswasta') {
        companyField.style.display = 'block';
        positionField.style.display = 'block';
    } else {
        companyField.style.display = 'none';
        positionField.style.display = 'none';
    }
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    toggleJobFields();
});
</script>
@endsection

