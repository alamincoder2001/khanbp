<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\SisterConcern;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class SisterConcernController extends Controller
{
    public function index() {
        $sisterconcern = SisterConcern::latest()->get();
        return view('pages.admin.sister.index', compact('sisterconcern'));
    }
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|min:4|max:255',
            's_description' => 'required|min:4|max:255',
            'image' => 'required|mimes:jpeg,jpg,png,gif,webp|dimensions:width=440,height=360',
        ],["image.dimensions" => "Image dimension must be (440px X 360px)"]);

        try {
            $image = $request->file('image');
            $name_gen=hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(440,360)->save('uploads/sisterconcern/'.$name_gen);
            $save_url = 'uploads/sisterconcern/'.$name_gen;

            
            $sisterconcern = new SisterConcern();
            $sisterconcern->name = $request->name;
            $sisterconcern->s_description = $request->s_description;
            $sisterconcern->image = $save_url;    
            $sisterconcern->created_at = Carbon::now();
            $sisterconcern->save();
            return redirect()->back()->with('success', 'inserted!');
        } catch (\Exception $e) {
		    return ["error" => $e->getMessage()];
            // return redirect()->back()->with('error', 'sisterconcern insert failed!');
        }
    }
    public function edit(Request $request, $id) {
        $sister = SisterConcern::find($id);
        return view('pages.admin.sister.edit', compact('sister'));
    }
    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required',
            's_description' => 'required|min:8',
            'image' => 'mimes:jpeg,jpg,png,gif,webp|dimensions:width=440,height=360',
        ],["image.dimensions" => "Image dimension must be (440px X 360px)"]);

        try {
            $sisterconcern = SisterConcern::find($id);
            $sisterconcern->name = $request->name;
            $sisterconcern->s_description = $request->s_description;

            $image = $request->file('image');
            if($image) {
                $imageName = date('YmdHi').$image->getClientOriginalName();
                Image::make($image)->resize(440,360)->save('uploads/sisterconcern/' . $imageName);
                $save_url = 'uploads/sisterconcern/'.$imageName;
                if(file_exists($sisterconcern->image) && !empty($sisterconcern->image)) {
                    unlink($sisterconcern->image);
                }
                $sisterconcern['image'] = $save_url;
            }           
            $sisterconcern->save();
            // DB::commit();
            return redirect()->back()->with('success', 'SisterConcern Updated!');
        } catch (\Exception $e) {       
		    // return ["error" => $e->getMessage()];
            return redirect()->back()->with('error', 'SisterConcern update failed!');
        }
    }
    public function delete($id) {
        $sisterconcern = SisterConcern::find($id);
        if(file_exists($sisterconcern->image) && !empty($sisterconcern->image)) {
            unlink($sisterconcern->image);
        }
        $sisterconcern->delete();
        return Redirect()->back()->with("success", "SisterConcern Deleted Successfully");
    }
}
