<?php

namespace App\Http\Controllers\Admin;
use App\Models\Map;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function edit()
    {
        $map = Map::first();
        return view('pages.admin.map', compact('map'));
    }

    public function update(Request $request, Map $map) {
        // dd($request->all());
        $request->validate([
            'link' => 'required',
        ]);

        try {
            $map->link = $request->link;
            $map->save();
            return redirect()->back()->with('success','Update Successful!');        

        } catch (\Throwable $th) {
            // return redirect()->back()->withInput();
            return redirect()->back()->with('error', 'Update Failed!');
        }    
    }

}
