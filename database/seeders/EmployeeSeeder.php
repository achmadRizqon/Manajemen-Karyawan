<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        $departments = Department::all();

        $employees = [
            ['employee_code' => 'EMP001', 'name' => 'Budi Santoso',     'email' => 'budi.santoso@company.com',     'phone' => '081234567890'],
            ['employee_code' => 'EMP002', 'name' => 'Siti Rahayu',      'email' => 'siti.rahayu@company.com',      'phone' => '081234567891'],
            ['employee_code' => 'EMP003', 'name' => 'Ahmad Fauzi',      'email' => 'ahmad.fauzi@company.com',      'phone' => '081234567892'],
            ['employee_code' => 'EMP004', 'name' => 'Dewi Lestari',     'email' => 'dewi.lestari@company.com',     'phone' => '081234567893'],
            ['employee_code' => 'EMP005', 'name' => 'Rudi Hartono',     'email' => 'rudi.hartono@company.com',     'phone' => '081234567894'],
            ['employee_code' => 'EMP006', 'name' => 'Rina Wati',        'email' => 'rina.wati@company.com',        'phone' => '081234567895'],
            ['employee_code' => 'EMP007', 'name' => 'Hendra Kusuma',    'email' => 'hendra.kusuma@company.com',    'phone' => '081234567896'],
            ['employee_code' => 'EMP008', 'name' => 'Maya Indah',       'email' => 'maya.indah@company.com',       'phone' => '081234567897'],
            ['employee_code' => 'EMP009', 'name' => 'Doni Pratama',     'email' => 'doni.pratama@company.com',     'phone' => '081234567898'],
            ['employee_code' => 'EMP010', 'name' => 'Fitri Andriani',   'email' => 'fitri.andriani@company.com',   'phone' => '081234567899'],
            ['employee_code' => 'EMP011', 'name' => 'Galih Setiawan',   'email' => 'galih.setiawan@company.com',   'phone' => '082234567890'],
            ['employee_code' => 'EMP012', 'name' => 'Indah Permata',    'email' => 'indah.permata@company.com',    'phone' => '082234567891'],
            ['employee_code' => 'EMP013', 'name' => 'Joko Widodo',      'email' => 'joko.widodo@company.com',      'phone' => '082234567892'],
            ['employee_code' => 'EMP014', 'name' => 'Kartini Sari',     'email' => 'kartini.sari@company.com',     'phone' => '082234567893'],
            ['employee_code' => 'EMP015', 'name' => 'Lukman Hakim',     'email' => 'lukman.hakim@company.com',     'phone' => '082234567894'],
            ['employee_code' => 'EMP016', 'name' => 'Melinda Putri',    'email' => 'melinda.putri@company.com',    'phone' => '082234567895'],
            ['employee_code' => 'EMP017', 'name' => 'Nanang Surya',     'email' => 'nanang.surya@company.com',     'phone' => '082234567896'],
            ['employee_code' => 'EMP018', 'name' => 'Oktavia Ningrum',  'email' => 'oktavia.ningrum@company.com',  'phone' => '082234567897'],
            ['employee_code' => 'EMP019', 'name' => 'Prasetyo Adi',     'email' => 'prasetyo.adi@company.com',     'phone' => '082234567898'],
            ['employee_code' => 'EMP020', 'name' => 'Qori Amaliah',     'email' => 'qori.amaliah@company.com',     'phone' => '082234567899'],
            ['employee_code' => 'EMP021', 'name' => 'Rizky Ramadhan',   'email' => 'rizky.ramadhan@company.com',   'phone' => '083234567890'],
            ['employee_code' => 'EMP022', 'name' => 'Sri Wahyuni',      'email' => 'sri.wahyuni@company.com',      'phone' => '083234567891'],
            ['employee_code' => 'EMP023', 'name' => 'Teguh Purnomo',    'email' => 'teguh.purnomo@company.com',    'phone' => '083234567892'],
            ['employee_code' => 'EMP024', 'name' => 'Ulfa Nuraini',     'email' => 'ulfa.nuraini@company.com',     'phone' => '083234567893'],
            ['employee_code' => 'EMP025', 'name' => 'Wahyu Hidayat',    'email' => 'wahyu.hidayat@company.com',    'phone' => '083234567894'],
        ];

        foreach ($employees as $i => $data) {
            Employee::firstOrCreate(
                ['employee_code' => $data['employee_code']],
                array_merge($data, [
                    'department_id' => $departments[$i % $departments->count()]->id,
                ])
            );
        }
    }
}
