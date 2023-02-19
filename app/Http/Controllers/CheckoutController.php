<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetail;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use App\Models\Customer_info;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function checkout() {
        if(\Cart::getTotal() == 0) {
            return redirect()->route('cart.index')->with('error', 'Cart is Empty! Add a Item First');
        } else {
            $cartItems = \Cart::getContent();
            return view('pages.website.checkout', compact('cartItems'));
        }
    }
    public function checkoutstore(Request $request) {
        $request->validate([
            'name' => 'required|min:4|max:255',
            'email' => 'email:rfc,dns',
            'phone' => 'required|digits:11',
            'address' => 'required|min:4|max:255',
        ]);
        try {
            if(\Cart::getTotal() > 0) {

                DB::beginTransaction();
                $customer = new Customer_info;
                $customer->name = $request->name;
                $customer->email = $request->email;
                $customer->phone = $request->phone;
                $customer->note = $request->note;
                $customer->address = $request->address;
                $customer->save();
    
                $order = new Order;
                $invoice_number = $this->generateProductCode('Order', 'I');
                $order->customer_id = $customer->id;
                $order->invoice_number = $invoice_number;
                $order->total_taka = \Cart::getTotal();
                // $order->status = 'p';
                $order->save();
                
                // $orderDetail = new Order
                $cartItems = \Cart::getContent();
                foreach ($cartItems as $key => $item) {
                    $orderDetail = new OrderDetail;
                    $orderDetail->order_id = $order->id;
                    $orderDetail->product_id = $item->id;
                    $orderDetail->quantity = $item->quantity;
                    $orderDetail->price = $item->price;
                    $orderDetail->total_taka = $item->quantity * $item->price;
                    $orderDetail->save();
                }
                DB::commit();
                \Cart::clear();
    
                $details = Order::where('id',$order->id)->get()->load('customer','orderDetail');
                
                return view('pages.website.order-placed',compact('details'));
            } else {
                return redirect()->route('cart.index')->with('error', 'Add Product First');
            }
            // return redirect()->route('order.placed')->with('success', 'Your order is successfully sent!');
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }
}
