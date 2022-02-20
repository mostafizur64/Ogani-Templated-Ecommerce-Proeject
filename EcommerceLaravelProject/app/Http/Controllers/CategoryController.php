<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
use Symfony\Component\Routing\RequestContextAwareInterface;
use Carbon\Carbon;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $all_category = Category::latest()->get();
        return view('/admin.category.index', compact('all_category'));
    }
    public function insertcategory(Request $request)
    {
        $request->validate([
            'category_name' => 'required|unique:categories,category_name',
        ]);
        // Category::insert([
        //     'category_name' => $request->category_name,
        //     'created_at' => Carbon::now(),
        // ]);
        $add_category = new Category();
        $add_category->category_name = $request->category_name;
        //  $add_category->created_at = $request->Carbon::now();
        $add_category->save();
        return redirect()->back()->with('inserCate', 'Category added successfully!');
    }
    public function edit($id)
    {
        $editcategory = Category::find($id);
        return view('admin.category.edit', compact('editcategory'));
    }
    public function update(Request $request)
    {
        $id = $request->id;
        Category::find($id)->update([
            'category_name' => $request->category_name,
            'updated_at' => Carbon::now(),
        ]);
        return redirect('category.index')->with('updatecategory', 'Cateory updated successfuly!');

        // $updatecategory = Category::find($id);
        // $updatecategory->category_name = $request->category_name;
        // $updatecategory->save();
        // return redirect()->back();

        // $updatacategory = Category::find($id);
        // $updatacategory->category_name = $request->category_name;
        // $updatacategory->save();
        // return back()->with('categoryInst', 'Your Category has been added successfully!');
    }
    public function delete($id)
    {
        $deletecategory = Category::find($id);
        $deletecategory->delete();
        return back()->with('deletecategory', 'category deleted successfully');
    }
    public function deactive($id)
    {
        Category::find($id)->update([
            'status' => '0',
        ]);
        return back()->with('deactive', 'category deactived successfully');
    }
    public function active($id)
    {
        Category::find($id)->update(['status' => '1']);
        return back()->with('active', 'category actived succussfully');
    }
}
