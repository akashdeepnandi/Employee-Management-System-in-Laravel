<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function index() {
        $data = [
            'employee' => Auth::user()->employee
        ];
        return view('employee.index')->with($data);
    }
}
