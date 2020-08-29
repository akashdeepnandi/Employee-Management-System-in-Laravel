<?php

namespace App\Http\Controllers\Employee;

use App\Holiday;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SelfController extends Controller
{
    public function holidays() {
        $data = [
            'holidays' => Holiday::all()
        ];

        return view('employee.self.holidays')->with($data);
    }
}
