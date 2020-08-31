<?php

namespace App\Http\Controllers\Admin;

use App\Department;
use App\Employee;
use App\Http\Controllers\Controller;
use App\Leave;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    public function index() {
        $leaves = Leave::all();
        $leaves = $leaves->map(function($leave, $key) {
            $employee = Employee::find($leave->employee_id);
            $employee->department = Department::find($employee->department_id);
            $leave->employee = $employee;
            return $leave;
        });
        dd($leaves);
    }
}
