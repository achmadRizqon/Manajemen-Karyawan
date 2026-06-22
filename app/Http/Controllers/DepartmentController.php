<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Models\Department;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DepartmentController extends Controller
{
    public function index(): View
    {
        $departments = Department::withCount('employees')
            ->orderBy('name')
            ->paginate(10);

        return view('departments.index', compact('departments'));
    }

    public function create(): View
    {
        return view('departments.create');
    }

    public function store(StoreDepartmentRequest $request): RedirectResponse
    {
        Department::create($request->validated());

        return redirect()->route('departments.index')
            ->with('success', 'Department berhasil ditambahkan.');
    }

    public function edit(Department $department): View
    {
        return view('departments.edit', compact('department'));
    }

    public function update(UpdateDepartmentRequest $request, Department $department): RedirectResponse
    {
        $department->update($request->validated());

        return redirect()->route('departments.index')
            ->with('success', 'Department berhasil diubah.');
    }

    public function destroy(Department $department): RedirectResponse
    {
        if ($department->employees()->count() > 0) {
            return redirect()->route('departments.index')
                ->with('error', "Department \"{$department->name}\" tidak dapat dihapus karena masih memiliki karyawan.");
        }

        $department->delete();

        return redirect()->route('departments.index')
            ->with('success', 'Department berhasil dihapus.');
    }
}
