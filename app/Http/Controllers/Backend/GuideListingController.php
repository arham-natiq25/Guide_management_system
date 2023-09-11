<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Guide;
use App\Models\Guidelist;
use App\Models\Reservation;
use App\Models\User;
use App\traits\ImageTrait;
use Illuminate\Http\Request;

class GuideListingController extends Controller
{

    use ImageTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guides = Guide::with('user')->get();
        $reservations=Reservation::all();
        return view('guide.index',compact('guides','reservations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('guide.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
          'fname' =>    ['required','max:200'],
          'lname' =>    ['required','max:200'],
          'address1' => ['required','max:200'],
          'address2' => ['required','max:200'],
          'city' =>     ['required','max:200'],
          'state'=>    ['required','max:200'],
          'zip' =>     ['required'],
          'mobile'=>'required',
          'email'=>['required','email','unique:users,email'],
          'password'=>['required'],
          'guide_license'=>'required',
          'color'=>'required',
          'notes'=>'required|max:1000',
          'image'=>'required|image|max:4096',
          'display_order'=>'required|integer',
        ]);
        $user = new User();
        $user->email = $request->email;
        $user->password = $request->password; // Hash the password
        $user->name = $request->fname . ' ' . $request->lname;
        $user->role = 'guide';
        $user->save();

        $guide =  new Guide();
        $guide->user_id = $user->id;
        $guide->fname = $request->fname;
        $guide->lname = $request->lname;
        $guide->address1 = $request->address1;
        $guide->address2 = $request->address2;
        $guide->city = $request->city;
        $guide->state =$request->state;
        $guide->zip = $request->zip;
        $guide->mobile = $request->mobile;
        $guide->guide_license = $request->guide_license;
        $guide->color = $request->color;
        $guide->notes = $request->notes;
        // take img path from trait
        $imgPath = $this->UploadImage($request,'image','uploads');
        $guide->image = $imgPath;
        $guide->display_order = $request->display_order;
        $guide->emailcheck = empty(!$request->emailcheck) ? $request->emailcheck :0;
        $guide->status = empty(!$request->status) ? $request->status : 0;
        $guide->save();
        toastr('Created succesfully','success');

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
          $guide = Guide::findOrFail($id);
          return view('guide.edit',compact('guide'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $guide = Guide::findOrFail($id);
        $user = User::find($guide->user_id);
        $user->email = $request->email;
        $user->password = $request->password; // Hash the password
        $user->name = $request->fname . ' ' . $request->lname;
        $user->save();
        $request->validate([
            'fname' =>    ['required','max:200'],
            'lname' =>    ['required','max:200'],
            'address1' => ['required','max:200'],
            'address2' => ['required','max:200'],
            'city' =>     ['required','max:200'],
            'state'=>    ['required','max:200'],
            'zip' =>     ['required'],
            'mobile'=>'required',
            'email'=>['required','email','unique:users,email,'.$user->id],
            'password'=>['required'],
            'guide_license'=>'required',
            'color'=>'required',
            'notes'=>'required|max:1000',
            'image'=>'nullable|image|max:4096',
            'display_order'=>'required|integer',
          ]);


          $guide->fname = $request->fname;
          $guide->lname = $request->lname;
          $guide->address1 = $request->address1;
          $guide->address2 = $request->address2;
          $guide->city = $request->city;
          $guide->state =$request->state;
          $guide->zip = $request->zip;
          $guide->mobile = $request->mobile;
          $guide->guide_license = $request->guide_license;
          $guide->color = $request->color;
          $guide->notes = $request->notes;
          // take img path from trait
          $imgPath = $this->updateImage($request,'image','uploads',$guide->image);
          $guide->image = empty(!$imgPath) ? $imgPath : $guide->image;
          $guide->display_order = $request->display_order;
          $guide->emailcheck = empty(!$request->emailcheck) ? $request->emailcheck :0;
          $guide->status = empty(!$request->status) ? $request->status : 0;
          $guide->save();
          toastr('Updated succesfully','success');

          return redirect()->route('guides.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $guide = Guide::findOrFail($id);
        $user = User::find($guide->user_id);
        $this->deleteImage($guide->image);
        $guide->delete();
        $user->delete();
        //  toastr("Successfully deleted",'success');
         return response(['status'=> 'success', 'message'=>'Deleted successfully']);

        }
}
