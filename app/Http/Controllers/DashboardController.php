<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalDepartments = Department::count();
        $totalEmployees   = Employee::count();
        $latestEmployees  = Employee::with('department')->latest()->take(5)->get();
        $deptStats        = Department::withCount('employees')->orderByDesc('employees_count')->get();

        return view('dashboard.index', compact(
            'totalDepartments',
            'totalEmployees',
            'latestEmployees',
            'deptStats'
        ));
    }
}
