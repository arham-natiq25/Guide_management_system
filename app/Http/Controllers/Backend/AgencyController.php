<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Agency;
use Illuminate\Http\Request;

class AgencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agency = Agency::all();
        return view('agency.index',compact('agency'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('agency.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|max:200',
            'display_order'=>'required|integer'
           ]);
           Agency::create([
            'title'=>$request->title,
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
        $agency = Agency::find($id);
        return view('agency.edit',compact('agency'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title'=>'required|max:200',
            'display_order'=>'required|integer'
           ]);
           Agency::where('id',$id)->update([
            'title'=>$request->title,
            'display_order'=>$request->display_order,
           ]);
           toastr('Data updated successfully','success');
           return redirect()->route('agencies.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      $agency = Agency::findOrFail($id);
      $agency->delete();
      return response(['status'=> 'success', 'message'=>'Deleted successfully']);
    }
}
