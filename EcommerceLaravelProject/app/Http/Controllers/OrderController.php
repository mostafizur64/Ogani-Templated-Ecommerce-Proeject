<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\OrderItem;
use App\Models\OrderTable;
use App\Models\Product;
use App\Models\Shipping;
use Carbon\Carbon;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function Store(Request $request)
    {

        $request->validate([
            'shipping_first_name',
        ]);
        $order_id = OrderTable::insertGetId([
            'user_id' => Auth::id(),
            'invoice_no' => mt_rand(10000000, 99999999),
            'payment_type' => $request->payment_type,
            'total' => $request->total,
            'subtotal' => $request->subtotal,
            'cupon_discount' => $request->cupon_discount,
            'created_at' => Carbon::now(),
        ]);
        $carts = Cart::where('user_ip', $request->ip())->latest()->get();

        foreach ($carts as $cart) { //this forach are use to at a time many product are added on tabel



            OrderItem::insert([
                'order_id' => $order_id,
                'product_id' => $cart->product_id,
                'product_qty' => $cart->qty,
                'created_at' => Carbon::now(),

            ]);
        }
        Shipping::insert([
            'order_id' => $order_id,
            'shipping_first_name' => $request->shipping_first_name,
            'shipping_last_name' => $request->shipping_last_name,
            'shipping_email' => $request->shipping_email,
            'shipping_phone' => $request->shipping_phone,
            'state' => $request->state,
            'address' => $request->address,
            'post_code' => $request->post_code,
            'created_at' => Carbon::now(),

        ]);
        if (Session::has('cupon')) {
            session()->forget('cupon');
        }
        Cart::where('user_ip', $request->ip())->delete();
        return redirect()->route('Order.success')->with('oderInsert', 'Order Inserted successfully!');
    }
    public function OrderSuccess()
    {
        return view('frontendPages.order-complete');
    }


    //  ===========================THIS FUNCTION ARE USE FOR BACKEND/ADMIN STRAT HERE==========

    public function Index()
    {
        $orders = OrderTable::OrderBy('id', 'DESC')->get();
        return view('admin.orders.index', compact('orders'));
    }



    // ==========Order item order table shipping are together compact are here================
    public function View($order_id)
    {
        $ordersTabel = OrderTable::findOrFail($order_id);
        $orderItems = OrderItem::where('order_id', $order_id)->get();
        $shipping = Shipping::where('order_id', $order_id)->first();

        return view('admin.profile.order-view', compact('ordersTabel', 'orderItems', 'shipping'));
    }








    //  ===========================THIS FUNCTION ARE USE FOR BACKEND/ADMIN STRAT End==========











}
