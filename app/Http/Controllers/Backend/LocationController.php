<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locations =Location::all();
        return view('location.index',compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('location.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'location_name'=>'required|max:200',
            'url'=>'required|url',
            'display_order'=>'required|integer'
           ]);
        Location::create([
            'location_name' => $request->location_name,
            'url' => $request->url,
            'display_order'=>$request->display_order
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
        $location = Location::find($id);
        return view('location.edit',compact('location'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'location_name'=>'required|max:200',
            'url'=>'required|url',
            'display_order'=>'required|integer'
           ]);
        Location::where('id',$id)->update([
            'location_name' => $request->location_name,
            'url' => $request->url,
            'display_order'=>$request->display_order
        ]);
        toastr('Data updated successfully','success');
        return redirect()->route('locations.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $location =Location::findOrFail($id);
        $location->delete();

        return response(['status'=>'success','message'=>'Deleted Successfully']);
    }
}
