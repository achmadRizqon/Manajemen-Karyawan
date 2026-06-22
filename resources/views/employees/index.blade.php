@extends('layouts.app')

@section('title', 'Karyawan — EMS')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h1>Karyawan</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Karyawan</li>
            </ol>
        </nav>
    </div>
    <a href="{{ route('employees.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i> Tambah Karyawan
    </a>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
        <h6 class="mb-0 fw-semibold">Daftar Karyawan</h6>
        {{-- Search Form --}}
        <form action="{{ route('employees.index') }}" method="GET" class="d-flex gap-2">
            @if(request('sort')) <input type="hidden" name="sort" value="{{ request('sort') }}"> @endif
            @if(request('dir'))  <input type="hidden" name="dir"  value="{{ request('dir') }}">  @endif
            <div class="input-group" style="width:280px;">
                <span class="input-group-text bg-white border-end-0">
                    <i class="bi bi-search text-muted small"></i>
                </span>
                <input type="text"
                       name="search"
                       class="form-control border-start-0 ps-0"
                       placeholder="Cari kode, nama, email…"
                       value="{{ $search }}">
                @if($search)
                    <a href="{{ route('employees.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-x"></i>
                    </a>
                @endif
            </div>
            <button type="submit" class="btn btn-outline-primary">Cari</button>
        </form>
    </div>

    @if($search)
    <div class="px-4 pt-3 pb-0">
        <p class="text-muted small mb-0">
            Hasil pencarian untuk <strong>"{{ $search }}"</strong>
            — {{ $employees->total() }} data ditemukan.
        </p>
    </div>
    @endif

    <div class="card-body p-0">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th style="width:60px;">No</th>
                    <th>
                        @php
                            $codeDir = ($sortField === 'employee_code' && $sortDir === 'asc') ? 'desc' : 'asc';
                        @endphp
                        <a href="{{ route('employees.index', array_merge(request()->query(), ['sort' => 'employee_code', 'dir' => $codeDir])) }}"
                           class="sort-link">
                            Kode Karyawan
                            @if($sortField === 'employee_code')
                                <i class="bi bi-arrow-{{ $sortDir === 'asc' ? 'up' : 'down' }}-short"></i>
                            @else
                                <i class="bi bi-arrow-down-up text-muted" style="font-size:.75em;"></i>
                            @endif
                        </a>
                    </th>
                    <th>
                        @php
                            $nameDir = ($sortField === 'name' && $sortDir === 'asc') ? 'desc' : 'asc';
                        @endphp
                        <a href="{{ route('employees.index', array_merge(request()->query(), ['sort' => 'name', 'dir' => $nameDir])) }}"
                           class="sort-link">
                            Nama
                            @if($sortField === 'name')
                                <i class="bi bi-arrow-{{ $sortDir === 'asc' ? 'up' : 'down' }}-short"></i>
                            @else
                                <i class="bi bi-arrow-down-up text-muted" style="font-size:.75em;"></i>
                            @endif
                        </a>
                    </th>
                    <th>Email</th>
                    <th>No HP</th>
                    <th>Department</th>
                    <th style="width:120px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($employees as $emp)
                <tr>
                    <td class="text-muted">{{ $employees->firstItem() + $loop->index }}</td>
                    <td>
                        <code class="bg-light px-2 py-1 rounded small">{{ $emp->employee_code }}</code>
                    </td>
                    <td class="fw-medium">{{ $emp->name }}</td>
                    <td class="text-muted small">{{ $emp->email }}</td>
                    <td class="text-muted small">{{ $emp->phone }}</td>
                    <td>
                        <span class="dept-badge" style="background:#eff6ff;color:#1a56db;">
                            {{ $emp->department?->name ?? '—' }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('employees.edit', $emp) }}"
                           class="btn btn-sm btn-outline-primary me-1">
                            <i class="bi bi-pencil-fill"></i>
                        </a>
                        <button type="button"
                                class="btn btn-sm btn-outline-danger"
                                data-bs-toggle="modal"
                                data-bs-target="#deleteModal"
                                data-id="{{ $emp->id }}"
                                data-name="{{ $emp->name }}">
                            <i class="bi bi-trash-fill"></i>
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-5 text-muted">
                        <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                        @if($search)
                            Tidak ada karyawan yang cocok dengan "{{ $search }}".
                        @else
                            Belum ada data karyawan.
                            <a href="{{ route('employees.create') }}">Tambah sekarang</a>
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($employees->hasPages())
    <div class="card-footer bg-white border-top d-flex justify-content-between align-items-center">
        <span class="text-muted small">
            Menampilkan {{ $employees->firstItem() }}–{{ $employees->lastItem() }}
            dari {{ $employees->total() }} data
        </span>
        {{ $employees->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>

{{-- Delete Modal --}}
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-danger">
                    <i class="bi bi-exclamation-triangle me-2"></i>Hapus Karyawan
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="mb-0">Yakin ingin menghapus karyawan <strong id="empName"></strong>?
                Tindakan ini tidak dapat dibatalkan.</p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash me-1"></i> Ya, Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('deleteModal').addEventListener('show.bs.modal', function (e) {
    const btn  = e.relatedTarget;
    document.getElementById('empName').textContent = btn.dataset.name;
    document.getElementById('deleteForm').action    = `/employees/${btn.dataset.id}`;
});
</script>
@endpush
