<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupons=Coupon::all();
        return view('coupon.index',compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|max:200',
            'code'=>'required|max:200',
            'discount_type'=>'required',
            'discount'=>'required|integer',
            'start_date'=>'required',
            'expiry_date'=>'required',
            'status'=>'required'
        ]);
        Coupon::create([
            'title'=>$request->title,
            'code'=>$request->code,
            'discount_type'=>$request->discount_type,
            'discount'=>$request->discount,
            'start_date'=>$request->start_date,
            'expiry_date'=>$request->expiry_date,
            'status'=>$request->status,
        ]);
        toastr()->success('Data inserted successfully');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $coupon = Coupon::find($id);
        return view('coupon.edit',compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title'=>'required|max:200',
            'code'=>'required|max:200',
            'discount_type'=>'required',
            'discount'=>'required|integer',
            'start_date'=>'required',
            'expiry_date'=>'required',
            'status'=>'required'
        ]);
        Coupon::where('id',$id)->update([
            'title'=>$request->title,
            'code'=>$request->code,
            'discount_type'=>$request->discount_type,
            'discount'=>$request->discount,
            'start_date'=>$request->start_date,
            'expiry_date'=>$request->expiry_date,
            'status'=>$request->status,
        ]);
        toastr()->success('Data Updated successfully');
        return redirect()->route('coupons.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $coupon = Coupon::find($id);
        $coupon->delete();
        return response(['status'=> 'success', 'message'=>'Deleted successfully']);


    }
}
