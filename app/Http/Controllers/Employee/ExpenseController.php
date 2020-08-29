<?php

namespace App\Http\Controllers\Employee;

use App\Expense;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    public function index () {
        $employee = Auth::user()->employee;
        $data = [
            'employee' => $employee,
            'expenses' => $employee->expense
        ];
        return view('employee.expenses.index')->with($data);
    }

    public function create () {
        $data = [
            'employee' => Auth::user()->employee
        ];
        return view('employee.expenses.create')->with($data);
    }

    public function store(Request $request, $employee_id) {
        $data = [
            'employee' => Auth::user()->employee
        ];
        $this->validate($request, [
            'reason' => 'required',
            'description' => 'required',
            'amount' => 'required | numeric',
            'receipt' => 'image | nullable'
        ]);

        if ($request->hasFile('receipt')) {
            // GET FILENAME
            $filename_ext = $request->file('receipt')->getClientOriginalName();
            // GET FILENAME WITHOUT EXTENSION
            $filename = pathinfo($filename_ext, PATHINFO_FILENAME);
            // GET EXTENSION
            $ext = $request->file('receipt')->getClientOriginalExtension();
            //FILNAME TO STORE
            $filename_store = $filename.'_'.time().'.'.$ext;
            // UPLOAD IMAGE
            $path = $request->file('receipt')->storeAs('public/receipts', $filename_store);
            } else {
            $filename_store = null;
            }
        Expense::create([
            'employee_id' => $employee_id,
            'reason' => $request->input('reason'),
            'description' => $request->input('description'),
            'amount' => $request->input('amount'),
            'receipt' => $filename_store
        ]);
        $request->session()->flash('success', 'Your expense claim has been successfully applied, wait for approval.');
        return redirect()->route('employee.expenses.create')->with($data);
    }
}
