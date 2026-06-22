@extends('layouts.app')

@section('title', 'Department — EMS')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h1>Department</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Department</li>
            </ol>
        </nav>
    </div>
    <a href="{{ route('departments.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i> Tambah Department
    </a>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-semibold">Daftar Department</h6>
        <span class="badge bg-primary rounded-pill">{{ $departments->total() }} total</span>
    </div>
    <div class="card-body p-0">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th style="width:60px;">No</th>
                    <th>Nama Department</th>
                    <th>Jumlah Karyawan</th>
                    <th style="width:140px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($departments as $dept)
                <tr>
                    <td class="text-muted">{{ $departments->firstItem() + $loop->index }}</td>
                    <td class="fw-medium">
                        <i class="bi bi-diagram-3 me-2 text-primary"></i>{{ $dept->name }}
                    </td>
                    <td>
                        @if($dept->employees_count > 0)
                            <span class="dept-badge" style="background:#ecfdf5;color:#059669;">
                                {{ $dept->employees_count }} karyawan
                            </span>
                        @else
                            <span class="text-muted small">Belum ada karyawan</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('departments.edit', $dept) }}"
                           class="btn btn-sm btn-outline-primary me-1">
                            <i class="bi bi-pencil-fill"></i>
                        </a>
                        <button type="button"
                                class="btn btn-sm btn-outline-danger"
                                data-bs-toggle="modal"
                                data-bs-target="#deleteModal"
                                data-id="{{ $dept->id }}"
                                data-name="{{ $dept->name }}"
                                data-count="{{ $dept->employees_count }}">
                            <i class="bi bi-trash-fill"></i>
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-5 text-muted">
                        <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                        Belum ada data department.
                        <a href="{{ route('departments.create') }}">Tambah sekarang</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($departments->hasPages())
    <div class="card-footer bg-white border-top d-flex justify-content-between align-items-center">
        <span class="text-muted small">
            Menampilkan {{ $departments->firstItem() }}–{{ $departments->lastItem() }}
            dari {{ $departments->total() }} data
        </span>
        {{ $departments->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>

{{-- Delete Confirmation Modal --}}
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-danger">
                    <i class="bi bi-exclamation-triangle me-2"></i>Hapus Department
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="modalBody">
                <p class="mb-0">Yakin ingin menghapus department <strong id="deptName"></strong>?</p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" id="deleteBtn">
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
    const btn   = e.relatedTarget;
    const id    = btn.dataset.id;
    const name  = btn.dataset.name;
    const count = parseInt(btn.dataset.count);

    document.getElementById('deptName').textContent = name;
    const body   = document.getElementById('modalBody');
    const delBtn = document.getElementById('deleteBtn');

    if (count > 0) {
        body.innerHTML = `
            <div class="alert alert-warning mb-0">
                <i class="bi bi-exclamation-circle me-2"></i>
                Department <strong>${name}</strong> tidak dapat dihapus karena masih memiliki
                <strong>${count} karyawan</strong>.
            </div>`;
        delBtn.disabled = true;
    } else {
        body.innerHTML = `<p class="mb-0">Yakin ingin menghapus department <strong>${name}</strong>? Tindakan ini tidak dapat dibatalkan.</p>`;
        delBtn.disabled = false;
        document.getElementById('deleteForm').action = `/departments/${id}`;
    }
});
</script>
@endpush
