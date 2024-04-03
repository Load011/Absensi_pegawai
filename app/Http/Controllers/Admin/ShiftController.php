<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Shift;
use App\ShiftDetail;
use App\Timetable;

class ShiftController extends Controller
{
    public function index()
{
    $shifts = DB::table('att_attshift')
        ->join('att_shiftdetail', 'att_attshift.id', '=', 'att_shiftdetail.shift_id')
        ->leftJoin('att_timeinterval', 'att_shiftdetail.time_interval_id', '=', 'att_timeinterval.id')
        ->select('att_attshift.*', 'att_shiftdetail.*', 'att_timeinterval.*')
        ->get();
    
    // Manually load shiftDetails for each shift
    foreach ($shifts as $shift) {
        $shift->shiftDetails = ShiftDetail::where('shift_id', $shift->id)->get();
    }
    
    return view("admin.shift.index", compact("shifts"));
}



public function create()
{
    $shifts = Shift::all();
    $timeIntervals = Timetable::all(); 
    $companies = DB::table('personnel_company')->select('id','company_code', 'company_name')->get();

    return view("admin.shift.create", compact("shifts", "timeIntervals", "companies"));
}


    public function store(Request $request)
    {
        $request->validate([
            'alias' => 'required',
            'company_id' => 'required|numeric',
        ]);

        Shift::create($request->all());

        return redirect()->route('admin.shift.index')->with('success', 'Shift created successfully.');
    }

    public function edit($id)
    {
        $shift = Shift::findOrFail($id);
        return view("admin.shift.edit", compact("shift"));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'alias' => 'required',
            'company_id' => 'required',
        ]);

        $shift = Shift::findOrFail($id);
        $shift->update([
            'alias' => $request->alias,
            'company_id' => $request->company_id,
        ]);
        
        return redirect()->route('admin.shift.index')->with('success', 'Shift updated successfully.');
    }

    public function destroy($id)
    {
        $shift = Shift::findOrFail($id);
        $shift->delete();

        return redirect()->route('admin.shift.index')->with('success', 'Shift deleted successfully.');
    }
}
