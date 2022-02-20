<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FontendController extends Controller
{
    public function index()
    {
        $products = Product::where('status', 1)->latest()->get();
        $categories = Category::where('status', 1)->latest()->get();
        $lst_product = Product::where('status', 1)->limit(3)->get();
        return view('frontendPages.index', compact('products', 'categories', 'lst_product'));
    }

    // ========product details===================
    public function ProductDetails($product_id)
    {
        $product = Product::findOrFail($product_id);
        $category_id = $product->category_id;
        $relatad_p = Product::where('category_id', $category_id)->where('id', '!=', $product_id)->latest()->get();
        return view('frontendPages.product_details', compact('product', 'relatad_p'));
    }

    // ================Shop page controller are here=============
    public function Shop()
    {
        $products = Product::latest()->get();
        $productP = Product::latest()->paginate(3);
        $categories = Category::where('status', '1')->latest()->get();
        return view('frontendPages.shop', compact('products', 'categories', 'productP'));
    }
    // =====================category wises product show================
    public  function CatWisePooShow($cat_id)
    {
        $categories = Category::where('status', 1)->latest()->get();
        $products = Product::where('category_id', $cat_id)->latest()->paginate(3);
        return view('frontendPages.cat_wise_product_show', compact('categories', 'products'));
    }




    // ==================SEARCH QUEARY ARE HERE====================
    public function search(Request $request)
    {
        $search = $request->search;
        $products = Product::where('status', 1)->latest()->get();
        $categories = Category::where('status', 1)->latest()->get();
        $lst_product = Product::where('status', 1)->limit(3)->get();
        $products = Product::where('product_name', 'like', '%' . $search . '%')->get();
        // ->orwhere('foodname', 'like', '%' . $search . '%')

        return view('frontendPages.index', compact('products', 'categories', 'lst_product'));
    }
}
