<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Breaktime;

use Illuminate\Support\Facades\DB;

class BreaktimeController extends Controller
{
    public function index()
    {
        $breaks = Breaktime::all();
        return view("admin.breaktime.index", compact("breaks"));
    }

    public function create()
    {
        $companies = DB::table('personnel_company')->select('id','company_code', 'company_name')->get();
        return view("admin.breaktime.create", compact('companies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'alias' => 'required',
            'period_start' => 'required|date_format:H:i',
            'duration' => 'required|numeric',
            'end_margin' => 'required|numeric',
            'company_id' => 'required|numeric',
        ]);

        DB::table('att_breaktime')->insert([
            'alias' => $request->alias,
            'period_start' => $request->period_start,
            'duration' => $request->duration,
            'end_margin' => $request->end_margin,
            'company_id' => $request->company_id,
        ]);
        return redirect()->route('admin.breaktime.index')->with('success', 'Breaktime created successfully.');
    }

    public function edit($id)
    {
        $break = Breaktime::findOrFail($id);
        $companies = DB::table('personnel_company')->get();
        return view("admin.breaktime.edit", compact("break", "companies"));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'alias' => 'required',
            'period_start' => 'required|date_format:H:i',
            'duration' => 'required|numeric',
            'company_id' => 'required|numeric',
        ]);
    
        // Find the breaktime record by ID
        $breaktime = Breaktime::findOrFail($id);
    
        // Update the attributes
        $breaktime->alias = $request->alias;
        $breaktime->period_start = $request->period_start;
        $breaktime->duration = $request->duration;
        $breaktime->company_id = $request->company_id;
    
        // Calculate the new end_margin based on the difference between end_time and period_start
        $periodStart = \Carbon\Carbon::parse($breaktime->period_start);
        $endTime = \Carbon\Carbon::parse($request->end_time); // Assuming end_time is provided in the request
        $breaktime->end_margin = $endTime->diffInMinutes($periodStart);
    
        // Save the changes to the database
        $breaktime->save();
    
        return redirect()->route('admin.breaktime.index')->with('success', 'Breaktime updated successfully.');
    }
    

    public function destroy($id)
    {
        $break = Breaktime::findOrFail($id);
        $break->delete();

        return redirect()->route('admin.breaktime.index')->with('success', 'Breaktime deleted successfully.');
    }
}
