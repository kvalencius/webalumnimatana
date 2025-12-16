@extends('layout.layout_login')

@section('content')
<div class="max-w-2xl mx-auto">
    <h2 class="text-3xl font-bold text-center text-slate-800 mb-8">Profil Saya</h2>

    @if(session('success'))
        <div class="mb-4 rounded-lg bg-green-100 p-4 text-sm text-green-800">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="mb-4 rounded-lg bg-red-100 p-4 text-sm text-red-800">{{ session('error') }}</div>
    @endif

    <!-- Tracer Study Alert for Alumni -->
    @if($user->role === 'alumni')
        @php
            $hasTracerStudy = $user->alumni && $user->alumni->tracerStudy;
        @endphp
        @if(!$hasTracerStudy)
            <div class="mb-4 rounded-lg bg-warning border border-warning p-4 text-sm text-dark">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <strong><i class="fas fa-exclamation-circle"></i> Penting!</strong>
                        <p class="mb-0 mt-1">Anda belum mengisi Tracer Study. Tracer Study adalah survei wajib untuk melacak perkembangan karir Anda sebagai alumni. Silahkan isi sekarang.</p>
                    </div>
                    <a href="{{ route('tracer.form') }}" class="btn btn-warning btn-sm ms-3 flex-shrink-0">Isi Tracer Study</a>
                </div>
            </div>
        @else
            <div class="mb-4 rounded-lg bg-success border border-success p-4 text-sm text-dark">
                <strong><i class="fas fa-check-circle"></i> Tracer Study Selesai</strong>
                <p class="mb-0 mt-1">Anda telah menyelesaikan Tracer Study pada {{ $hasTracerStudy->survey_date->format('d/m/Y') }}. <a href="{{ route('tracer.form') }}" class="text-decoration-none">Ubah jawaban</a></p>
            </div>
        @endif
    @endif

    <!-- Profile Picture Section -->
    <div class="text-center mb-8">
        <div class="mb-4">
            @if($user->profile_picture)
                <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="{{ $user->name }}"
                    class="w-24 h-24 rounded-full mx-auto object-cover border-4 border-indigo-200">
            @else
                <div class="w-24 h-24 rounded-full mx-auto bg-slate-300 flex items-center justify-center">
                    <i class="fas fa-user text-4xl text-slate-600"></i>
                </div>
            @endif
        </div>

        @if($user->data_completed)
            <form action="{{ route('profile.picture.update') }}" method="POST" enctype="multipart/form-data" class="inline">
                @csrf
                <label class="cursor-pointer">
                    <span class="inline-block px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-500 text-sm">
                        Ubah Foto
                    </span>
                    <input type="file" name="profile_picture" accept="image/*" class="hidden" onchange="this.form.submit()">
                </label>
            </form>
        @endif
    </div>

    <!-- User Basic Info -->
    <div class="space-y-4 mb-8">
        <div class="rounded-lg border border-slate-200 p-4 bg-slate-50">
            <p class="text-sm text-slate-500">Nama</p>
            <p class="text-lg font-semibold text-slate-800">{{ $user->name }}</p>
        </div>
        <div class="rounded-lg border border-slate-200 p-4 bg-slate-50">
            <p class="text-sm text-slate-500">Email</p>
            <p class="text-lg font-semibold text-slate-800">{{ $user->email }}</p>
        </div>
        <div class="rounded-lg border border-slate-200 p-4 bg-slate-50">
            <p class="text-sm text-slate-500">Status</p>
            <p class="text-lg font-semibold text-slate-800">
                @switch($user->role)
                    @case('alumni')
                        Alumni
                        @break
                    @case('student')
                        Mahasiswa Aktif
                        @break
                    @case('teacher')
                        Dosen
                        @break
                @endswitch
            </p>
        </div>
    </div>

    <!-- Role-based Data Display -->
    @if($data)
        <div class="border-t border-slate-200 pt-8 mt-8">
            <h3 class="text-xl font-bold text-slate-800 mb-6">
                @switch($user->role)
                    @case('alumni')
                        Data Alumni
                        @break
                    @case('student')
                        Data Akademik
                        @break
                    @case('teacher')
                        Data Akademik
                        @break
                @endswitch
            </h3>

            <div class="space-y-4">
                @switch($user->role)
                    @case('alumni')
                        <div class="flex justify-between items-center mb-4">
                            <h4 class="text-lg font-bold text-slate-800">Data Alumni</h4>
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editAlumniModal">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                        </div>
                        
                        <div class="rounded-lg border border-slate-200 p-4">
                            <p class="text-sm text-slate-500">NIM</p>
                            <p class="text-lg font-semibold text-slate-800">{{ $data->nim }}</p>
                        </div>
                        <div class="rounded-lg border border-slate-200 p-4">
                            <p class="text-sm text-slate-500">Program Studi</p>
                            <p class="text-lg font-semibold text-slate-800">{{ $data->major }}</p>
                        </div>
                        <div class="rounded-lg border border-slate-200 p-4">
                            <p class="text-sm text-slate-500">Tahun Lulus</p>
                            <p class="text-lg font-semibold text-slate-800">{{ $data->graduation_year }}</p>
                        </div>
                        <div class="rounded-lg border border-slate-200 p-4">
                            <p class="text-sm text-slate-500">Status Pekerjaan</p>
                            <p class="text-lg font-semibold text-slate-800">
                                @switch($data->current_job)
                                    @case('bekerja')
                                        Bekerja
                                        @break
                                    @case('tidak_bekerja')
                                        Tidak Bekerja
                                        @break
                                    @case('melanjutkan_studi')
                                        Melanjutkan Studi
                                        @break
                                @endswitch
                            </p>
                        </div>
                        @if($data->current_job === 'bekerja')
                            <div class="rounded-lg border border-slate-200 p-4">
                                <p class="text-sm text-slate-500">Perusahaan</p>
                                <p class="text-lg font-semibold text-slate-800">{{ $data->company_name }}</p>
                            </div>
                            <div class="rounded-lg border border-slate-200 p-4">
                                <p class="text-sm text-slate-500">Posisi</p>
                                <p class="text-lg font-semibold text-slate-800">{{ $data->job_position }}</p>
                            </div>
                        @endif
                        
                        <!-- Tracer Study Data Section -->
                        @php
                            $tracerStudy = $user->alumni && $user->alumni->tracerStudy ? $user->alumni->tracerStudy : null;
                        @endphp
                        @if($tracerStudy)
                            <div class="mt-8 border-t border-slate-200 pt-6">
                                <h4 class="text-lg font-bold text-slate-800 mb-4">
                                    <i class="fas fa-chart-line"></i> Data Tracer Study
                                </h4>
                                
                                <div class="rounded-lg border border-blue-200 bg-blue-50 p-4 mb-4">
                                    <p class="text-sm text-blue-600">Tanggal Survei</p>
                                    <p class="text-lg font-semibold text-blue-900">{{ $tracerStudy->survey_date->format('d F Y') }}</p>
                                </div>

                                <div class="space-y-4">
                                    <!-- Status Pekerjaan -->
                                    <div class="rounded-lg border border-slate-200 p-4">
                                        <p class="text-sm text-slate-500">Status Pekerjaan</p>
                                        <p class="text-lg font-semibold text-slate-800">
                                            @switch($tracerStudy->status)
                                                @case('bekerja_full_time')
                                                    Bekerja Full Time
                                                    @break
                                                @case('bekerja_part_time')
                                                    Bekerja Part Time
                                                    @break
                                                @case('wiraswasta')
                                                    Wiraswasta
                                                    @break
                                                @case('lanjut_pendidikan')
                                                    Lanjut Pendidikan
                                                    @break
                                                @case('tidak_kerja_sedang_cari')
                                                    Tidak Bekerja (Sedang Cari)
                                                    @break
                                                @case('belum_memungkinkan_kerja')
                                                    Belum Memungkinkan Bekerja
                                                    @break
                                            @endswitch
                                        </p>
                                    </div>

                                    <!-- Perusahaan (jika bekerja) -->
                                    @if($tracerStudy->current_company)
                                        <div class="rounded-lg border border-slate-200 p-4">
                                            <p class="text-sm text-slate-500">Perusahaan / Institusi</p>
                                            <p class="text-lg font-semibold text-slate-800">{{ $tracerStudy->current_company }}</p>
                                        </div>
                                    @endif

                                    <!-- Posisi (jika bekerja) -->
                                    @if($tracerStudy->current_position)
                                        <div class="rounded-lg border border-slate-200 p-4">
                                            <p class="text-sm text-slate-500">Posisi / Jabatan</p>
                                            <p class="text-lg font-semibold text-slate-800">{{ $tracerStudy->current_position }}</p>
                                        </div>
                                    @endif

                                    <!-- Sumber Pendanaan -->
                                    <div class="rounded-lg border border-slate-200 p-4">
                                        <p class="text-sm text-slate-500">Sumber Pendanaan</p>
                                        <p class="text-lg font-semibold text-slate-800">
                                            @switch($tracerStudy->funding_source)
                                                @case('biaya_sendiri')
                                                    Biaya Sendiri
                                                    @break
                                                @case('beasiswa_adik')
                                                    Beasiswa ADIK
                                                    @break
                                                @case('beasiswa_bidikmisi')
                                                    Beasiswa Bidikmisi
                                                    @break
                                                @case('beasiswa_ppa')
                                                    Beasiswa PPA
                                                    @break
                                                @case('beasiswa_afirmasi')
                                                    Beasiswa Afirmasi
                                                    @break
                                                @case('beasiswa_swasta')
                                                    Beasiswa Swasta
                                                    @break
                                                @case('lainnya')
                                                    Lainnya
                                                    @break
                                            @endswitch
                                        </p>
                                    </div>

                                    <!-- Rating Scales -->
                                    <div class="rounded-lg border border-purple-200 bg-purple-50 p-4">
                                        <h5 class="font-bold text-purple-900 mb-3">Penilaian Kualitas Pembelajaran</h5>
                                        <div class="space-y-3">
                                            <div class="flex justify-between items-center">
                                                <span class="text-sm text-purple-700">Perkuliahan & Metode Pengajaran</span>
                                                <span class="font-semibold text-purple-900">{{ $tracerStudy->f21_perkuliahan ?? '-' }}/5</span>
                                            </div>
                                            <div class="flex justify-between items-center">
                                                <span class="text-sm text-purple-700">Demonstrasi / Praktik Langsung</span>
                                                <span class="font-semibold text-purple-900">{{ $tracerStudy->f22_demonstrasi ?? '-' }}/5</span>
                                            </div>
                                            <div class="flex justify-between items-center">
                                                <span class="text-sm text-purple-700">Riset dan Project-Based Learning</span>
                                                <span class="font-semibold text-purple-900">{{ $tracerStudy->f23_riset_project ?? '-' }}/5</span>
                                            </div>
                                            <div class="flex justify-between items-center">
                                                <span class="text-sm text-purple-700">Program Magang & Pengalaman Kerja</span>
                                                <span class="font-semibold text-purple-900">{{ $tracerStudy->f24_magang ?? '-' }}/5</span>
                                            </div>
                                            <div class="flex justify-between items-center">
                                                <span class="text-sm text-purple-700">Praktikum dan Laboratorium</span>
                                                <span class="font-semibold text-purple-900">{{ $tracerStudy->f25_praktikum ?? '-' }}/5</span>
                                            </div>
                                            <div class="flex justify-between items-center">
                                                <span class="text-sm text-purple-700">Kerja Lapangan dan Study Tour</span>
                                                <span class="font-semibold text-purple-900">{{ $tracerStudy->f26_kerja_lapangan ?? '-' }}/5</span>
                                            </div>
                                            <div class="flex justify-between items-center">
                                                <span class="text-sm text-purple-700">Diskusi dan Interaksi Akademik</span>
                                                <span class="font-semibold text-purple-900">{{ $tracerStudy->f27_diskusi ?? '-' }}/5</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <a href="{{ route('tracer.form') }}" class="text-sm text-indigo-600 hover:text-indigo-500 font-semibold">
                                        <i class="fas fa-edit"></i> Edit Tracer Study
                                    </a>
                                </div>
                            </div>
                        @endif
                        @break
                    
                    @case('student')
                        <div class="rounded-lg border border-slate-200 p-4">
                            <p class="text-sm text-slate-500">NIM</p>
                            <p class="text-lg font-semibold text-slate-800">{{ $data->nim }}</p>
                        </div>
                        <div class="rounded-lg border border-slate-200 p-4">
                            <p class="text-sm text-slate-500">Program Studi</p>
                            <p class="text-lg font-semibold text-slate-800">{{ $data->major }}</p>
                        </div>
                        <div class="rounded-lg border border-slate-200 p-4">
                            <p class="text-sm text-slate-500">Semester</p>
                            <p class="text-lg font-semibold text-slate-800">{{ $data->semester }}</p>
                        </div>
                        @break
                    
                    @case('teacher')
                        <div class="rounded-lg border border-slate-200 p-4">
                            <p class="text-sm text-slate-500">NIP</p>
                            <p class="text-lg font-semibold text-slate-800">{{ $data->nip }}</p>
                        </div>
                        <div class="rounded-lg border border-slate-200 p-4">
                            <p class="text-sm text-slate-500">Departemen</p>
                            <p class="text-lg font-semibold text-slate-800">{{ $data->department }}</p>
                        </div>
                        <div class="rounded-lg border border-slate-200 p-4">
                            <p class="text-sm text-slate-500">Keahlian</p>
                            <p class="text-lg font-semibold text-slate-800">{{ $data->specialization }}</p>
                        </div>
                        @break
                @endswitch
            </div>
        </div>
    @endif

    <!-- Action Buttons -->
    <div class="flex items-center justify-between mt-8 pt-8 border-t border-slate-200">
        <a href="{{ url('/') }}" class="text-sm text-indigo-600 hover:text-indigo-500">← Kembali ke Beranda</a>
        <a href="{{ url('/logout') }}" class="text-sm font-semibold text-rose-600 hover:text-rose-500">Logout</a>
    </div>
