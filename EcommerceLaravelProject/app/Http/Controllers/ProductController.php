<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Psy\TabCompletion\Matcher\FunctionDefaultParametersMatcher;
use App\Models\Product;
use Carbon\Carbon;
use File;


use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function addproduct()
    {
        $all_category = Category::latest()->get();
        $all_brand = Brand::latest()->get();
        return view('admin.product.add_products', compact('all_category', 'all_brand'));
    }
    public function storeProduct(Request $request)
    {
        //   dd($request->all());
        $request->validate([
            'product_name' => 'required|max:25',
            'product_code' => 'required|max:25',
            'price' => 'required|max:25',
            'product_quantity' => 'required|max:25',
            'category_id' => 'required|max:25',
            'brand_id' => 'required|max:25',
            'short_description' => 'required',
            'long_description' => 'required',
            'image_one' => 'required|mimes:jpg,jpeg,png,gif,JPG,PNG,JPEG,GIF',
            'image_two' => 'required|mimes:jpg,jpeg,png,gif,JPG,PNG,JPEG,GIF',
            'image_three' => 'required|mimes:jpg,jpeg,png,gif,JPG,PNG,JPEG,GIF',

        ], [
            'category_id.required' => 'select category name',
            'brand_id.required' => 'select brand name'
        ]);
        $image_one = $request->file('image_one');
        $name_genaret = hexdec(uniqid()) . '.' . $image_one->getClientOriginalExtension();
        Image::make($image_one)->resize(270, 270)->save('fontend/img/product/uploads/' . $name_genaret);
        $img_url1 = "fontend/img/product/uploads/" . $name_genaret;

        $image_two = $request->file('image_two');
        $name_genaret = hexdec(uniqid()) . '.' . $image_two->getClientOriginalExtension();
        Image::make($image_two)->resize(270, 270)->save('fontend/img/product/uploads/' . $name_genaret);
        $img_url2 = "fontend/img/product/uploads/" . $name_genaret;

        $image_three = $request->file('image_three');
        $name_genaret = hexdec(uniqid()) . '.' . $image_three->getClientOriginalExtension();
        Image::make($image_three)->resize(270, 270)->save('fontend/img/product/uploads/' . $name_genaret);
        $img_url3 = "fontend/img/product/uploads/" . $name_genaret;
        Product::insert([
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'product_name' => $request->product_name,
            'product_slug' => strtolower(str_replace(' ', '-', $request->product_name)),
            'product_code' => $request->product_code,
            'product_quantity' => $request->product_quantity,
            'price' => $request->price,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'image_one' => $img_url1,
            'image_two' => $img_url2,
            'image_three' => $img_url3,
            'created_at' => Carbon::now(),

        ]);
        return back()->with('success', 'Product added successfully!');
    }
    // ===========================mange product  are start here=============
    public function manageproduct()
    {
        $all_product = Product::orderBy('id', 'DESC')->get();
        return view('admin.product.manage_product', compact('all_product'));
    }
    // =================edit product are start here===============================
    public function editproduct($id)
    {
        $edit_product = Product::findOrFail($id);
        $all_category = Category::latest()->get();
        $all_brand = Brand::latest()->get();
        return view('admin.product.edit_product', compact('edit_product', 'all_category', 'all_brand'));
    }
    // =====================update product=========================
    public function updateproduct(Request $request, $id)
    {
        Product::findOrFail($id)->update([
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'product_name' => $request->product_name,
            'product_slug' => strtolower(str_replace(' ', '-', $request->product_name)),
            'product_code' => $request->product_code,
            'product_quantity' => $request->product_quantity,
            'price' => $request->price,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'created_at' => Carbon::now(),

        ]);
        return redirect()->route('manage.products')->with('success', 'Product added successfully!');
    }
    // =========================update_Image=========================

    public function deleteproduct($id)
    {
        $image = Product::findOrFail($id);
        $image_one = $image->image_one;
        $image_two = $image->image_two;
        $image_three = $image->image_three;
        unlink($image_one);
        unlink($image_two);
        unlink($image_three);
        Product::findOrFail($id)->delete();
        return redirect()->back()->with('delete', 'deleted successfully');
    }
    public function imageUpdate(Request $request)
    {
        $product_id = $request->id;
        $old_one = $request->img_one;
        $old_two = $request->img_two;
        $old_three = $request->img_three;
        // ===========image_one

        if ($request->has('image_one') && $request->has('image_two') && $request->has('image_two')) {
            unlink($old_one);
            unlink($old_two);
            unlink($old_three);
            $image_one = $request->file('image_one');
            $name_genaret = hexdec(uniqid()) . '.' . $image_one->getClientOriginalExtension();
            Image::make($image_one)->resize(270, 270)->save('fontend/img/product/uploads/' . $name_genaret);
            $img_url1 = "fontend/img/product/uploads/" . $name_genaret;

            Product::findOrFail($product_id)->update([
                'image_one' => $img_url1,
                'updated_at' => Carbon::now(),
            ]);
            // ===========image_two

            $image_two = $request->file('image_two');
            $name_genaret = hexdec(uniqid()) . '.' . $image_two->getClientOriginalExtension();
            Image::make($image_two)->resize(270, 270)->save('fontend/img/product/uploads/' . $name_genaret);
            $img_url1 = "fontend/img/product/uploads/" . $name_genaret;

            Product::findOrFail($product_id)->update([
                'image_two' => $img_url1,
                'updated_at' => Carbon::now(),
            ]);
            // ===========image_three
            $image_three = $request->file('image_three');
            $name_genaret = hexdec(uniqid()) . '.' . $image_three->getClientOriginalExtension();
            Image::make($image_three)->resize(270, 270)->save('fontend/img/product/uploads/' . $name_genaret);
            $img_url1 = "fontend/img/product/uploads/" . $name_genaret;

            Product::findOrFail($product_id)->update([
                'image_three' => $img_url1,
                'updated_at' => Carbon::now(),
            ]);





            return redirect()->route('manage.products')->with('success', 'image updatd successfully');
        }
        if ($request->has('image_one')) {
            unlink($old_one);
            $image_one = $request->file('image_one');
            $name_genaret = hexdec(uniqid()) . '.' . $image_one->getClientOriginalExtension();
            Image::make($image_one)->resize(270, 270)->save('fontend/img/product/uploads/' . $name_genaret);
            $img_url1 = "fontend/img/product/uploads/" . $name_genaret;

            Product::findOrFail($product_id)->update([
                'image_one' => $img_url1,
                'updated_at' => Carbon::now(),
            ]);
            return redirect()->route('manage.products')->with('success', 'image updatd successfully');
        }
        if ($request->has('image_two')) {
            unlink($old_two);
            $image_two = $request->file('image_two');
            $name_genaret = hexdec(uniqid()) . '.' . $image_two->getClientOriginalExtension();
            Image::make($image_two)->resize(270, 270)->save('fontend/img/product/uploads/' . $name_genaret);
            $img_url1 = "fontend/img/product/uploads/" . $name_genaret;

            Product::findOrFail($product_id)->update([
                'image_two' => $img_url1,
                'updated_at' => Carbon::now(),
            ]);
            return redirect()->route('manage.products')->with('success', 'image updatd successfully');
        }
        if ($request->has('image_three')) {
            unlink($old_three);
            $image_three = $request->file('image_three');
            $name_genaret = hexdec(uniqid()) . '.' . $image_three->getClientOriginalExtension();
            Image::make($image_three)->resize(270, 270)->save('fontend/img/product/uploads/' . $name_genaret);
            $img_url1 = "fontend/img/product/uploads/" . $name_genaret;

            Product::findOrFail($product_id)->update([
                'image_three' => $img_url1,
                'updated_at' => Carbon::now(),
            ]);
            return redirect()->route('manage.products')->with('success', 'image updatd successfully');
        }






        // ==================ANOTHER WAY TO UPDATE IMAGE===========================
        // $product_id = $request->id;
        // $old_one = $request->image_one;
        // // $old_two = $request->image_two;
        // // $old_three = $request->image_three;

        // $request->validate([
        //     'image_one' => 'required',
        // ]);
        // if ($request->has('image_one')) {

        //     $existProduct = Product::find($product_id);
        //     $existing_image_one = $existProduct->image_one;
        //     $image_one = $request->file('image_one');
        //     $name_genaret = hexdec(uniqid()) . '.' . $image_one->getClientOriginalExtension();
        //     Image::make($image_one)->resize(270, 270)->save('fontend/img/product/uploads/' . $name_genaret);
        //     $img_url1 = "fontend/img/product/uploads/" . $name_genaret;
        //     Product::findOrFail($product_id)->update([
        //         'image_one' => $img_url1,
        //         'updated_at' => Carbon::now(),
        //     ]);
        //     if ($existing_image_one) {
        //         if (File::exists(public_path() . '/' . $existing_image_one)) unlink(public_path() . '/' . $existing_image_one);
        //     }
        //     return "ok";
        // }
    }
    // ========================Deactive Product =========================
    public function deactiveproduct($id)
    {
        Product::find($id)->update([
            'status' => '0',

        ]);
        return redirect()->back();
    }
    // ========================Deactive Product =========================
    public function activeproduct($id)
    {
        Product::find($id)->update([
            'status' => '1',

        ]);
        return redirect()->back();
    }
}
