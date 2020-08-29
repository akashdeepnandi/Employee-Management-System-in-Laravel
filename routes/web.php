<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware(['auth','can:admin-access'])->group(function () {
    Route::get('/', 'AdminController@index')->name('index');
});

Route::namespace('Employee')->prefix('employee')->name('employee.')->middleware(['auth','can:employee-access'])->group(function () {
    Route::get('/', 'EmployeeController@index')->name('index');
    // Routes for Attendances //
    Route::get('/attendance/list-attendances', 'AttendanceController@index')->name('attendance.index');
    Route::post('/attendance/list-attendances', 'AttendanceController@index')->name('attendance.index');
    Route::get('/attendance/register', 'AttendanceController@create')->name('attendance.create');
    Route::post('/attendance/{employee_id}', 'AttendanceController@store')->name('attendance.store');
    Route::put('/attendance/{attendance_id}', 'AttendanceController@update')->name('attendance.update');
    // Routes for Attendances //
    /*
    *
    */
    // Routes for Leaves //
    Route::get('/leaves/apply', 'LeaveController@create')->name('leaves.create');
    Route::get('/leaves/list-leaves', 'LeaveController@index')->name('leaves.index');
    Route::post('/leaves/{employee_id}', 'LeaveController@store')->name('leaves.store');
    // Routes for Leaves //

    // Routes for Expenses//
    Route::get('/expenses/list-expenses', 'ExpenseController@index')->name('expenses.index');
    Route::get('/expenses/claim-expense', 'ExpenseController@create')->name('expenses.create');
    Route::post('/expenses/{employee_id}', 'ExpenseController@store')->name('expenses.store');
    // Routes for Expenses//

    // Routes for Self //
    Route::get('/self/holidays', 'SelfController@holidays')->name('self.holidays');
    // Routes for Self //
});