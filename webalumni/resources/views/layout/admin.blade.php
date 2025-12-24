<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Web Alumni Matana</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f4f7f6; }
        .sidebar { width: 250px; height: 100vh; background: #002d72; color: white; position: fixed; }
        .sidebar a { color: rgba(255,255,255,0.8); text-decoration: none; padding: 12px 20px; display: block; }
        .sidebar a:hover, .sidebar a.active { background: #00a1e4; color: white; }
        .main-content { margin-left: 250px; padding: 30px; }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="p-4 text-center">
            <h5 class="fw-bold">ALUMNI MATANA</h5>
            <hr>
        </div>
        
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-home me-2"></i> Dashboard
        </a>

        <div class="px-3 py-2 small text-uppercase opacity-50">Data Master</div>
        <a href="{{ route('admin.majors.index') }}" class="{{ request()->routeIs('admin.majors.*') ? 'active' : '' }}">
            <i class="fas fa-graduation-cap me-2"></i> Jurusan
        </a>

        <div class="px-3 py-2 small text-uppercase opacity-50">Content</div>
        <a href="{{ route('admin.jobs.index') }}" class="{{ request()->routeIs('admin.jobs.*') ? 'active' : '' }}">
            <i class="fas fa-briefcase me-2"></i> Lowongan Kerja
        </a>
        
        <a href="{{ route('logout') }}" class="mt-auto text-danger">
            <i class="fas fa-sign-out-alt me-2"></i> Logout
        </a>
    </div>

    <div class="main-content">
        {{-- Area ini akan diisi oleh konten dari index.blade.php --}}
        @yield('admin_content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>