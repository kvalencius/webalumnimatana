@extends('layout.layout_login')

@section('content')
<div class="max-w-2xl mx-auto">
    <h2 class="text-2xl font-bold text-center text-slate-800 mb-2">Edit Data Mahasiswa</h2>
    <p class="text-sm text-slate-600 text-center mb-6">Perbarui informasi profil akademik Anda</p>

    @if($errors->any())
        <div class="mb-4 rounded-lg bg-red-100 p-4 text-sm text-red-800">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('student.update', $student->user_id) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label for="nim" class="block text-sm font-medium text-slate-700">NIM</label>
                <input 
                    id="nim" 
                    name="nim" 
                    type="text" 
                    required 
                    value="{{ old('nim', $student->nim) }}"
                    class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2 text-slate-900 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500" 
                />
            </div>

            <div>
                <label for="major" class="block text-sm font-medium text-slate-700">Program Studi</label>
                <input 
                    id="major" 
                    name="major" 
                    type="text" 
                    required 
                    value="{{ old('major', $student->major) }}"
                    class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2 text-slate-900 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500" 
                />
            </div>

            <div>
                <label for="semester" class="block text-sm font-medium text-slate-700">Semester</label>
                <select 
                    id="semester" 
                    name="semester" 
                    required
                    class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2 text-slate-900 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500"
                >
                    <option value="">-- Pilih --</option>
                    @for($i = 1; $i <= 8; $i++)
                        <option value="{{ $i }}" {{ old('semester', $student->semester) == $i ? 'selected' : '' }}>Semester {{ $i }}</option>
                    @endfor
                </select>
            </div>

            <div>
                <label for="phone" class="block text-sm font-medium text-slate-700">Nomor Telepon</label>
                <input 
                    id="phone" 
                    name="phone" 
                    type="text" 
                    required 
                    value="{{ old('phone', $student->phone) }}"
                    class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2 text-slate-900 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500" 
                />
            </div>

            <div>
                <label for="address" class="block text-sm font-medium text-slate-700">Alamat</label>
                <textarea 
                    id="address" 
                    name="address" 
                    required 
                    rows="4"
                    class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2 text-slate-900 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500"
                >{{ old('address', $student->address) }}</textarea>
            </div>

            <div class="flex gap-3 pt-4">
                <button 
                    type="submit" 
                    class="flex-1 rounded-md bg-indigo-600 px-4 py-2 text-white font-semibold hover:bg-indigo-500 transition"
                >
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
                <a 
                    href="{{ route('profil') }}" 
                    class="flex-1 rounded-md bg-slate-300 px-4 py-2 text-slate-800 font-semibold hover:bg-slate-400 transition text-center"
                >
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>
        </form>
    </div>

    <div class="text-center mt-6">
        <a href="{{ route('profil') }}" class="text-sm text-indigo-600 hover:text-indigo-500">← Kembali ke Profil</a>
    </div>
</div>

@endsection
