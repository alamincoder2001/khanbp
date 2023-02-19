<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductModel;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Model;
// use App\Models\Subcategory;
use Illuminate\Support\Facades\Redirect;
use Image;

class ProductController extends Controller
{
    public function index()
    {
        // $subcategory = Subcategory::latest()->get();
        $category = Category::latest()->get();
        $model = ProductModel::latest()->get();
        $unit = Unit::latest()->get();
        $product = Product::latest()->get();
        return view('pages.admin.product', compact('product', 'category', 'model', 'unit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'category_id' => 'required',
            'model_id' => 'required',
            'unit_id' => 'required',
            'image' => 'required|image|mimes:jpeg,jpg,png,gif,webp',
            'description' => 'min:8',
            'rate' => 'required|numeric',
        ]);
        
        try {
            $image = $request->file('image');
            $name_gen=hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(720,720)->save('uploads/product/'.$name_gen);
            $save_url = 'uploads/product/'.$name_gen;

            $product = new Product();
            $product->name = $request->name;
            $product->category_id = $request->category_id;
            $product->model_id = $request->model_id;
            $product->unit_id = $request->unit_id;
            $product->rate = $request->rate;
            $product->description = $request->description;
            $product->image = $save_url;
            $product->save();
            return Redirect()->route('admin.products')->with('success', 'Product Insertion Succeful!');

        } catch (\Exception $e) {  
            return $e->getMessage();
            // return Redirect()->back()->with('error', 'Insertion Failed!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function getSubCate($subcat_id)
    // {
    //     $subcate = Subcategory::where('category_id', $subcat_id)->orderBy('name' , 'ASC')->get();
    //     return json_encode($subcate);
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::latest()->get();
        $model = ProductModel::latest()->get();
        $unit = Unit::latest()->get();
        $productData = Product::find($id);
        $product = Product::latest()->get();
        return view('pages.admin.product', compact('productData', 'product', 'category', 'model', 'unit'));
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
        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'image' => 'image|mimes:jpeg,jpg,png,gif,webp',
            'description' => 'min:8',
            'category_id' => 'required',
            'model_id' => 'required',
            'unit_id' => 'required',
            'rate' => 'required|numeric',
        ]);
        try {
            $old_img = $request->old_image;
            if ($request->file('image')) {
                unlink($old_img);
                $image = $request->file('image');
                $name_gen=hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                Image::make($image)->resize(720,720)->save('uploads/product/'.$name_gen);
                $save_url = 'uploads/product/'.$name_gen;
    
                $product = Product::find($id);
                $product->name = $request->name;
                $product->category_id = $request->category_id;
                $product->model_id = $request->model_id;
                $product->unit_id = $request->unit_id;
                $product->rate = $request->rate;
                $product->description = $request->description;
                $product->image = $save_url;
                $product->save();
            } else {
                $product = Product::find($id);
                $product->name = $request->name;
                $product->category_id = $request->category_id;
                $product->model_id = $request->model_id;
                $product->unit_id = $request->unit_id;
                $product->rate = $request->rate;
                $product->description = $request->description;
                $product->save();
            }
            return Redirect()->route('admin.products')->with('success', 'Update Successful!');  
        } catch (\Throwable $th) {
            return Redirect()->back()->with('failed', 'Product Update Failed!');
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
        $product = Product::find($id);
        if($product){
            unlink($product->image);
            $product->delete();
        }
        return Redirect()->back()->with('success', 'Deleted Successfully!');
    }
}
