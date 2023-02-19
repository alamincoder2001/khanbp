<?php

namespace App\Http\Controllers\Admin;

use App\Models\Faq;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FaqController extends Controller
{
    function index(){
        $faq = Faq::get();
        return view('pages.admin.faq.index',compact('faq'));
    }

    function store(Request $request){
        
        $request->validate([
            'name' => 'required|max:150',
            'details' =>'required'
        ]);

        try{

            $faq = new Faq();
            $faq->name = $request->name;
            $faq->details = $request->details;
            $faq->save();

            if($faq){
                return redirect()->back()->with('success','Successfully Added');
            }
        }
        catch(\Throwable $th){
            return redirect()->back()->with('error','Added not successfull');
        }
    }

    function edit($id){
        
        $faq = Faq::find($id);
        return view('pages.admin.faq.edit', compact('faq'));
    }
    function update(Request $request, $id){

        $request->validate([
            'name' => 'required|max:150',
            'details' =>'required',
        ]);

        try{

            $faq = Faq::find($id);
            $faq->name = $request->name;
            $faq->details = $request->details;
            $faq->save();

            if($faq){
                return redirect()->back()->with('success','Successfully Updated');
            }
        }
        catch(\Throwable $th){
            return redirect()->back()->with('error','Update not successfull');
        }

    }
    
    function destroy($id){

        try{

            $faq = Faq::find($id);
            $faq->delete();

            if($faq){
                return redirect()->back()->with('success','Successfully Deleted');
            }
        }
        catch(\Throwable $th){
            return redirect()->back()->with('error','Deleted Failed');
        }
    }
}
