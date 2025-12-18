@extends('layout.layout_login')

@section('content')
<h2 class="text-2xl font-bold text-center text-slate-800 mb-6">Data Mahasiswa</h2>
<p class="text-sm text-slate-600 text-center mb-4">Lengkapi data profil akademik Anda</p>

@if($errors->any())
    <div class="mb-4 rounded-lg bg-red-100 p-3 text-sm text-red-800">
        <ul class="list-disc list-inside">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('student.store') }}" method="POST" class="space-y-4">
    @csrf
    <div>
        <label for="nim" class="block text-sm font-medium text-slate-700">NIM</label>
        <input id="nim" name="nim" type="text" required value="{{ old('nim') }}"
            class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2 text-slate-900" />
    </div>
    <div>
        <label for="major" class="block text-sm font-medium text-slate-700">Program Studi</label>
        <input id="major" name="major" type="text" required value="{{ old('major') }}"
            class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2 text-slate-900" />
    </div>
    <div>
        <label for="semester" class="block text-sm font-medium text-slate-700">Semester</label>
        <select id="semester" name="semester" required
            class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2 text-slate-900">
            <option value="">-- Pilih --</option>
            @for($i = 1; $i <= 8; $i++)
                <option value="{{ $i }}" {{ old('semester') == $i ? 'selected' : '' }}>Semester {{ $i }}</option>
            @endfor
        </select>
    </div>
    <div>
        <label for="phone" class="block text-sm font-medium text-slate-700">Nomor Telepon</label>
        <input id="phone" name="phone" type="text" required value="{{ old('phone') }}"
            class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2 text-slate-900" />
    </div>
    <div>
        <label for="address" class="block text-sm font-medium text-slate-700">Alamat</label>
        <textarea id="address" name="address" required rows="3"
            class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2 text-slate-900">{{ old('address') }}</textarea>
    </div>
    <button type="submit" class="w-full rounded-md bg-indigo-600 px-4 py-2 text-white font-semibold hover:bg-indigo-500">
        Simpan Data
    </button>
</form>
@endsection
