<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $contact = Contact::latest()->get();
        return view('pages.admin.query.contact', compact('contact'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|max:50',
            'subject' => 'required|min:4',
            'message' => 'required|min:8',
            // 'phone' => 'required|regex:/^01[13-9][\d]{8}$/|min:11',
           
        ]);

        try {
            $message = new Contact();
            $message->name = $request->name;
            $message->email = $request->email; 
            $message->subject = $request->subject;
            $message->message = $request->message;
            $message->save();
            return redirect()->back()->with('success', 'Message has been sent!');
            
        } catch (\Throwable $th) {
            //throw $th;
            // return $th->getMessage();
            return redirect()->back()->with('error', 'Message failed!');
            
        }
       
    }
    public function destroy($id){
        $contact = Contact::find($id);
        $contact->delete();
        if($contact){
            return redirect()->back()->with('success', 'Delete successfull!');
        }
        else{
            // Session::flash('errors', 'something went wrong');
            return redirect()->back()->with('error', 'Delete failed!');
        }   
    }
}
