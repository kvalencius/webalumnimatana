@extends('layout.admin.admin')

@section('title', 'Dashboard Admin')

@section('content')
<h1 class="mb-4">Dashboard</h1>

<div class="row">
    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-body">
                <h5>Total Mahasiswa</h5>
                <h2>120</h2>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-body">
                <h5>Total Alumni</h5>
                <h2>85</h2>
            </div>
        </div>
    </div>
</div>
@endsection
