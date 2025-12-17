@extends('layout.layout_login')

@section('content')
<h2 class="text-2xl font-bold text-center text-slate-800 mb-6">Data Alumni</h2>
<p class="text-sm text-slate-600 text-center mb-4">Lengkapi data tracer study Anda</p>

@if($errors->any())
    <div class="mb-4 rounded-lg bg-red-100 p-3 text-sm text-red-800">
        <ul class="list-disc list-inside">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('alumni.store') }}" method="POST" class="space-y-4">
    @csrf
    <div>
        <label for="nim" class="block text-sm font-medium text-slate-700">NIM</label>
        <input id="nim" name="nim" type="text" required value="{{ old('nim') }}"
            class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2 text-slate-900" />
    </div>
    <div>
        <label for="graduation_year" class="block text-sm font-medium text-slate-700">Tahun Lulus</label>
        <input id="graduation_year" name="graduation_year" type="number" required value="{{ old('graduation_year') }}"
            class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2 text-slate-900" />
    </div>
    <div>
        <label for="major" class="block text-sm font-medium text-slate-700">Program Studi</label>
        <input id="major" name="major" type="text" required value="{{ old('major') }}"
            class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2 text-slate-900" />
    </div>
    <div>
        <label for="current_job" class="block text-sm font-medium text-slate-700">Status Pekerjaan</label>
        <select id="current_job" name="current_job" required onchange="toggleJobFields()"
            class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2 text-slate-900">
            <option value="">-- Pilih --</option>
            <option value="bekerja" {{ old('current_job') === 'bekerja' ? 'selected' : '' }}>Bekerja</option>
            <option value="tidak_bekerja" {{ old('current_job') === 'tidak_bekerja' ? 'selected' : '' }}>Tidak Bekerja</option>
            <option value="melanjutkan_studi" {{ old('current_job') === 'melanjutkan_studi' ? 'selected' : '' }}>Melanjutkan Studi</option>
        </select>
    </div>
    <div id="job-fields" class="space-y-4" style="{{ old('current_job') === 'bekerja' ? '' : 'display: none;' }}">
        <div>
            <label for="company_name" class="block text-sm font-medium text-slate-700">Nama Perusahaan</label>
            <input id="company_name" name="company_name" type="text" value="{{ old('company_name') }}"
                class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2 text-slate-900" />
        </div>
        <div>
            <label for="job_position" class="block text-sm font-medium text-slate-700">Posisi Pekerjaan</label>
            <input id="job_position" name="job_position" type="text" value="{{ old('job_position') }}"
                class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2 text-slate-900" />
        </div>
        <div>
            <label for="salary_range" class="block text-sm font-medium text-slate-700">Range Gaji (Opsional)</label>
            <input id="salary_range" name="salary_range" type="text" placeholder="Contoh: 5-10 juta" value="{{ old('salary_range') }}"
                class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2 text-slate-900" />
        </div>
    </div>
    <div>
        <label for="phone" class="block text-sm font-medium text-slate-700">Nomor Telepon</label>
        <input id="phone" name="phone" type="text" required value="{{ old('phone') }}"
            class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2 text-slate-900" />
    </div>
    <button type="submit" class="w-full rounded-md bg-indigo-600 px-4 py-2 text-white font-semibold hover:bg-indigo-500">
        Simpan Data
    </button>
</form>

<script>
function toggleJobFields() {
    const jobStatus = document.getElementById('current_job').value;
    const jobFields = document.getElementById('job-fields');
    if (jobStatus === 'bekerja') {
        jobFields.style.display = 'block';
    } else {
        jobFields.style.display = 'none';
    }
}
</script>
@endsection