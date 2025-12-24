<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Alumni')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        body {
            min-height: 100vh;
            background-color: #f4f6f9;
        }
        .sidebar {
            width: 250px;
            background: #1f2937;
            color: #fff;
            position: fixed;
            top: 0;
            bottom: 0;
            padding-top: 60px;
        }
        .sidebar a {
            color: #cbd5e1;
            padding: 12px 20px;
            display: block;
            text-decoration: none;
        }
        .sidebar a:hover {
            background: #374151;
            color: #fff;
        }
        .navbar {
            height: 60px;
            background: #111827;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
            padding-top: 80px;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-dark fixed-top">
    <div class="container-fluid">
        <span class="navbar-brand">Admin Alumni</span>
        <div class="text-white">
            Admin
            <a href="/logout" class="btn btn-sm btn-danger ms-3">Logout</a>
        </div>
    </div>
</nav>

<!-- Sidebar -->
<div class="sidebar">
    <a href="/admin/dashboard">Dashboard</a>
    <a href="/admin/students">Data Mahasiswa</a>
    <a href="/admin/alumni">Data Alumni</a>
    <a href="/admin/users">Manajemen User</a>
    <a href="/admin/reports">Laporan</a>
</div>

<!-- Content -->
<div class="content">
    @yield('content')
</div>

</body>
</html>
