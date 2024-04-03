<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Shift;
use App\ShiftDetail;

class ShiftController extends Controller
{
    public function index()
{
    $shifts = Shift::with('ShiftDetail.shift')->get();
    return view("admin.shift.index", compact("shifts"));
}


    public function create()
    {
        return view("admin.shift.create");
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
