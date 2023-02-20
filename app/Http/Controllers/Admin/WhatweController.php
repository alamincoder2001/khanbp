<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Whatwe;


class WhatweController extends Controller
{
    // Edit
    public function edit()
    {
        $whatwe = Whatwe::first();
        return view('pages.admin.whatwe.content', compact('whatwe'));
    }

    // Company profile Update 
    public function update(Request $request, Whatwe $whatwe)
    {
        $request->validate([
            'description1' => 'required|min:10',
            'description2' => 'required|min:10',
            'image' => 'mimes:jpeg,jpg,png,gif,webp|dimensions:width=540,height=520',
        ],["image.dimensions" => "Image dimension must be (540px X 520px)"]);
        try {
            $image = $whatwe->image;

            if($request->hasFile('image')) {
                if(!empty($whatwe->image) && file_exists($whatwe->image))
                {
                    unlink($whatwe->image);
                }
                $image = $this->imageUpload($request, 'image', 'uploads/about');
            }
            // $whatwe->title1 = $request->title1;
            $whatwe->description1 = $request->description1;
            // $whatwe->title2 = $request->title2;
            $whatwe->description2 = $request->description2;
            // $whatwe->title3 = $request->title3;
            // $whatwe->description3 = $request->description3;
            $whatwe->image = $image;
            $whatwe->save();
            if($whatwe){
                return redirect()->back()->with('success', 'Update Successfull!');
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->withInput();
        }
        
    }
}
