@extends('layout.layout_login')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('profil') }}" class="text-indigo-600 hover:text-indigo-500 text-sm">
            <i class="fas fa-arrow-left"></i> Kembali ke Profil
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md p-8">
        <h2 class="text-3xl font-bold text-slate-800 mb-6">Edit Data Alumni</h2>

        @if(session('success'))
            <div class="mb-4 rounded-lg bg-green-100 p-4 text-sm text-green-800">
                {{ session('success') }}
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

        <form action="{{ route('alumni.update', $alumni->user_id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="nim" class="block text-sm font-medium text-slate-700 mb-2">NIM <span class="text-red-500">*</span></label>
                <input type="text" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('nim') border-red-500 @enderror" 
                    id="nim" name="nim" value="{{ old('nim', $alumni->nim) }}" required>
                @error('nim')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-4">
                <label for="graduation_year" class="block text-sm font-medium text-slate-700 mb-2">Tahun Lulus <span class="text-red-500">*</span></label>
                <input type="number" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('graduation_year') border-red-500 @enderror" 
                    id="graduation_year" name="graduation_year" value="{{ old('graduation_year', $alumni->graduation_year) }}" min="2000" max="{{ date('Y') }}" required>
                @error('graduation_year')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-4">
                <label for="major" class="block text-sm font-medium text-slate-700 mb-2">Program Studi <span class="text-red-500">*</span></label>
                <input type="text" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('major') border-red-500 @enderror" 
                    id="major" name="major" value="{{ old('major', $alumni->major) }}" required>
                @error('major')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-4">
                <label for="current_job" class="block text-sm font-medium text-slate-700 mb-2">Status Pekerjaan <span class="text-red-500">*</span></label>
                <select class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('current_job') border-red-500 @enderror" 
                    id="current_job" name="current_job" required onchange="toggleJobFields()">
                    <option value="">-- Pilih Status --</option>
                    <option value="bekerja" {{ old('current_job', $alumni->current_job) === 'bekerja' ? 'selected' : '' }}>Bekerja</option>
                    <option value="tidak_bekerja" {{ old('current_job', $alumni->current_job) === 'tidak_bekerja' ? 'selected' : '' }}>Tidak Bekerja</option>
                    <option value="melanjutkan_studi" {{ old('current_job', $alumni->current_job) === 'melanjutkan_studi' ? 'selected' : '' }}>Melanjutkan Studi</option>
                </select>
                @error('current_job')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-4" id="company_name_div" style="display: {{ $alumni->current_job === 'bekerja' ? 'block' : 'none' }};">
                <label for="company_name" class="block text-sm font-medium text-slate-700 mb-2">Nama Perusahaan</label>
                <input type="text" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('company_name') border-red-500 @enderror" 
                    id="company_name" name="company_name" value="{{ old('company_name', $alumni->company_name) }}">
                @error('company_name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-4" id="job_position_div" style="display: {{ $alumni->current_job === 'bekerja' ? 'block' : 'none' }};">
                <label for="job_position" class="block text-sm font-medium text-slate-700 mb-2">Posisi Pekerjaan</label>
                <input type="text" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('job_position') border-red-500 @enderror" 
                    id="job_position" name="job_position" value="{{ old('job_position', $alumni->job_position) }}">
                @error('job_position')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-4">
                <label for="phone" class="block text-sm font-medium text-slate-700 mb-2">Nomor Telepon <span class="text-red-500">*</span></label>
                <input type="text" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('phone') border-red-500 @enderror" 
                    id="phone" name="phone" value="{{ old('phone', $alumni->phone) }}" required>
                @error('phone')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-6">
                <label for="salary_range" class="block text-sm font-medium text-slate-700 mb-2">Rentang Gaji</label>
                <input type="text" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('salary_range') border-red-500 @enderror" 
                    id="salary_range" name="salary_range" value="{{ old('salary_range', $alumni->salary_range) }}" placeholder="Contoh: 5-10 juta">
                @error('salary_range')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="flex gap-3">
                <a href="{{ route('profil') }}" class="px-6 py-2 bg-slate-300 text-slate-800 rounded-lg hover:bg-slate-400 font-medium">Batal</a>
                <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-500 font-medium">Simpan Perubahan</button>
            </div>
        </form>
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
    } else {
        companyDiv.style.display = 'none';
        positionDiv.style.display = 'none';
    }
}
</script>
@endsection
