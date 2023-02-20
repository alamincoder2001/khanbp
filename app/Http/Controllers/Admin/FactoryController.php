<?php

namespace App\Http\Controllers\Admin;

use App\Models\Factory;
use App\Models\FactoryPoint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class FactoryController extends Controller
{
    public function edit()
    {
        $factory = Factory::first();
        $factoryPoint = FactoryPoint::latest()->get();
        return view('pages.admin.factory.factorys', compact('factory', 'factoryPoint'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'image1' => 'mimes:jpg,jpeg,png,bmp,webp|dimensions:width=354,height=224',
            'image2' => 'mimes:jpg,jpeg,png,bmp,webp|dimensions:width=354,height=224',
            'image3' => 'mimes:jpg,jpeg,png,bmp,webp|dimensions:width=354,height=224',
            'image4' => 'mimes:jpg,jpeg,png,bmp,webp|dimensions:width=354,height=224',
        ], [
            "image1.dimensions" => "Image dimension must be (354px X 224px)",
            "image2.dimensions" => "Image dimension must be (354px X 224px)",
            "image3.dimensions" => "Image dimension must be (354px X 224px)",
            "image4.dimensions" => "Image dimension must be (354px X 224px)",
        ]);
        try {
            $factory = Factory::first();
            $image1 = $factory->image1;
            $image2 = $factory->image2;
            $image3 = $factory->image3;
            $image4 = $factory->image4;

            if ($request->hasFile('image1')) {
                if (File::exists($image1)) {
                    File::delete($image1);
                }
                $factory->image1 = $this->imageUpload($request, 'image1', 'uploads/factory');
            }
            if ($request->hasFile('image2')) {
                if (File::exists($image2)) {
                    File::delete($image2);
                }
                $factory->image2 = $this->imageUpload($request, 'image2', 'uploads/factory');
            }
            if ($request->hasFile('image3')) {
                if (File::exists($image3)) {
                    File::delete($image3);
                }
                $factory->image3 = $this->imageUpload($request, 'image3', 'uploads/factory');
            }
            if ($request->hasFile('image4')) {
                if (File::exists($image4)) {
                    File::delete($image4);
                }
                $factory->image4 = $this->imageUpload($request, 'image4', 'uploads/factory');
            }

            $factory->save();

            $factorypoint = new FactoryPoint;
            $factorypoint->title = $request->title;
            $factorypoint->save();

            return redirect()->back()->with('success', 'Update Successfull!');

        } catch (\Throwable $th) {
            return redirect()->back()->withInput();
        }
    }

    public function editpoint($id)
    {
        $factorypoint = FactoryPoint::find($id);
        return view('pages.admin.factory.factory-point', compact('factorypoint'));
    }
    public function pointupdate(Request $request, $id)
    {
        $request->validate([
            'title' => 'min:4|max:255'
        ]);
        try {
            $factorypoint = FactoryPoint::find($id);
            $factorypoint->title = $request->title;
            $factorypoint->save();
            return redirect()->route('edit.factory')->with('success', 'update successful!');
        } catch (\Throwable $th) {
            return redirect()->route('edit.factory')->with('error', 'update failed!');
            //throw $th;
        }
    }
    public function pointdelete($id)
    {
        try {
            $factorypoint = FactoryPoint::find($id);
            $factorypoint->delete();
            return redirect()->back()->with('success', 'delete successful!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'delete failed!');
        }
    }
}
