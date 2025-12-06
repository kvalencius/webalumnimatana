@extends('layout.layout_login')

@section('content')
<h2 class="text-2xl font-bold text-center text-slate-800 mb-6">Daftar Akun Baru</h2>
@if($errors->any())
    <div class="mb-4 rounded-lg bg-red-100 p-3 text-sm text-red-800">
        <ul class="list-disc list-inside">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ url('/daftar') }}" method="POST" class="space-y-5">
    @csrf
    <div>
        <label for="name" class="block text-sm font-medium text-slate-700">Nama</label>
        <input id="name" name="name" type="text" required
            class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2 text-slate-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500" />
    </div>
    <div>
        <label for="email" class="block text-sm font-medium text-slate-700">Email</label>
        <input id="email" name="email" type="email" autocomplete="email" required
            class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2 text-slate-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500" />
    </div>
    <div>
        <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
        <input id="password" name="password" type="password" required
            class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2 text-slate-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500" />
    </div>
    <div>
        <label for="password_confirmation" class="block text-sm font-medium text-slate-700">Konfirmasi Password</label>
        <input id="password_confirmation" name="password_confirmation" type="password" required
            class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2 text-slate-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500" />
    </div>
    <button type="submit" class="w-full rounded-md bg-indigo-600 px-4 py-2 text-white font-semibold shadow hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
        Daftar
    </button>
</form>
<p class="mt-6 text-center text-sm text-slate-600">Sudah punya akun? <a href="{{ url('/login') }}" class="font-semibold text-indigo-600 hover:text-indigo-500">Masuk</a></p>
@endsection
