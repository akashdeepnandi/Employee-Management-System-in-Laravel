<?php

namespace App\Http\Controllers;

use App\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Location;

class AttendanceController extends Controller
{
    public function getIp(){
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
        }
    }


    // Opens view for attendance register form
    public function create() {
        $employee = Auth::user()->employee;
        $data = [
            'employee' => $employee,
            'attendance' => null,
            'registered_attendance' => null
        ];
        $last_attendance = $employee->attendance->last();
        if($last_attendance) {
            if($last_attendance->created_at->format('d') == Carbon::now()->format('d')){
                $data['attendance'] = $last_attendance;
                if($last_attendance->registered)
                    $data['registered_attendance'] = 'yes';
            }
        }
        return view('employee.attendance.create')->with($data);
    }

    // Stores entry record of attendance
    public function store(Request $request, $employee_id) {
        
        $attendance = new Attendance([
                'employee_id' => $employee_id,
                'entry_ip' => $request->ip(),
                'entry_location' => 'Kanakpur'
        ]);
        $attendance->save();
        $request->session()->flash('success', 'Attendance entry successfully logged');
        return redirect()->route('employee.attendance.create')->with('employee', Auth::user()->employee);
    }

    // Stores exit record of attendance
    public function update(Request $request, $attendance_id) {
        
        $attendance = Attendance::findOrFail($attendance_id);
        $attendance->exit_ip = $request->ip();
        $attendance->exit_location = 'Exit kanakpur';
        $attendance->registered = 'yes';
        $attendance->save();
        $request->session()->flash('success', 'Attendance exit successfully logged');
        return redirect()->route('employee.attendance.create')->with('employee', Auth::user()->employee);
    }

    public function getUserIP()
    {
        // Get real visitor IP behind CloudFlare network
        if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
            $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
            $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        }
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];

        if (filter_var($client, FILTER_VALIDATE_IP)) {
            $ip = $client;
        } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
            $ip = $forward;
        } else {
            $ip = $remote;
        }
        return $ip;
    }

    public function index() {
        $employee = Auth::user()->employee;
        $attendances = $employee->attendance;
        $filter = false;
        if(request()->all()) {
            if($attendances) {
                [$start, $end] = explode(' - ', request()->input('date_range'));
                $start = Carbon::parse($start);
                $end = Carbon::parse($end)->addDay();
                $filtered_attendances = $attendances->filter(function($attendance, $key) use ($start, $end) {
                    $date = Carbon::parse($attendance->created_at);
                    if ($date->greaterThanOrEqualTo($start) && $date->lessThanOrEqualTo($end))
                        return true;
                })->values();
                $leaves = $employee->leave;
                $leaves = $leaves->filter(function($leaves, $key) use ($start, $end) {
                    $condition1 = $start->lessThanOrEqualTo($leaves->start_date) && $end->greaterThanOrEqualTo($leaves->start_date);
                    $condition2 = $start->lessThanOrEqualTo($leaves->end_date) && $end->greaterThanOrEqualTo($leaves->end_date);
                    $condition3 = $leaves->status == 'approved';
                    return  ($condition1 || $condition2) && $condition3;
                });
                $attendances = collect();
                $count = $filtered_attendances->count();
                if($count) {
                    $first_day = $filtered_attendances->first()->created_at->dayOfYear;
                    $attendances = $this->get_filtered_attendances($start, $end, $filtered_attendances, $first_day, $count, $leaves);
                }
                else{
                    while($start->lessThan($end)) {
                        $attendances->add($this->attendanceIfNotPresent($start, $leaves));
                        $start->addDay();
                    }
                }
                $filter = true;
            }   
        }
        if ($attendances)
            $attendances = $attendances->reverse()->values();
        $data = [
            'employee' => $employee,
            'attendances' => $attendances,
            'filter' => $filter
        ];
        return view('employee.attendance.index')->with($data);
    }

    public function get_filtered_attendances($start, $end, $filtered_attendances, $first_day, $count, $leaves) {
        $found_start = false;
        $key = 1;
        $attendances = collect();
        while($start->lessThan($end)) {
            if (!$found_start) {
                if($first_day == $start->dayOfYear()) {
                    $found_start = true;
                    $attendances->add($filtered_attendances->first());
                } else {
                    $attendances->add($this->attendanceIfNotPresent($start, $leaves));
                }
            } else {
                // iterating over the 2nd to .. n dates
                if ($key < $count) {
                    if($start->dayOfYear() != $filtered_attendances->get($key)->created_at->dayOfYear) {
                        $attendances->add($this->attendanceIfNotPresent($start, $leaves));
                    }
                    else {
                        $attendances->add($filtered_attendances->get($key));
                        $key++;
                    }
                }
                else {
                    $attendances->add($this->attendanceIfNotPresent($start, $leaves));
                }
            }
            $start->addDay();
        }

        return $attendances;
    }

    public function checkLeave($leaves, $date) {
        if ($leaves->count() != 0) {
            $leaves = $leaves->filter(function($leave, $key) use ($date) {
                return $date->greaterThanOrEqualTo($leave->start_date) && $date->lessThanOrEqualTo($leave->end_date);
            });
        }
        return $leaves->count();
    }

    public function attendanceIfNotPresent($start, $leaves) {
        $attendance = new Attendance();
        $attendance->created_at = $start;
        if($start->dayOfWeek == 0) {
            $attendance->registered = 'sun';
        } elseif($this->checkLeave($leaves, $start)) {
            $attendance->registered = 'leave';
        } else {
            $attendance->registered = 'no';
        }

        return $attendance;
    }

}
