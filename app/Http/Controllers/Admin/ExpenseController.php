<?php

namespace App\Http\Controllers\Admin;

use App\Department;
use App\Employee;
use App\Expense;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index() {
        $expenses = Expense::all();
        $expenses = $expenses->map(function($expense, $key) {
            $employee = Employee::find($expense->employee_id);
            $employee->department = Department::find($employee->department_id);
            $expense->employee = $employee;
            return $expense;
        });
        dd($expenses);
    }
}
