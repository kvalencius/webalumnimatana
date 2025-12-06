@extends('layout.layout_login')

@section('content')
<h2 class="text-2xl font-bold text-center text-slate-800 mb-6">Profil</h2>
<div class="space-y-4">
    <div class="rounded-lg border border-slate-200 p-4 bg-slate-50">
        <p class="text-sm text-slate-500">Nama</p>
        <p class="text-lg font-semibold text-slate-800">{{ $user->name }}</p>
    </div>
    <div class="rounded-lg border border-slate-200 p-4 bg-slate-50">
        <p class="text-sm text-slate-500">Email</p>
        <p class="text-lg font-semibold text-slate-800">{{ $user->email }}</p>
    </div>
    <div class="flex items-center justify-between">
        <a href="{{ url('/') }}" class="text-sm text-indigo-600 hover:text-indigo-500">Kembali ke beranda</a>
        <a href="{{ url('/logout') }}" class="text-sm font-semibold text-rose-600 hover:text-rose-500">Logout</a>
    </div>
</div>
@endsection
