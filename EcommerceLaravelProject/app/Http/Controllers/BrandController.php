<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $all_brand = Brand::latest()->get();
        return view('/admin.brand.index', compact('all_brand'));
    }
    public function insertbrand(Request $request)
    {
        $request->validate([
            'brand_name' => 'required|unique:brands,brand_name',
        ]);
        // Category::insert([
        //     'brand_name' => $request->brand_name,
        //     'created_at' => Carbon::now(),
        // ]);
        $add_brand = new Brand();
        $add_brand->brand_name = $request->brand_name;
        //  $add_brand->created_at = $request->Carbon::now();
        $add_brand->save();
        return redirect()->back()->with('inserCate', 'brand added successfully!');
    }
    public function edit($id)
    {
        $editbrand = Brand::find($id);
        return view('admin.brand.edit', compact('editbrand'));
    }
    public function update(Request $request)
    {
        $id = $request->id;
        Brand::find($id)->update([
            'brand_name' => $request->brand_name,
            'updated_at' => Carbon::now(),
        ]);
        return redirect('brand.index')->with('updatebrand', 'Brand updated successfuly!');

        // $updatebrand = Brand::find($id);
        // $updatebrand->brand_name = $request->brand_name;
        // $updatebrand->save();
        // return redirect()->back();

        // $updatabrand = Brand::find($id);
        // $updatabrand->brand_name = $request->brand_name;
        // $updatabrand->save();
        // return back()->with('brandInst', 'Your brand has been added successfully!');
    }
    public function delete($id)
    {
        $deletebrand = Brand::find($id);
        $deletebrand->delete();
        return back()->with('deletebrand', 'brand deleted successfully');
    }
    // public function deactive($id)
    // {
    //     Brand::find($id)->update([
    //         'status' => '0',
    //     ]);
    //     return back()->with('deactive', 'category deactived successfully');
    // }
    // public function active($id)
    // {
    //     Brand::find($id)->update(['status' => '1']);
    //     return back()->with('active', 'category actived succussfully');
    // }
    public function deactive($id)
    {
        Brand::find($id)->update(['status' => '0']);
        return back()->with('deactive', 'category deactived successfully');
    }
    public function active($id)
    {
        Brand::find($id)->update(['status' => '1']);
        return back()->with('active', 'category actived succussfully');
    }
}
