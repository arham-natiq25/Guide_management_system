<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Trip;
use App\traits\ImageTrait;
use Illuminate\Http\Request;

class TripController extends Controller
{
    use ImageTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trips = Trip::all();
        $reservations = Reservation::all();
        return view('trip.index',compact('trips','reservations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('trip.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          $request->validate([
            'trip_name' =>['required','max:200'],
            'description' =>['required','max:200'],
            'length' =>['required'],
            'lunch'=>'required',
            'start_time'=>'required',
            'end_time'=>'required',
            'days'=>'required',
            'period'=>'required',
            'price_1_person'=>'required|numeric',
            'price_2_person'=>'required|numeric',
            'price_3_person'=>'required|numeric',
            'price_4_person'=>'required|numeric',
            'price_5_person'=>'required|numeric',
            'price_6_person'=>'required|numeric',
            'price_7_person'=>'required|numeric',
            'price_8_person'=>'required|numeric',
            'price_9_person'=>'required|numeric',
            'display_order'=>'required|integer',
            'image'=>[
             'required',
             'image',
             'max:4096'
            ],
            'tax'=>'required',
          ]);

          $trip = new Trip();
          $trip->trip_name =  $request->trip_name;
          $trip->description =  $request->description;
          $trip->lunch = ($request->lunch);
          $trip->length =  $request->length;
          $trip->start_time =  implode("-",$request->start_time);
          $trip->end_time =  implode("-",$request->end_time);
          $trip->days =  json_encode($request->days);
          $trip->period =  $request->period;
          $trip->price_1_person =  $request->price_1_person;
          $trip->price_1_person =  $request->price_1_person;
          $trip->price_2_person =  $request->price_2_person;
          $trip->price_3_person =  $request->price_3_person;
          $trip->price_4_person =  $request->price_4_person;
          $trip->price_5_person =  $request->price_5_person;
          $trip->price_6_person =  $request->price_6_person;
          $trip->price_7_person =  $request->price_7_person;
          $trip->price_8_person =  $request->price_8_person;
          $trip->price_9_person =  $request->price_9_person;
          $trip->display_order =  $request->display_order;
          $imgPath =$this->UploadImage($request,'image','uploads');
          $trip->image = $imgPath;
          $trip->status=empty(!$request->status) ? $request->status : 0;
          $trip->backend_only= empty(!$request->backend_only) ? $request->backend_only : 0;
          $trip->tax=$request->tax;
          $trip->save();

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
        $trip = Trip::findOrFail($id);
        return view('trip.edit',compact('trip'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'trip_name' =>['required','max:200'],
            'description' =>['required','max:200'],
            'length' =>['required'],
            'lunch'=>'required',
            'start_time'=>'required',
            'end_time'=>'required',
            'days'=>'required',
            'period'=>'required',
            'price_1_person'=>'required|numeric',
            'price_2_person'=>'required|numeric',
            'price_3_person'=>'required|numeric',
            'price_4_person'=>'required|numeric',
            'price_5_person'=>'required|numeric',
            'price_6_person'=>'required|numeric',
            'price_7_person'=>'required|numeric',
            'price_8_person'=>'required|numeric',
            'price_9_person'=>'required|numeric',
            'display_order'=>'required|integer',
            'image'=>[
             'nullable',
             'image',
             'max:4096'
            ],
            'tax'=>'required',
          ]);

          $trip = Trip::findOrFail($id);
          $trip->trip_name =  $request->trip_name;
          $trip->description =  $request->description;
          $trip->lunch = ($request->lunch);
          $trip->length =  $request->length;
          $trip->start_time =  implode("-",$request->start_time);
          $trip->end_time =  implode("-",$request->end_time);
          $trip->days =  json_encode($request->days);
          $trip->period =  $request->period;
          $trip->price_1_person =  $request->price_1_person;
          $trip->price_1_person =  $request->price_1_person;
          $trip->price_2_person =  $request->price_2_person;
          $trip->price_3_person =  $request->price_3_person;
          $trip->price_4_person =  $request->price_4_person;
          $trip->price_5_person =  $request->price_5_person;
          $trip->price_6_person =  $request->price_6_person;
          $trip->price_7_person =  $request->price_7_person;
          $trip->price_8_person =  $request->price_8_person;
          $trip->price_9_person =  $request->price_9_person;
          $trip->display_order =  $request->display_order;
          $imgPath =$this->updateImage($request,'image','uploads',$trip->image);
          $trip->image = empty(!$imgPath) ? $imgPath : $trip->image;
          $trip->status=empty(!$request->status) ? $request->status : 0;
          $trip->backend_only= empty(!$request->backend_only) ? $request->backend_only : 0;
          $trip->tax=$request->tax;
          $trip->save();

        toastr('Update succesfully','success');

        return redirect()->route('trips.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $trip = Trip::findOrFail($id);
        $this->deleteImage($trip->image);
        $trip->delete();
        //  toastr("Successfully deleted",'success');
        // return redirect()->back();

        return response(['status'=> 'success', 'message'=>'Deleted successfully']);

    }
}
