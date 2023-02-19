<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class TestimonialController extends Controller
{
    function index(){
        $testimonial = Testimonial::get();
        return view('pages.admin.testimonial.index',compact('testimonial'));
    }

    function store(Request $request){
        
        $request->validate([
            'name' => 'required',
            // 'post' =>'required',  
            'description' => 'max:255'         
        ]);

        try{

            DB::beginTransaction();
            $testimonial = new Testimonial();
            $testimonial->name = $request->name;
            $testimonial->post = $request->post;
            $testimonial->description = $request->description;
            // $testimonial->phone = $request->phone;
            // $testimonial->rank = $request->rank;
            // $testimonial->is_phone = $request->is_phone ? $request->is_phone : 'd';
            $mainImagewithPath = '';
            if($request->hasFile('image')){               
                $image = $request->file('image');
                $mainImage = 't-' . time() . uniqid() . $image->getClientOriginalName();
                Image::make($image)->resize(120, 120)->save('uploads/testimonial/' . $mainImage);
                $mainImagewithPath = 'uploads/testimonial/'.$mainImage;
            }
            $testimonial->image = $mainImagewithPath;
            $testimonial->save();
            DB::commit();
            return redirect()->back()->with('success','Successfully Added');
        }
        catch(\Throwable $th){
            DB::rollBack();
            return $th->getMessage();
            return redirect()->back()->with('error','Added not successfull');
        }
    }

    function edit($id){
        
        $testimonial = Testimonial::find($id);
        return view('pages.admin.testimonial.edit', compact('testimonial'));
    }

    function update(Request $request, $id){
        $request->validate([
            'name' => 'required',
            // 'post' =>'required',
            'description' => 'max:255'
            // 'rank' =>'required',        
        ]);

        try{
            DB::beginTransaction();
            $testimonial = Testimonial::find($id);
            $testimonial->name = $request->name;
            $testimonial->post = $request->post;
            $testimonial->description = $request->description;
            // $testimonial->phone = $request->phone;
            // $testimonial->rank = $request->rank;
            // $testimonial->is_phone = $request->is_phone ? $request->is_phone : 'd';
            $mainImagewithPath = $testimonial ->image;
            if($request->hasFile('image')){ 

                if($testimonial->image != '' && file_exists($testimonial->image)){
                    unlink($testimonial->image);
                   }               
                $image = $request->file('image');
                $mainImage = 't-' . time() . uniqid() . $image->getClientOriginalName();
                Image::make($image)->resize(120, 120)->save('uploads/testimonial/' . $mainImage);
                $mainImagewithPath = 'uploads/testimonial/'.$mainImage;
            }
            $testimonial->image = $mainImagewithPath;
            $testimonial->save();
            DB::commit();
            return redirect()->back()->with('success','Successfully Updated');
        }
        catch(\Throwable $th){
            DB::rollBack();
            return redirect()->back()->with('error','Updated not successfull');
        }

    }
    function destroy($id){

        try{

            $testimonial = Testimonial::find($id);
            if($testimonial->image){
                unlink($testimonial->image);
            }
            $testimonial->delete();

            if($testimonial){
                return redirect()->back()->with('success','Successfully Deleted');
            }
        }
        catch(\Throwable $th){
            return redirect()->back()->with('error','Deleted Failed');
        }
    }
}
