<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Schedule;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::all();
        return view("admin.schedule.index", compact("schedules"));
    }

    public function create()
    {
        return view("admin.schedule.create");
    }

    public function store(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'employee_id' => 'required|numeric',
            'shift_id' => 'required|numeric',
        ]);

        Schedule::create($request->all());

        return redirect()->route('admin.schedule.index')->with('success', 'Schedule created successfully.');
    }

    public function edit($id)
    {
        $schedule = Schedule::findOrFail($id);
        return view("admin.schedule.edit", compact("schedule"));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'employee_id' => 'required|numeric',
            'shift_id' => 'required|numeric',
        ]);

        $schedule = Schedule::findOrFail($id);
        $schedule->update($request->all());

        return redirect()->route('admin.schedule.index')->with('success', 'Schedule updated successfully.');
    }

    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();

        return redirect()->route('admin.schedule.index')->with('success', 'Schedule deleted successfully.');
    }
}
