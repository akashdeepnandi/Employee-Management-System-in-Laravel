<?php

namespace App\Http\Controllers\Admin;

use App\Holiday;
use App\Http\Controllers\Controller;
use App\Rules\DateRange;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class HolidayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'holidays' => Holiday::all()
        ];

        return view('admin.holidays.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.holidays.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->input('multiple-days') == "no") {
            $this->validate($request, [
                'name' => 'required',
            ]);
            Holiday::create([
                'name' => $request->name,
                'start_date' => Carbon::create($request->date)
            ]);
            
        } else {
            $this->validate($request, [
                'name' => 'required',
                'date_range' => new DateRange
            ]);
            [$start, $end] = explode(' - ', $request->date_range);
            Holiday::create([
                'name' => $request->name,
                'start_date' => $start,
                'end_date' => $end
            ]);
        }
        $request->session()->flash('success', 'Holiday has been successfully added');
        return redirect()->route('admin.holidays.index');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $holiday = Holiday::findOrFail($id);

        return view('admin.holidays.edit')->with('holiday', $holiday);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $holiday = Holiday::findOrFail($id);
        if($request->input('multiple-days') == "no") {
            $this->validate($request, [
                'name' => 'required',
            ]);
            $holiday->name = $request->name;
            $holiday->start_date = Carbon::create($request->date);
            $holiday->end_date = null;
            
        } else {
            $this->validate($request, [
                'name' => 'required',
                'date_range' => new DateRange
            ]);
            [$start, $end] = explode(' - ', $request->date_range);
            $holiday->name = $request->name;
            $holiday->start_date = $start;
            $holiday->end_date = $end;
        }
        $holiday->save();
        $request->session()->flash('success', 'Holiday has been successfully updated');
        return redirect()->route('admin.holidays.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $holiday = Holiday::findOrFail($id);
        $holiday->delete();
        request()->session()->flash('success', 'Holiday has been successfully deleted!');
        return back();
    }
}
