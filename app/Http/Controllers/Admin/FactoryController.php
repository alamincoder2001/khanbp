<?php

namespace App\Http\Controllers\Admin;

use App\Models\Factory;
use App\Models\FactoryPoint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FactoryController extends Controller
{
    public function edit() {
        $factory = Factory::first();
        $factoryPoint = FactoryPoint::latest()->get();
        return view('pages.admin.factory.factorys',compact('factory', 'factoryPoint'));
    }

    public function update(Request $request) {
        $request->validate([
            'image1' => 'mimes:jpg,jpeg,png,bmp,webp',
            'image2' => 'mimes:jpg,jpeg,png,bmp,webp',
            'image3' => 'mimes:jpg,jpeg,png,bmp,webp',
            'image4' => 'mimes:jpg,jpeg,png,bmp,webp',
            'title' => 'min:4|max:255'
        ]);
        try {
            $factory = Factory::first();
            $image1 = $factory->image1;
            $image2 = $factory->image2;
            $image3 = $factory->image3;
            $image4 = $factory->image4;

            if($request->hasFile('image1')) {
                if(!empty($factory->image1) && file_exists($factory->image1))
                {
                    unlink($factory->image1);
                }
                $image1 = $this->imageUpload($request, 'image1', 'uploads/factory');
            }
            if($request->hasFile('image2')) {
                if(!empty($factory->image2) && file_exists($factory->image2))
                {
                    unlink($factory->image2);
                }
                $image2 = $this->imageUpload($request, 'image2', 'uploads/factory');
            }
            if($request->hasFile('image3')) {
                if(!empty($factory->image3) && file_exists($factory->image3))
                {
                    unlink($factory->image3);
                }
                $image3 = $this->imageUpload($request, 'image3', 'uploads/factory');
            }
            if($request->hasFile('image4')) {
                if(!empty($factory->image4) && file_exists($factory->image4))
                {
                    unlink($factory->image4);
                }
                $image4 = $this->imageUpload($request, 'image4', 'uploads/factory');
            }
            $factory->image1 = $image1;
            $factory->image2 = $image2;
            $factory->image3 = $image3;
            $factory->image4 = $image4;
            $factory->save();

            $factorypoint = new FactoryPoint;
            $factorypoint->title = $request->title;
            $factorypoint->save();

            if($factory){
                return redirect()->back()->with('success', 'Update Successfull!');
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->withInput();
        }
    }

    public function editpoint($id) {
        $factorypoint = FactoryPoint::find($id);
        return view('pages.admin.factory.factory-point', compact('factorypoint'));
    }
    public function pointupdate(Request $request, $id) {
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
    public function pointdelete($id) {
        try {
            $factorypoint = FactoryPoint::find($id);
            $factorypoint->delete();
            return redirect()->back()->with('success', 'delete successful!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'delete failed!');
        }
       
    }
}
