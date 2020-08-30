<?php

namespace App\Http\Controllers\Employee;
use App\Http\Controllers\Controller;

use App\Leave;
use App\Rules\DateRange;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class LeaveController extends Controller
{
    public function index() {
        $employee = Auth::user()->employee;
        $data = [
            'employee' => $employee,
            'leaves' => $employee->leave
        ];
        return view('employee.leaves.index')->with($data);
    }
    public function create() {
        $employee = Auth::user()->employee;
        $data = [
            'employee' => $employee
        ];

        return view('employee.leaves.create')->with($data);
    }

    public function store(Request $request, $employee_id) {
        $data = [
            'employee' => Auth::user()->employee
        ];
        if($request->input('multiple-days') == 'yes') {
            $this->validate($request, [
                'reason' => 'required',
                'description' => 'required',
                'date_range' => new DateRange
            ]);
        } else {
            $this->validate($request, [
                'reason' => 'required',
                'description' => 'required'
            ]);
        }
        
        $values = [
            'employee_id' => $employee_id,
            'reason' => $request->input('reason'),
            'description' => $request->input('description'),
            'half_day' => $request->input('half-day')
        ];
        if($request->input('multiple-days') == 'yes') {
            [$start, $end] = explode(' - ', $request->input('date_range'));
            $values['start_date'] = Carbon::parse($start);
            $values['end_date'] = Carbon::parse($end);
        } else {
            $values['start_date'] = Carbon::parse($request->input('date'));
        }
        Leave::create($values);
        $request->session()->flash('success', 'Your Leave has been successfully applied, wait for approval.');
        return redirect()->route('employee.leaves.create')->with($data);
    }

    public function edit($leave_id) {
        $leave = Leave::findOrFail($leave_id);
        Gate::authorize('employee-leaves-access', $leave);
        return view('employee.leaves.edit')->with('leave', $leave);
    }

    public function update(Request $request, $leave_id) {
        $leave = Leave::findOrFail($leave_id);
        Gate::authorize('employee-leaves-access', $leave);
        if($request->input('multiple-days') == 'yes') {
            $this->validate($request, [
                'reason' => 'required',
                'description' => 'required',
                'date_range' => new DateRange
            ]);
        } else {
            $this->validate($request, [
                'reason' => 'required',
                'description' => 'required'
            ]);
        }

        $leave->reason = $request->reason;
        $leave->description = $request->description;
        $leave->half_day = $request->input('half-day');
        if($request->input('multiple-days') == 'yes') {
            [$start, $end] = explode(' - ', $request->input('date_range'));
            $start = Carbon::parse($start);
            $end = Carbon::parse($end);
            $leave->start_date = $start;
            $leave->end_date = $end;
        } else {
            $leave->start_date = Carbon::parse($request->input('date'));
        }

        $leave->save();

        $request->session()->flash('success', 'Your leave has been successfully updated');
        return redirect()->route('employee.leaves.index');
    }

    public function destroy($leave_id) {
        $leave = Leave::findOrFail($leave_id);
        Gate::authorize('employee-leaves-access', $leave);
        $leave->delete();
        request()->session()->flash('success', 'Your leave has been successfully deleted');

        return redirect()->route('employee.leaves.index');
    }
}
