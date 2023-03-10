<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::latest()->get();
        return view('pages.admin.slider.index', compact('sliders'));
    }
    public function store(Request $request) {
        $request->validate([
            'slogan' => 'max:255',
            'headerline' => 'max:255',
            'description' => 'max:255',
            'image' => 'required|mimes:jpg,png,bmp,jpeg,webp|dimensions:width=1260,height=520',
        ],["image.dimensions" => "Image dimension must be (1260px X 520px)"]);
        try {
            $slider = new Slider();

            $image = $request->file('image');
            $nameGen = 'slide'.hexdec(uniqid());
            $imgExt = strtolower($image->getClientOriginalExtension());
            $imgName = $nameGen. '.' . $imgExt;
            $upLocation = 'uploads/slider/';
            Image::make($image)->resize(1260,520)->save($upLocation . $imgName);

            $slider->slogan      = $request->slogan;
            $slider->headerline  = $request->headerline;
            $slider->description = $request->description;
            $slider->image       = $upLocation . $imgName;
            $slider->save();
            return redirect()->route('slider.index')->with('success', 'Insert Successful');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Insert Failed!');       
        }  
    }

    // Edit
    public function edit($id)
    {   
        $slider = Slider::find($id);
        return view('pages.admin.slider.edit', compact('slider'));
    }

    //update
    public function update(Request $request, $id)
    {
        $request->validate([
            'slogan' => 'max:255',
            'headerline' => 'max:255',
            'description' => 'max:255',
            'image' => 'mimes:jpg,png,bmp,jpeg,webp|dimensions:width=1260,height=520',
        ],["image.dimensions" => "Image dimension must be (1260px X 520px)"]);
        // image upload
        try {
            $slider = Slider::find($id);
            $sliderImage = '';
            if ($request->hasFile('image')) {
                if (!empty($slider->image) && file_exists($slider->image)) {
                    unlink($slider->image);
                }
                $image = $request->file('image');
                $nameGen = 'slide'.hexdec(uniqid());
                $imgExt = strtolower($image->getClientOriginalExtension());
                $imgName = $nameGen. '.' . $imgExt;
                $upLocation = 'uploads/slider/';
                Image::make($image)->resize(1260,520)->save($upLocation . $imgName);
                $sliderImage = $upLocation . $imgName;
            } else{
                $sliderImage = $slider->image;
            }
            $slider->slogan = $request->slogan;
            $slider->headerline = $request->headerline;
            $slider->description = $request->description;
            $slider->image = $sliderImage;
            $slider->save();
            if($slider)
            {
                return redirect()->route('slider.index')->with('success', 'Update Successful');
            }

        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', 'Update Failed!');
        }
    }

    public function delete($id)
    {
        $slider = Slider::find($id);
        if (!empty($slider->image) && file_exists($slider->image)) {
            unlink($slider->image);
        }
        $slider->delete();
        return redirect()->back()->with('success', 'Deleted Successfully!');
    }
}
