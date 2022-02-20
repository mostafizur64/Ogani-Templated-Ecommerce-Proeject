<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeUnitReverseLookup\Wizard;

class WishlistController extends Controller
{
    // ==============add wishlist========================
    public function AddToWishlist($product_id)
    {
        //  echo $product_id;

        if (Auth::check()) {
            $w = Wishlist::where('product_id', $product_id)->first();
            /**
             *check wishlist =================================================
             *one product are added to wishlist then same product are not not added by the wishlist
             */

            if ($w == null) {
                Wishlist::insert([
                    'user_id' => Auth::id(),
                    'product_id' => $product_id,
                ]);
                return redirect()->back()->with('wishlist', 'your product is added on wishlist');
            } else {
                echo 'already exist';
            }
        } else {
            return redirect()->route('login')->with('wishlistErr', 'Please add fast login Your account');
        }
    }
    // =============wishlist page view========================
    public function Wishlist()
    {
        $wishlistItem = Wishlist::with('product')->where('user_id', Auth::id())->latest()
            ->get();
        return view('frontendPages.wishlist', compact('wishlistItem'));
    }
    public function cartwishlistdelete($cart_id)
    {
        Wishlist::where('user_id', Auth::id())->findOrFail($cart_id)->delete();
        return back()->with('wishlistDelete', 'Wishlist Deleted Successfully!');
    }
}
