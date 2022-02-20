<?php

namespace App\Http\Controllers;

use App\Models\Cupon;
use Illuminate\Http\Request;

class CuponController extends Controller
{
    public function index()
    {
        $all_cupon = Cupon::latest()->get();
        return view('admin.cupon.index', compact('all_cupon'));
    }
    public function insertCupon(Request $request)
    {
        $request->validate([
            'cupon_name' => 'required|unique:cupons,cupon_name',
        ]);
        $cuponIsrt = new Cupon();
        $cuponIsrt->cupon_name = $request->cupon_name;
        $cuponIsrt->discount = $request->discount;
        $cuponIsrt->save();
        return redirect()->back()->with('insertCupon', 'Cupon added successfully');
    }
    public function edit($id)
    {
        $editcupon = Cupon::findOrFail($id);
        return view('admin.cupon.edit', compact('editcupon'));
    }
    public function update(Request $request)
    {
        $id = $request->id;
        $update_cupon = Cupon::findOrFail($id);
        $update_cupon->cupon_name = $request->cupon_name;
        $update_cupon->discount = $request->discount;
        $update_cupon->save();
        return redirect()->route('cupon.index')->with('updatecupon', 'cupon udated successfuly');
    }
    // =========deleted Cupon==========
    public function delete($id)
    {
        $deletedCupon = Cupon::findOrFail($id);
        $deletedCupon->delete();
        return redirect()->back()->with('deletecupon', 'cupon deleted successfully');
    }
    // ===============deactive cupon=================
    public function deactive($id)
    {
        Cupon::findOrFail($id)->update([
            'status' => '0',

        ]);
        return back()->with('deactive', 'Cupon deactived successfully');
    }
    // ===============active cupon=================
    public function active($id)
    {
        Cupon::findOrFail($id)->update([
            'status' => '1',

        ]);
        return back()->with('active', 'Cupon actived successfully');
    }
}
