<div class="sidebar-brand p-4">
    <h4 class="text-white fw-bold mb-0">ALUMNI MATANA</h4>
</div>

<div class="sidebar-nav">
    <a href="{{ route('admin.dashboard') }}" 
       class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <i class="fas fa-th-large me-3"></i>
        <span>Dashboard</span>
    </a>

    <div class="sidebar-heading">DATA MASTER</div>
    <a href="#" class="nav-link"><i class="fas fa-university me-3"></i><span>Fakultas</span></a>
    <a href="#" class="nav-link"><i class="fas fa-graduation-cap me-3"></i><span>Jurusan</span></a>

    <div class="sidebar-heading">ALUMNI</div>
    <a href="#" class="nav-link {{ request()->is('admin/alumni*') ? 'active' : '' }}">
        <i class="fas fa-users me-3"></i>
        <span>Data Alumni</span>
    </a>

    <div class="sidebar-heading">CONTENT</div>
    <a href="#" class="nav-link"><i class="fas fa-newspaper me-3"></i><span>Berita / Event</span></a>
    
    <a href="{{ route('admin.jobs.index') }}" 
       class="nav-link {{ request()->is('admin/job_vacancies*') ? 'active' : '' }}">
        <i class="fas fa-briefcase me-3"></i>
        <span>Lowongan Kerja</span>
    </a>
</div>

<style>
    .sidebar-heading {
        font-size: 0.7rem;
        font-weight: 800;
        color: rgba(255,255,255,0.4);
        padding: 20px 25px 5px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .nav-link {
        display: flex;
        align-items: center;
        padding: 12px 25px;
        color: rgba(255,255,255,0.8);
        text-decoration: none;
        transition: all 0.3s;
    }
    .nav-link:hover {
        color: #fff;
        background: rgba(255,255,255,0.1);
    }
    /* Warna Biru Terang sesuai UI */
    .nav-link.active {
        background: #00a1e4;
        color: #fff !important; 
        font-weight: 600;
    }
</style>