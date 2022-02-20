<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Cupon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // =====================Cart data insert here===================/
    public function addToCart(Request $request, $product_id)
    {
        $check = Cart::where('product_id', $product_id)->where('user_ip', request()->ip())->first();
        if ($check) {
            $check = Cart::where('product_id', $product_id)->where('user_ip', request()->ip())->increment('qty');
            return redirect()->back()->with('cart', 'product added successfully on cart');
        } else {
            Cart::insert([
                'product_id' => $product_id,
                'qty' => '1',
                'price' => $request->price,
                'user_ip' => request()->ip(),

            ]);
            return redirect()->back()->with('cart', 'product added successfully on cart');
        }
    }
    // ===================cart info are show here=======================
    public function Cart()
    {
        $all_cart_info = Cart::where('user_ip', request()->ip())->latest()->get();
        $subtotal = Cart::all()->where('uesr_ip', request()->ip)->sum(function ($t) {
            return $t->price * $t->qty;
        });
        return view('frontendPages.cart_page', compact('all_cart_info', 'subtotal'));
    }
    // ===========================cart quantity delete=========================

    public function cartQutydelete(Request $request, $cart_id)
    {
        Cart::where('id', $cart_id)->where('user_ip', $request->ip())->delete();
        return redirect()->back()->with('cart_quantity', 'Cart Remove successfully!');
    }





    // ======================cart_quantity_update======================
    public function cartQutyupdate(Request $request, $id)
    {
        Cart::where('id', $id)->where('user_ip', $request->ip())->update([
            'qty' => $request->qty,
        ]);
        return redirect()->back()->with('cart_quantity_update', 'Cart Update successfully!');
    }
    // ====================apply cuppon===========================
    public function apply_cuppon(Request $request)
    {
        $check = Cupon::where('cupon_name', $request->cupon_name)->first();
        if ($check) {
            $subtotal = Cart::all()->where('uesr_ip', request()->ip)->sum(function ($t) {
                return $t->price * $t->qty;
            });
            Session::put('cupon', [
                'cupon_name' => $check->cupon_name,
                'discount' => $check->discount,
                'discount_amount' => $subtotal * ($check->discount / 100),

            ]);
            return redirect()->back()->with('cupon_cart_insert', 'cupon appled successfully!');
        } else {
            return redirect()->back()->with('cupon_cart_insert', 'cupon Remove successfully!');
        }
    }
    public function Cupondestroy()
    {
        if (session::has('cupon')) {
            session()->forget('cupon');
            return redirect()->back()->with('cupon_cartDewstroy', 'Your cupon card remove successfully!');
        }
    }
    // ===========checkOut page controller========
    public function CheckOut()
    {
        if (Auth::check()) {
            $carts = Cart::all();
            $subtotal = Cart::all()->where('uesr_ip', request()->ip)->sum(function ($t) {
                return $t->price * $t->qty;
            });
            return view('frontendPages.checkout', compact('carts', 'subtotal'));
        } else {
            return redirect()->route('login');
        }
    }
}
