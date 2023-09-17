<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\EmailTemplet;
use Illuminate\Http\Request;

class EmailTempletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $templets = EmailTemplet::all();
        return view('EmailTemplet.index',compact('templets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('EmailTemplet.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|max:200',
            'subject'=>'required|max:200',
            'notes'=>'required',
        ]);
        EmailTemplet::create([
            'display_title'=>$request->title,
            'subject'=>$request->subject,
            'notes'=>$request->notes,
        ]);
        toastr()->success('Templet created successfully');
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $emails=EmailTemplet::find($id);
        return view('EmailTemplet.edit',compact('emails'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title'=>'required|max:200',
            'subject'=>'required|max:200',
            'notes'=>'required',
        ]);
        EmailTemplet::where('id',$id)->update([
            'display_title'=>$request->title,
            'subject'=>$request->subject,
            'notes'=>$request->notes,
        ]);
        toastr()->success('Templet updated successfully');
        return redirect()->route('email.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $email = EmailTemplet::find($id);
        $email->delete();
        return response(['status'=> 'success', 'message'=>'Deleted successfully']);

    }
}
