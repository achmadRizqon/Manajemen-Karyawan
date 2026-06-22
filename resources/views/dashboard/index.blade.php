@extends('layouts.app')

@section('title', 'Dashboard — EMS')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h1>Dashboard</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Overview</li>
            </ol>
        </nav>
    </div>
    <span class="text-muted small">{{ now()->isoFormat('dddd, D MMMM Y') }}</span>
</div>

{{-- Stat Cards --}}
<div class="row g-3 mb-4">
    <div class="col-md-6 col-lg-3">
        <div class="stat-card">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <p class="text-muted small mb-1">Total Department</p>
                    <h2 class="fw-bold mb-0" style="color:#1a56db;">{{ $totalDepartments }}</h2>
                </div>
                <div class="stat-icon" style="background:#eff6ff;">
                    <i class="bi bi-diagram-3-fill" style="color:#1a56db;"></i>
                </div>
            </div>
            <a href="{{ route('departments.index') }}" class="text-decoration-none small text-primary">
                Lihat semua <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="stat-card">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <p class="text-muted small mb-1">Total Karyawan</p>
                    <h2 class="fw-bold mb-0" style="color:#0891b2;">{{ $totalEmployees }}</h2>
                </div>
                <div class="stat-icon" style="background:#ecfeff;">
                    <i class="bi bi-people-fill" style="color:#0891b2;"></i>
                </div>
            </div>
            <a href="{{ route('employees.index') }}" class="text-decoration-none small" style="color:#0891b2;">
                Lihat semua <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="stat-card">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <p class="text-muted small mb-1">Rata-rata per Dept.</p>
                    <h2 class="fw-bold mb-0" style="color:#7c3aed;">
                        {{ $totalDepartments > 0 ? number_format($totalEmployees / $totalDepartments, 1) : 0 }}
                    </h2>
                </div>
                <div class="stat-icon" style="background:#f5f3ff;">
                    <i class="bi bi-graph-up" style="color:#7c3aed;"></i>
                </div>
            </div>
            <span class="text-muted small">Karyawan per department</span>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="stat-card">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <p class="text-muted small mb-1">Dept. Terbesar</p>
                    <h2 class="fw-bold mb-0 fs-5" style="color:#059669;">
                        {{ $deptStats->first()?->name ?? '-' }}
                    </h2>
                </div>
                <div class="stat-icon" style="background:#ecfdf5;">
                    <i class="bi bi-award-fill" style="color:#059669;"></i>
                </div>
            </div>
            <span class="text-muted small">{{ $deptStats->first()?->employees_count ?? 0 }} karyawan</span>
        </div>
    </div>
</div>

<div class="row g-3">
    {{-- Department Distribution --}}
    <div class="col-lg-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-semibold">Distribusi per Department</h6>
            </div>
            <div class="card-body p-0">
                @foreach($deptStats as $dept)
                    @php
                        $pct = $totalEmployees > 0 ? ($dept->employees_count / $totalEmployees * 100) : 0;
                        $colors = ['#1a56db','#0891b2','#7c3aed','#059669','#d97706'];
                        $color  = $colors[$loop->index % count($colors)];
                    @endphp
                    <div class="px-4 py-3 {{ !$loop->last ? 'border-bottom' : '' }}">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="fw-medium small">{{ $dept->name }}</span>
                            <span class="small text-muted">{{ $dept->employees_count }} orang</span>
                        </div>
                        <div class="progress" style="height:6px;border-radius:4px;">
                            <div class="progress-bar" style="width:{{ $pct }}%;background:{{ $color }};border-radius:4px;"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Latest Employees --}}
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-semibold">Karyawan Terbaru</h6>
                <a href="{{ route('employees.index') }}" class="btn btn-sm btn-outline-primary">
                    Lihat Semua
                </a>
            </div>
            <div class="card-body p-0">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Department</th>
                            <th>Bergabung</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($latestEmployees as $emp)
                        <tr>
                            <td><code class="bg-light px-2 py-1 rounded small">{{ $emp->employee_code }}</code></td>
                            <td class="fw-medium">{{ $emp->name }}</td>
                            <td>
                                <span class="dept-badge" style="background:#eff6ff;color:#1a56db;">
                                    {{ $emp->department?->name }}
                                </span>
                            </td>
                            <td class="text-muted small">{{ $emp->created_at->diffForHumans() }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">
                                Belum ada karyawan
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
