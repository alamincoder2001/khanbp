<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;


class CategoryController extends Controller
{
    
    public function index()
    {
        $category = Category::latest()->get();
        return view('pages.admin.categories', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name|max:100',
            'image' => 'required|mimes:jpeg,jpg,png,gif,webp|dimensions:width=200,height=200'
        ],["image.dimensions" => "Image dimension must be (200px X 200px)"]);
        try {
            $category = new Category();
            if($request->hasFile('image')){
                $image = $request->file('image');
                $nameGen = hexdec(uniqid());
                $imgExt = strtolower($image->getClientOriginalExtension());
                $imgName = $nameGen. '.' . $imgExt;
                $upLocation = 'uploads/category/';
                Image::make($image)->resize(200,200)->save($upLocation . $imgName);
                $lastImage = $upLocation . $imgName;
                $category->image = $lastImage;
            }
            $category->name = $request->name;
            $category->save();
            
            return Redirect()->back()->with('success', 'Insert Successful!');

        } catch (\Exception $e) {

            throw $e;
            return Redirect()->back()->with('failed', 'Insert Failed!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoryData = Category::findOrFail($id);
        $category = Category::latest()->get();
        return view('pages.admin.categories', compact('category', 'categoryData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:100',
            'image' => 'mimes:jpeg,jpg,png,gif,webp|dimensions:width=200,height=200'
        ],["image.dimensions" => "Image dimension must be (200px X 200px)"]);
        
        try {
            $category = Category::findOrFail($id);
            $category->name = $request->name;
            $image = $request->file('image');
            if($image) {
                $imageName = date('YmdHi').$image->getClientOriginalName();
                Image::make($image)->resize(200,200)->save('uploads/category/' . $imageName);
                if(file_exists($category->image) && !empty($category->image)) {
                    unlink($category->image);
                }
                $lastImage = 'uploads/category/'. $imageName;
                $category['image'] = $lastImage;
            }
            $category->save();
            return Redirect()->route('admin.categories')->with('success', 'Category Update Successful!');

        } catch (\Exception $e) {
            return Redirect()->back()->with('error', 'Category Update Failed!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        if($category){
            if(file_exists($category->image) AND !empty($category->image)){
                unlink($category->image);
            }
            $category->delete();
        }
        return Redirect()->back()->with('success', 'Deleted Successfully!');
    }
}
