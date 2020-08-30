<?php

namespace App\Http\Controllers\Admin;

use App\Department;
use App\Employee;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManagerStatic as Image;

use function Ramsey\Uuid\v1;

class EmployeeController extends Controller
{
    public function create() {
        $data = [
            'departments' => Department::all(),
            'desgs' => ['Manager', 'Assistant Manager', 'Deputy Manager', 'Clerk']
        ];
        return view('admin.employees.create')->with($data);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'sex' => 'required',
            'desg' => 'required',
            'department_id' => 'required',
            'salary' => 'required|numeric',
            'email' => 'required|email',
            'photo' => 'image|nullable',
            'password' => 'required|confirmed|min:6'
        ]);
        $user = new User();
        $user->name = $request->first_name.' '.$request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        $employeeRole = Role::where('name', 'employee')->first();
        $user->roles()->attach($employeeRole);
        $user->save();
        $employee = new Employee();
        $employee->user_id = $user->id;
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->sex = $request->sex;
        $employee->dob = $request->dob;
        $employee->join_date = $request->join_date;
        $employee->desg = $request->desg;
        $employee->department_id = $request->department_id;
        $employee->salary = $request->salary;
        $employee->photo = 'user.png';
        $employee->first_name = $request->first_name;
        
        // Photo upload
        if ($request->hasFile('photo')) {
            // GET FILENAME
            $filename_ext = $request->file('photo')->getClientOriginalName();
            // GET FILENAME WITHOUT EXTENSION
            $filename = pathinfo($filename_ext, PATHINFO_FILENAME);
            // GET EXTENSION
            $ext = $request->file('photo')->getClientOriginalExtension();
            //FILNAME TO STORE
            $filename_store = $filename.'_'.time().'.'.$ext;
            // UPLOAD IMAGE
            // $path = $request->file('photo')->storeAs('public'.DIRECTORY_SEPARATOR.'employee_photos', $filename_store);
            // add new file name
            $image = $request->file('photo');
            $image_resize = Image::make($image->getRealPath());              
            $image_resize->resize(300, 300);
            $image_resize->save(public_path(DIRECTORY_SEPARATOR.'storage'.DIRECTORY_SEPARATOR.'employee_photos'.DIRECTORY_SEPARATOR.$filename_store));
            $employee->photo = $filename_store;
        }
        
        $employee->save();
        
        $request->session()->flash('success', 'Employee has been successfully added');
        return back();
    }
}
