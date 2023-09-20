<?php

namespace App\Http\Controllers\Frontend;

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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
class BasicsController extends Controller
{
    function index() {
        $trips = Trip::all();
        return view('frontend.index',compact('trips'));
    }
    function selectDate( string $id)
    {
        $trip = Trip::find($id);
        $setting = Setting::first();
        $startDate = $setting->config['start_date'];
        $endDate = $setting->config['end_date'];
        return view('frontend.selectdate',compact('trip','startDate','endDate'));
    }
    function customer(Request $request , $id) {
        $request->validate([
            'date'=>'required'
        ]);

        $tripId = $id;
        $date = $request->date;
        $trip=Trip::find($tripId);
        $guides=Guide::all();
        $locations=Location::all();
        $reservations=Reservation::all();

        return view('frontend.customer-details',compact('trip','guides','date','locations','reservations'));

    }
    function savedata(Request $request)
    {
        $reservations= Reservation::all();
        $guides=Guide::all();
        $trip=Trip::find($request->trip_id);
        $user = User::where('email', $request->email)->first();
        $request->validate([
        'total_persons'=>'required|integer',
        'fname'=>'required|max:200',
        'lname'=>'required|max:200',
        'email'=>'required|email|',
        'phone'=>'required|integer',
        'location_id'=>'required|integer'
        ]);
        $res = new Reservation();
        // guide assign
        foreach($guides as $guide){

            $isAvailable = true;

                foreach ($reservations as $reservation) {
                    if ($reservation->guide_id === $guide->id &&
                        $reservation->date === request('date')) {

                        if ($trip->length === 'fullday') {
                            $isAvailable = false;
                        } elseif ($trip->length === 'morning' && ($reservation->trip->length === 'morning' || $reservation->trip->length === 'fullday')) {
                            $isAvailable = false;
                        } elseif ($trip->length === 'evening' && ($reservation->trip->length === 'evening' || $reservation->trip->length === 'fullday')) {
                            $isAvailable = false;
                        }
                    }
                }

                if ($isAvailable) {
                    // Automatically assign the first available guide and break the loop
                    $guideID = $guide->id;
                    $res->guide_id = $guideID;
                    break;
                }

            }


      // fee calculation
      $calculatedfee =  $request->total_persons*$trip->price_1_person;
      $tax = $calculatedfee*5/100;
      $totalfee = $calculatedfee+$tax;
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
        $res->trip_id = $request->trip_id;
        $res->user_id = $user->id;
        $res->date = $request->date;
        $res->total_persons = $request->total_persons;
        $res->fname = $request->fname;
        $res->lname = $request->lname;
        $res->phone = $request->phone;
        $res->calculate_price = $calculatedfee;
        $res->tax = $tax;
        $res->total_fee = $totalfee;
        $res->location_id = $request->location_id;
        $res->created_by = 'Frontend';
        $res->save();
        $guide = Guide::findOrFail($request->guide_id);
          if ($randomPassword!=null) {
            $password = $randomPassword;
        }else{
            $password = 'You are exsisting user';
        }
         // HERE ARE THE DETAILS OF SENDING MAIL TO CUSTOMER
         $titleName="Reservation_confirmation";
         $emailTemplet = EmailTemplet::where('display_title',$titleName)->first();
         $cus =  $this->CusKey($emailTemplet,$res,$password);
         Mail::to($res->user->email)->send(new CustomerDetailSend($res,$cus,$emailTemplet));
         // HERE ARE THE DETAILS OF SENDING MAIL TO GUIDE
         $guideTitle="Guide_booking";
         $emailTemplet = EmailTemplet::where('display_title',$guideTitle)->first();
         $gui = $this->GuideKey($emailTemplet,$res);
         Mail::to($guide->user->email)->send(new GuideBookedMail($res,$gui,$emailTemplet));

         // ProcessPodcast::dispatch($guide,$res,$randomPassword);

        toastr('Data Inserted Successfully','success');
        return redirect()->route('gms.home');



    }
}
