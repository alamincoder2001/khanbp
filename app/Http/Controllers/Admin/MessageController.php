<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Message;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function index() {
        $orders = Message::latest()->get();
        return view('pages.admin.query.order', compact('orders'));
    }
    public function store(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|min:4',
            'email' => 'required|min:4|max:255',
            'subject' => 'required|min:4|max:255',
            'message' => 'required|min:8',      
        ]);
        try {
            DB::beginTransaction();
            $message = new Message;
            $message->name = $request->name;
            $message->email = $request->email;
            $message->product_id = $request->product_id;
            $message->subject = $request->subject;
            $message->message = $request->message;
            $message->created_at = Carbon::now();
            $message->save();
            DB::commit();
            return redirect()->back()->with('success', 'Your Order is sent!');
        } catch (\Exception $e) {
            DB::rollback();           
		    // return ["error" => $e->getMessage()];
            return redirect()->back()->with('error', 'Your Order isn\'t placed!');
        }
    }
    public function destroy($id) {
        $message = Message::find($id);
        $message->delete();
        return Redirect()->back()->with("success", "Order message deleted!");
    }
}
