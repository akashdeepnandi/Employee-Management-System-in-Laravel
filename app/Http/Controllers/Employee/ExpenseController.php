<?php

namespace App\Http\Controllers\Employee;

use App\Expense;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

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

    public function edit($expense_id) {
        $expense = Expense::findOrFail($expense_id);
        Gate::authorize('employee-expenses-access', $expense);
        return view('employee.expenses.edit')->with('expense', $expense);
    }

    public function update(Request $request, $expense_id) {
        $expense = Expense::findOrFail($expense_id);
        Gate::authorize('employee-expenses-access', $expense);
        $data = [
            'employee' => Auth::user()->employee
        ];
        $this->validate($request, [
            'reason' => 'required',
            'description' => 'required',
            'amount' => 'required | numeric',
            'receipt' => 'image | nullable'
        ]);
        $expense->reason = $request->reason;
        $expense->description = $request->description;
        $expense->amount = $request->amount;
        if (($request->new_image == 'yes') && $request->hasFile('receipt')) {
            // Deleting the old image
            $old_filepath = public_path(DIRECTORY_SEPARATOR.'storage'.DIRECTORY_SEPARATOR.'receipts'.DIRECTORY_SEPARATOR. $expense->receipt);
            if(file_exists($old_filepath)) {
                unlink($old_filepath);
            }
            // GET FILENAME
            $filename_ext = $request->file('receipt')->getClientOriginalName();
            // GET FILENAME WITHOUT EXTENSION
            $filename = pathinfo($filename_ext, PATHINFO_FILENAME);
            // GET EXTENSION
            $ext = $request->file('receipt')->getClientOriginalExtension();
            //FILNAME TO STORE
            $filename_store = $filename.'_'.time().'.'.$ext;
            // UPLOAD IMAGE
            $path = $request->file('receipt')->storeAs('public'.DIRECTORY_SEPARATOR.'receipts', $filename_store);
            // add new file name
            $expense->receipt = $filename_store;
        }
        $expense->save();
        $request->session()->flash('success', 'Your expense has been successfully updated!');
        return redirect()->route('employee.expenses.index');
    }

    public function destroy($expense_id) {
        $expense = Expense::findOrFail($expense_id);
        Gate::authorize('employee-expenses-access', $expense);
        $filepath = public_path(DIRECTORY_SEPARATOR.'storage'.DIRECTORY_SEPARATOR.'receipts'.DIRECTORY_SEPARATOR. $expense->receipt);
        if (file_exists($filepath)) {
            File::delete($filepath);
        }
        $expense->delete();
        request()->session()->flash('success', 'Expense has been successfully deleted');
        return redirect()->route('employee.expenses.index');
    }
}
