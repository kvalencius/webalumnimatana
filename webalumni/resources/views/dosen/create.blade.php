@extends('layout.layout_login')

@section('content')
<h2 class="text-2xl font-bold text-center text-slate-800 mb-6">Data Dosen</h2>
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

<form action="{{ route('teacher.store') }}" method="POST" class="space-y-4">
    @csrf
    <div>
        <label for="nip" class="block text-sm font-medium text-slate-700">NIP</label>
        <input id="nip" name="nip" type="text" required value="{{ old('nip') }}"
            class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2 text-slate-900" />
    </div>
    <div>
        <label for="department" class="block text-sm font-medium text-slate-700">Departemen/Jurusan</label>
        <input id="department" name="department" type="text" required value="{{ old('department') }}"
            class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2 text-slate-900" />
    </div>
    <div>
        <label for="phone" class="block text-sm font-medium text-slate-700">Nomor Telepon</label>
        <input id="phone" name="phone" type="text" required value="{{ old('phone') }}"
            class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2 text-slate-900" />
    </div>
    <div>
        <label for="office" class="block text-sm font-medium text-slate-700">Ruang Kantor</label>
        <input id="office" name="office" type="text" required value="{{ old('office') }}"
            class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2 text-slate-900" />
    </div>
    <div>
        <label for="specialization" class="block text-sm font-medium text-slate-700">Keahlian/Spesialisasi</label>
        <input id="specialization" name="specialization" type="text" required value="{{ old('specialization') }}"
            class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2 text-slate-900" />
    </div>
    <button type="submit" class="w-full rounded-md bg-indigo-600 px-4 py-2 text-white font-semibold hover:bg-indigo-500">
        Simpan Data
    </button>
</form>
@endsection
