<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setting =  Setting::first();
        return view('setting.index',compact('setting'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'site_name'=>'required|max:200',
            'sale_tax'=>'required|max:200',
            'start_date'=>'required',
            'end_date'=>'required'
        ]);
        $config = [
            'sale_tax'=>$request->sale_tax,
            'start_date'=>$request->start_date,
            'end_date'=>$request->end_date,
        ];
        $setting = new Setting();
        $setting->name =  $request->site_name;
        $setting->config =  $config;
        $setting->save();
        toastr('Updated Successfully','success');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'site_name'=>'required|max:200',
            'sale_tax'=>'required|max:200',
            'start_date'=>'required',
            'end_date'=>'required'
        ]);
        $config = [
            'sale_tax'=>$request->sale_tax,
            'start_date'=>$request->start_date,
            'end_date'=>$request->end_date,
        ];
        $setting = Setting::find($id);
        $setting->name =  $request->site_name;
        $setting->config =  $config;
        $setting->save();
        toastr('Updated Successfully','success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
