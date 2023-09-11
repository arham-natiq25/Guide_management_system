<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Agency;
use App\Models\River;
use Illuminate\Http\Request;

class RiverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rivers= River::all();
        return view('river.index',compact('rivers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $agency = Agency::all();
        return view('river.create',compact('agency'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $request->validate([
        'river_name'=>'required|max:200',
        'agency_id'=>'nullable',
        'display_order'=>'required|integer'
       ]);
      $status = empty(!$request->status) ? 0 : 1;
       River::create([
        'river_name'=>$request->river_name,
        'agency_id'=>json_encode($request->agency_id),
        'status'=>$status,
        'display_order'=>$request->display_order,
       ]);
       toastr('Data created successfully','success');
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

        $agency = Agency::all();
        $river = River::findOrFail($id);
        return view('river.edit',compact('river','agency'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $request->validate([
            'river_name'=>'required|max:200',
            'agency_id'=>'nullable',
            'display_order'=>'required|integer'
           ]);
        $status = empty(!$request->status) ? 0 : 1;
        $river = River::findOrFail($id);
        $river->river_name =$request->river_name;
        $river->agency_id =json_encode($request->agency_id);
        $river->display_order =$request->display_order;
        $river->status =$status;
        $river->save();
        toastr('Data Updated successfully','success');
        return redirect()->route('rivers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $river = River::findOrFail($id);
        $river->delete();
        //  toastr("Successfully deleted",'success');
         return response(['status'=> 'success', 'message'=>'Deleted successfully']);
    }

}
