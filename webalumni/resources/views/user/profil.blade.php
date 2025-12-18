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
            $tracerStudy = $data && $data->tracerStudy ? $data->tracerStudy : null;
        @endphp
        @if(!$tracerStudy)
            <div class="mb-6 rounded-lg border border-amber-200 bg-amber-50 p-6">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <div class="flex items-center gap-2 mb-2">
                            <i class="fas fa-exclamation-circle text-amber-600 text-lg"></i>
                            <strong class="text-amber-900">Penting!</strong>
                        </div>
                        <p class="text-sm text-amber-800 mb-0">Anda belum mengisi Tracer Study. Tracer Study adalah survei wajib untuk melacak perkembangan karir Anda sebagai alumni. Silahkan isi sekarang.</p>
                    </div>
                    <a href="{{ route('tracer.form') }}" class="flex-shrink-0 px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white rounded-lg text-sm font-semibold transition">
                        <i class="fas fa-plus-circle"></i> Isi Tracer Study
                    </a>
                </div>
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
                @endswitch
            </h3>

            <div class="space-y-4">
                @switch($user->role)
                    @case('alumni')
                        <div class="flex justify-between items-center mb-4">
                            <h4 class="text-lg font-bold text-slate-800">Data Alumni</h4>
                            <a href="{{ route('alumni.edit', $data->user_id) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-edit"></i> Edit
                            </a>
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
                            $tracerStudy = $data && $data->tracerStudy ? $data->tracerStudy : null;
                        @endphp
                        @if($tracerStudy)
                            <div class="mt-8 border-t border-slate-200 pt-6">
                                <div class="flex justify-between items-center mb-4">
                                    <h4 class="text-lg font-bold text-slate-800">
                                        <i class="fas fa-chart-line"></i> Data Tracer Study
                                    </h4>
                                    <a href="{{ route('tracer.form') }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                </div>
                                
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
                        <div class="flex justify-between items-center mb-4">
                            <h4 class="text-lg font-bold text-slate-800">Data Akademik</h4>
                            <a href="{{ route('student.edit', $user->id) }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-500 text-sm font-semibold">
                                <i class="fas fa-edit"></i> Edit
                            </a>
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
                            <p class="text-sm text-slate-500">Semester</p>
                            <p class="text-lg font-semibold text-slate-800">{{ $data->semester }}</p>
                        </div>
                        <div class="rounded-lg border border-slate-200 p-4">
                            <p class="text-sm text-slate-500">Nomor Telepon</p>
                            <p class="text-lg font-semibold text-slate-800">{{ $data->phone }}</p>
                        </div>
                        <div class="rounded-lg border border-slate-200 p-4">
                            <p class="text-sm text-slate-500">Alamat</p>
                            <p class="text-lg font-semibold text-slate-800">{{ $data->address }}</p>
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

@endsection
