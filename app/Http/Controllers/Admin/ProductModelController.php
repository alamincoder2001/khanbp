<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductModel;

class ProductModelController extends Controller
{
    public function index()
    {
        $productmodel = ProductModel::latest()->get();
        return view('pages.admin.product-model', compact('productmodel'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:product_models,name|max:100',
        ]);
        try {
            $productmodel = new ProductModel();
            $productmodel->name = $request->name;
            $productmodel->save();
            return Redirect()->back()->with('success', 'Model Insertion Successful!');
        } catch (\Exception $e) {
            return Redirect()->back()->with('error', 'Model Insert Failed!');
        }
    }
    public function edit($id)
    {
        $productmodelData = ProductModel::findOrFail($id);
        $productmodel = ProductModel::latest()->get();
        return view('pages.admin.product-model', compact('productmodel', 'productmodelData'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:100',
        ]);
        
        try {
            $productmodel = ProductModel::find($id);
            $productmodel->name = $request->name;
            $productmodel->save();
            return Redirect()->route('admin.model')->with('success', 'Product Model Update Successful!');

        } catch (\Exception $e) {
            // throw $e
            return Redirect()->back()->with('error', 'Product Model Update Failed!');
        }
    }
    public function destroy($id)
    {
        try {
            $productmodel = ProductModel::findOrFail($id);
            $productmodel->delete();
            return Redirect()->back()->with('success', 'Deleted Successfully!');
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect()->back()->with('error', 'Deleted Failed!');
        }
        
    }
}
