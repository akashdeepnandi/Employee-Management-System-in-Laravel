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
            $employee->department = Department::find($employee->department_id)->name;
            $expense->employee = $employee;
            return $expense;
        });
        return view('admin.expenses.index')->with('expenses', $expenses);
    }

    public function update(Request $request, $expense_id){
        $this->validate($request, [
            'status' => 'required'
        ]);
        $expense = Expense::find($expense_id);
        $expense->status = $request->status;
        $expense->save();
        $request->session()->flash('success', 'expense status has been successfully updated');
        
        return back();
    }
}
