<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Models\OrderTable;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // ==========order show==========
    public function order()
    {
        $all_orders = OrderTable::where('user_id', Auth::id())->latest()->get();
        return view('frontendPages.profile.order', compact('all_orders'));
    }
    // ===========Order-View=================
    public function OrderView($order_id)
    {
        $ordersTabel = OrderTable::findOrFail($order_id);
        $orderItems = OrderItem::with('product')->where('order_id', $order_id)->get();
        $shipping = Shipping::where('order_id', $order_id)->first();

        return view('frontendPages.profile.order-view', compact('ordersTabel', 'orderItems', 'shipping'));
    }
}
