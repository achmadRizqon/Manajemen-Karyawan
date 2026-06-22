<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Employee Management System')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --ems-primary: #1a56db;
            --ems-sidebar: #0f172a;
            --ems-sidebar-hover: #1e293b;
        }

        body {
            background-color: #f1f5f9;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }

        /* Navbar */
        .navbar-brand {
            font-weight: 700;
            letter-spacing: -0.5px;
        }
        .navbar-brand .brand-dot {
            color: #60a5fa;
        }
        .nav-link.active {
            background: rgba(255,255,255,0.15);
            border-radius: 6px;
        }

        /* Sidebar */
        .sidebar {
            width: 240px;
            min-height: 100vh;
            background: var(--ems-sidebar);
            position: fixed;
            top: 56px;
            left: 0;
            z-index: 100;
            padding-top: 1rem;
        }
        .sidebar .nav-link {
            color: #94a3b8;
            padding: 0.65rem 1.25rem;
            border-radius: 6px;
            margin: 0 0.75rem 2px;
            font-size: 0.9rem;
            transition: all .15s;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: var(--ems-sidebar-hover);
            color: #f8fafc;
        }
        .sidebar .nav-link .bi {
            width: 20px;
            text-align: center;
        }
        .sidebar-label {
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: #475569;
            padding: 0.5rem 1.25rem 0.25rem;
            margin: 0.5rem 0 0;
        }

        /* Main content */
        .main-content {
            margin-left: 240px;
            padding: 1.75rem;
        }

        /* Cards */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,.08), 0 1px 2px rgba(0,0,0,.05);
        }
        .card-header {
            background: white;
            border-bottom: 1px solid #e2e8f0;
            border-radius: 12px 12px 0 0 !important;
            padding: 1rem 1.25rem;
        }

        /* Stat cards */
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 1px 3px rgba(0,0,0,.08);
        }
        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
        }

        /* Table */
        .table th {
            font-size: 0.78rem;
            font-weight: 600;
            letter-spacing: .04em;
            text-transform: uppercase;
            color: #64748b;
            border-bottom: 2px solid #e2e8f0;
            padding: 0.75rem 1rem;
        }
        .table td {
            padding: 0.75rem 1rem;
            vertical-align: middle;
            font-size: 0.9rem;
            color: #334155;
        }
        .table tbody tr:hover {
            background-color: #f8fafc;
        }

        /* Badges */
        .dept-badge {
            font-size: 0.75rem;
            padding: 0.3em 0.7em;
            border-radius: 6px;
            font-weight: 500;
        }

        /* Sort arrows */
        .sort-link {
            color: inherit;
            text-decoration: none;
        }
        .sort-link:hover { color: var(--ems-primary); }

        /* Buttons */
        .btn-primary { background: var(--ems-primary); border-color: var(--ems-primary); }
        .btn-primary:hover { background: #1648c0; border-color: #1648c0; }

        /* Alert */
        .alert { border: none; border-radius: 10px; font-size: 0.9rem; }

        /* Page header */
        .page-header {
            margin-bottom: 1.5rem;
        }
        .page-header h1 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #0f172a;
            margin: 0;
        }
        .breadcrumb {
            font-size: 0.8rem;
            margin: 0;
        }

        /* Pagination */
        .pagination .page-link { border-radius: 6px !important; margin: 0 1px; border: 1px solid #e2e8f0; color: #475569; }
        .pagination .page-item.active .page-link { background: var(--ems-primary); border-color: var(--ems-primary); }
    </style>
</head>
<body>

{{-- Top Navbar --}}
<nav class="navbar navbar-expand navbar-dark bg-dark px-3" style="height:56px;">
    <a class="navbar-brand me-4" href="{{ route('dashboard') }}">
        <i class="bi bi-people-fill me-1"></i>Management<span class="brand-dot">Karyawan.</span>
    </a>
    <div class="navbar-nav ms-auto">
        <span class="navbar-text text-secondary small">
            <i class="bi bi-circle-fill text-success me-1" style="font-size:.5rem;"></i>
            Online
        </span>
    </div>
</nav>

{{-- Sidebar --}}
<div class="sidebar">
    <div class="sidebar-label">Menu</div>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('dashboard*') ? 'active' : '' }}"
               href="{{ route('dashboard') }}">
                <i class="bi bi-grid-1x2-fill me-2"></i> Dashboard
            </a>
        </li>
    </ul>

    <div class="sidebar-label mt-2">Data Master</div>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('departments*') ? 'active' : '' }}"
               href="{{ route('departments.index') }}">
                <i class="bi bi-diagram-3-fill me-2"></i> Department
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('employees*') ? 'active' : '' }}"
               href="{{ route('employees.index') }}">
                <i class="bi bi-person-badge-fill me-2"></i> Karyawan
            </a>
        </li>
    </ul>
</div>

{{-- Main Content --}}
<div class="main-content">

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
