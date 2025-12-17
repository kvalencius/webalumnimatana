@extends('layout.layout_login')

@section('content')
<h2 class="text-2xl font-bold text-center text-slate-800 mb-6">Masuk ke Akun</h2>
@if(session('success'))
	<div class="mb-4 rounded-lg bg-green-100 p-3 text-sm text-green-800">{{ session('success') }}</div>
@endif
@if($errors->any())
	<div class="mb-4 rounded-lg bg-red-100 p-3 text-sm text-red-800">
		<ul class="list-disc list-inside">
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif
<form action="{{ url('/login') }}" method="POST" class="space-y-5">
	@csrf
	<div>
		<label for="email" class="block text-sm font-medium text-slate-700">Email</label>
		<input id="email" name="email" type="email" autocomplete="email" required
			class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2 text-slate-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500" />
	</div>
	<div>
		<div class="flex items-center justify-between mb-1">
			<label for="password" class="block text-sm font-medium text-slate-700">Password</label>
		</div>
		<input id="password" name="password" type="password" autocomplete="current-password" required
			class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2 text-slate-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500" />
	</div>
	<button type="submit" class="w-full rounded-md bg-indigo-600 px-4 py-2 text-white font-semibold shadow hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
		Masuk
	</button>
</form>
<p class="mt-6 text-center text-sm text-slate-600">Belum punya akun? <a href="{{ url('/daftar') }}" class="font-semibold text-indigo-600 hover:text-indigo-500">Daftar</a></p>
@endsection

