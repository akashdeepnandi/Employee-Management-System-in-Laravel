<?php

namespace App\Http\Controllers\Employee;
use App\Http\Controllers\Controller;

use App\Leave;
use App\Rules\DateRange;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
