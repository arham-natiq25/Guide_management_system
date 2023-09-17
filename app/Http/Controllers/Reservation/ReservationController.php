<?php

namespace App\Http\Controllers\Reservation;

use App\Http\Controllers\Controller;
use App\Jobs\ProcessPodcast;
use App\Mail\CustomerDetailSend;
use App\Mail\GuideBookedMail;
use App\Models\EmailTemplet;
use App\Models\Guide;
use App\Models\Location;
use App\Models\Reservation;
use App\Models\Setting;
use App\Models\Trip;
use App\Models\User;
use App\traits\helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ReservationController extends Controller
{
    use helper;
    function index() {
          $reservations= Reservation::with('trip','guide')->get();
          return view('ReservationBlade.index',compact('reservations'));

    }
    function showTrip() {
        $trips = Trip::all();
        return view('ReservationBlade.trips',['trips'=>$trips]);
    }
    public function showSelectDate($id)
    {
        $setting=Setting::first();
        $trip = Trip::findOrFail($id);
        $startDate = date('m/d/Y', strtotime($setting->config['start_date']));
        $endDate = date('m/d/Y', strtotime($setting->config['end_date']));
        return view('ReservationBlade.select-date', [
            'trip' => $trip,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ]);
        }
    public function showReservationForm(Request $request, $id)
{
    $request->validate([
        'date'=>'required'
    ]);
    $tripId = $id;
    $date = $request->input('date');
    $guide = Guide::all();
    $location = Location::all();
    $trip = Trip::findOrFail($tripId);
    $reservations=Reservation::all();
    return view('ReservationBlade.create', ['trip' => $trip, 'date' => $date,'location'=>$location,'guides'=>$guide,'reservations'=>$reservations]);
}
function save(Request $request) {
    $user = User::where('email', $request->email)->first();
    $request->validate([
    'total_persons'=>'required|integer',
    'referred'=>'nullable',
    'guide_id'=>'required|integer',
    'host'=>'nullable',
    'fname'=>'required|max:200',
    'lname'=>'required|max:200',
    'email'=>'required|email|',
    'phone'=>'required|numeric',
    'calculated_price'=>'required|numeric',
    'rod_price'=>'required|numeric',
    'special_fee'=>'nullable|numeric',
    'tax'=>'required|numeric',
    'total_fee'=>'required|numeric',
    'location_id'=>'required|integer'
  ]);
        $randomPassword=null;
        if (!$user) {
       // Create a new user
            $randomPassword = Str::random(10);
            $user = new User();
            $user->email = $request->email;
            $user->password = $randomPassword;
            $user->name = $request->fname . ' ' . $request->lname;
            $user->role = 'customer';
            $user->save();
        }
        $res = new Reservation();
        $res->trip_id = $request->trip_id;
        $res->user_id = $user->id;
        $res->date = $request->date;
        $res->total_persons = $request->total_persons;
        $res->referred = $request->referred;
        $res->host = $request->host;
        $res->guide_id = $request->guide_id;
        $res->int_customer = empty(!$request->int_customer) ? $request->int_customer : 0;
        $res->fname = $request->fname;
        $res->lname = $request->lname;
        $res->phone = $request->phone;
        $res->notes = $request->notes;
        $res->automated_payment = empty(!$request->automated_payment) ? $request->automated_payment : 0;
        $res->return_customer = empty(!$request->return_customer) ? $request->return_customer : 0;
        $res->private_water = empty(!$request->private_water) ? $request->private_water : 0;
        $res->request_guide = empty(!$request->request_guide) ? $request->request_guide : 0;
        $res->complete_address = empty(!$request->complete_address) ? $request->complete_address : 0;
        $res->repeat_request = empty(!$request->repeat_request) ? $request->repeat_request : 0;
        $res->calculate_price = $request->calculated_price;
        $res->special_rate = empty(!$request->special_rate) ? $request->special_rate : 0;
        $res->rod_price = $request->rod_price;
        $res->special_price = $request->special_fee;
        $res->tax = $request->tax;
        $res->total_fee = $request->total_fee;
        $res->email_to_guest = empty(!$request->email_to_guest) ? $request->email_to_guest : 0;
        $res->email_to_guide = empty(!$request->email_to_guide) ? $request->email_to_guide : 0;
        $res->custom_customer_text = empty(!$request->custom_customer_text) ? $request->custom_customer_text : 0;
        $res->custom_guide_text = empty(!$request->custom_guide_text) ? $request->custom_guide_text : 0;
        $res->customer_details_text = empty(!$request->customer_details_text) ? $request->customer_details_text : 0;
        $res->guide_details_text = empty(!$request->guide_details_text) ? $request->guide_details_text : 0;
        $res->meeting_time = $request->meeting_time;
        $res->location_id = $request->location_id;
        $res->created_by = 'Admin';
        $res->save();
        if ($randomPassword!=null) {
            $password = $randomPassword;
        }else{
            $password = 'You are exsisting user';
        }
        $guide = Guide::findOrFail($request->guide_id);
        // HERE ARE THE DETAILS OF SENDING MAIL TO CUSTOMER
        $titleName="Reservation_confirmation";
        $emailTemplet = EmailTemplet::where('display_title',$titleName)->first();
        $emailBody = str_replace(['[customer_name]','[resort_name]','[lenght_of_trip]','[trip_date]','[guide_name]','[guide_phone]','[total]','[password]'],[$res->fname.' '.$res->lname , $res->location->location_name,
        $res->trip->length, $res->date,$res->guide->fname.' '.$res->guide->lname,$res->guide->mobile,$res->total_fee,$password ],$emailTemplet->notes);
        Mail::to($res->user->email)->send(new CustomerDetailSend($res,$emailBody,$emailTemplet));
        // HERE ARE THE DETAILS OF SENDING MAIL TO GUIDE
        $guideTitle="Guide_booking";
        $emailTemplet = EmailTemplet::where('display_title',$guideTitle)->first();
        $guideBody = str_replace(['[guide]','[trip_name]','[customer_name]','[customer_contact]',
        '[customer_email]','[date]','[location]','[time]'],
        [$res->guide->fname.' '.$res->guide->lname, $res->trip->trip_name, $res->fname.' '.$res->lname , $res->phone ,
         $res->user->email , $res->date , $res->location->location_name , $res->trip->start_time
        ],$emailTemplet->notes);
        Mail::to($guide->user->email)->send(new GuideBookedMail($res,$guideBody,$emailTemplet));

        // ProcessPodcast::dispatch($guide,$res,$randomPassword);
        // trip
        toastr('Data Inserted Successfully','success');
        return redirect()->route('reservations.home');
}
     public function edit(string $id){
        $guides = Guide::all();
        $location = Location::all();
        $reservations=Reservation::findOrFail($id);
        $resData= Reservation::all();
        return view('ReservationBlade.edit',compact('reservations','guides','location','resData'));
     }
     public function update(Request $request , string $id)
     {
         $res = Reservation::find($id);
         $user = User::find($res->user_id);
        $request->validate([
            'total_persons'=>'required|integer',
            'referred'=>'nullable',
            'guide_id'=>'required|integer',
            'host'=>'nullable',
            'fname'=>'required|max:200',
            'lname'=>'required|max:200',
            'email'=>'required|email',
            'phone'=>'required|numeric',
            'calculated_price'=>'required|numeric',
            'rod_price'=>'required|numeric',
            'special_fee'=>'nullable|numeric',
            'tax'=>'required|numeric',
            'total_fee'=>'required|numeric',
            'location_id'=>'required|integer'
          ]);
                $user->email = $request->email;
                $user->name = $request->fname . ' ' . $request->lname;
                $res->total_persons = $request->total_persons;
                $res->referred = $request->referred;
                $res->host = $request->host;
                $res->guide_id = $request->guide_id;
                $res->int_customer = empty(!$request->int_customer) ? $request->int_customer : 0;
                $res->fname = $request->fname;
                $res->lname = $request->lname;
                $res->phone = $request->phone;
                $res->notes = $request->notes;
                $res->automated_payment = empty(!$request->automated_payment) ? $request->automated_payment : 0;
                $res->return_customer = empty(!$request->return_customer) ? $request->return_customer : 0;
                $res->private_water = empty(!$request->private_water) ? $request->private_water : 0;
                $res->request_guide = empty(!$request->request_guide) ? $request->request_guide : 0;
                $res->complete_address = empty(!$request->complete_address) ? $request->complete_address : 0;
                $res->repeat_request = empty(!$request->repeat_request) ? $request->repeat_request : 0;
                $res->calculate_price = $request->calculated_price;
                $res->special_rate = empty(!$request->special_rate) ? $request->special_rate : 0;
                $res->rod_price = $request->rod_price;
                $res->special_price = $request->special_fee;
                $res->tax = $request->tax;
                $res->total_fee = $request->total_fee;
                $res->email_to_guest = empty(!$request->email_to_guest) ? $request->email_to_guest : 0;
                $res->email_to_guide = empty(!$request->email_to_guide) ? $request->email_to_guide : 0;
                $res->custom_customer_text = empty(!$request->custom_customer_text) ? $request->custom_customer_text : 0;
                $res->custom_guide_text = empty(!$request->custom_guide_text) ? $request->custom_guide_text : 0;
                $res->customer_details_text = empty(!$request->customer_details_text) ? $request->customer_details_text : 0;
                $res->guide_details_text = empty(!$request->guide_details_text) ? $request->guide_details_text : 0;
                $res->meeting_time = $request->meeting_time;
                $res->location_id = $request->location_id;
                $res->created_by = 'Admin';
                $res->save();
                toastr('Data Updated Successfully','success');
                return redirect()->route('reservations.home');

     }
     public function delete(string $id)
     {
        $reservations = Reservation::find($id);
        $reservations->delete();
        return response(['status'=> 'success', 'message'=>'Reservation Deleted successfully']);
     }


}
