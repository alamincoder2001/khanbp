<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Unit;

class UnitController extends Controller
{
    public function index()
    {
        $unit = Unit::latest()->get();
        return view('pages.admin.unit', compact('unit'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:units|max:100',
        ]);
        try {
            $unit = new Unit();
            $unit->name = $request->name;
            $unit->save();
            return Redirect()->back()->with('success', 'Insertion Successful!');
        } catch (\Exception $e) {
            return Redirect()->back()->with('error', 'Insert Failed!');
        }
    }
    public function edit($id)
    {
        $unitData = Unit::findOrFail($id);
        $unit = Unit::latest()->get();
        return view('pages.admin.unit', compact('unit', 'unitData'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:100',
        ]);
        
        try {
            $unit = Unit::find($id);
            $unit->name = $request->name;
            $unit->save();
            return Redirect()->route('admin.unit')->with('success', 'Update Successful!');

        } catch (\Exception $e) {
            // throw $e
            return Redirect()->back()->with('error', 'Update Failed!');
        }
    }
    public function destroy($id)
    {
        try {
            $unit = Unit::findOrFail($id);
            $unit->delete();
            return Redirect()->back()->with('success', 'Deleted Successfully!');
        } catch (\Throwable $th) {
            throw $th;
            return Redirect()->back()->with('error', 'Deleted Failed!');
        }
        
    }
}