</div>

<!-- Edit Alumni Modal -->
@if($user->role === 'alumni' && $data)
<div class="modal fade" id="editAlumniModal" tabindex="-1" aria-labelledby="editAlumniLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAlumniLabel">Edit Data Alumni</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('alumni.update') }}" method="POST">
                @csrf
                <div class="modal-body">
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

                    <div class="mb-3">
                        <label for="nim" class="form-label">NIM <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nim') is-invalid @enderror" id="nim" name="nim" value="{{ old('nim', $data->nim) }}" required>
                        @error('nim')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="graduation_year" class="form-label">Tahun Lulus <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('graduation_year') is-invalid @enderror" id="graduation_year" name="graduation_year" value="{{ old('graduation_year', $data->graduation_year) }}" min="2000" max="{{ date('Y') }}" required>
                        @error('graduation_year')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="major" class="form-label">Program Studi <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('major') is-invalid @enderror" id="major" name="major" value="{{ old('major', $data->major) }}" required>
                        @error('major')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="current_job" class="form-label">Status Pekerjaan <span class="text-danger">*</span></label>
                        <select class="form-select @error('current_job') is-invalid @enderror" id="current_job" name="current_job" required onchange="toggleJobFields()">
                            <option value="">-- Pilih Status --</option>
                            <option value="bekerja" {{ old('current_job', $data->current_job) === 'bekerja' ? 'selected' : '' }}>Bekerja</option>
                            <option value="tidak_bekerja" {{ old('current_job', $data->current_job) === 'tidak_bekerja' ? 'selected' : '' }}>Tidak Bekerja</option>
                            <option value="melanjutkan_studi" {{ old('current_job', $data->current_job) === 'melanjutkan_studi' ? 'selected' : '' }}>Melanjutkan Studi</option>
                        </select>
                        @error('current_job')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3" id="company_name_div" style="display: {{ $data->current_job === 'bekerja' ? 'block' : 'none' }};">
                        <label for="company_name" class="form-label">Nama Perusahaan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('company_name') is-invalid @enderror" id="company_name" name="company_name" value="{{ old('company_name', $data->company_name) }}">
                        @error('company_name')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3" id="job_position_div" style="display: {{ $data->current_job === 'bekerja' ? 'block' : 'none' }};">
                        <label for="job_position" class="form-label">Posisi Pekerjaan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('job_position') is-invalid @enderror" id="job_position" name="job_position" value="{{ old('job_position', $data->job_position) }}">
                        @error('job_position')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Nomor Telepon <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $data->phone) }}" required>
                        @error('phone')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="salary_range" class="form-label">Rentang Gaji</label>
                        <input type="text" class="form-control @error('salary_range') is-invalid @enderror" id="salary_range" name="salary_range" value="{{ old('salary_range', $data->salary_range) }}">
                        @error('salary_range')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function toggleJobFields() {
    const status = document.getElementById('current_job').value;
    const companyDiv = document.getElementById('company_name_div');
    const positionDiv = document.getElementById('job_position_div');
    
    if (status === 'bekerja') {
        companyDiv.style.display = 'block';
        positionDiv.style.display = 'block';
        document.getElementById('company_name').required = true;
        document.getElementById('job_position').required = true;
    } else {
        companyDiv.style.display = 'none';
        positionDiv.style.display = 'none';
        document.getElementById('company_name').required = false;
        document.getElementById('job_position').required = false;
    }
}
</script>
@endif
        <a href="{{ url('/logout') }}" class="text-sm font-semibold text-rose-600 hover:text-rose-500">Logout</a>
    </div>
</div>

@include('layout.footer')
@endsection
