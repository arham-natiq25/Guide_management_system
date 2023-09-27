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
use App\Traits\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
class BasicsController extends Controller
{
    use Helper;
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

        $date= $request->date;
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
    // guide assign
        $res = new Reservation();
        // assign guide automatically
        $guideID = $this->assignGuide($trip);
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
    $res->guide_id =$guideID;
        $res->user_id = $user->id;
        $res->date = $request->date;
        $res->total_persons = $request->total_persons;
        $res->fname = $request->fname;
        $res->lname = $request->lname;
        $res->phone = $request->phone;
        $res->calculate_price = $calculatedfee;
        $res->tax = $tax;
        $res->meeting_time = $trip->start_time;
        $res->total_fee = $totalfee;
        $res->location_id = $request->location_id;
        $res->created_by = 'Frontend';
        $res->save();
        $user = User::where('email',$request->email)->first();
        toastr('Your reservation is created make your payment and enjoy your trip','success');
        // return view()
        // return view('frontend.summary',compact('date','trip','request','tax','totalfee','user'));
        //     $guide = Guide::findOrFail($request->guide_id);
    //       if ($randomPassword!=null) {
    //         $password = $randomPassword;
    //     }else{
    //         $password = 'You are exsisting user';
    //     }
    //      // HERE ARE THE DETAILS OF SENDING MAIL TO CUSTOMER
    //      $titleName="Reservation_confirmation";
    //      $emailTemplet = EmailTemplet::where('display_title',$titleName)->first();
    //      $cus =  $this->CusKey($emailTemplet,$res,$password);
    //      Mail::to($res->user->email)->send(new CustomerDetailSend($res,$cus,$emailTemplet));
    //      // HERE ARE THE DETAILS OF SENDING MAIL TO GUIDE
    //      $guideTitle="Guide_booking";
    //      $emailTemplet = EmailTemplet::where('display_title',$guideTitle)->first();
    //      $gui = $this->GuideKey($emailTemplet,$res);
    //      Mail::to($guide->user->email)->send(new GuideBookedMail($res,$gui,$emailTemplet));

    //      // ProcessPodcast::dispatch($guide,$res,$randomPassword);

        return redirect()->route('gms.home');



    }
    function summary() {
        return view('frontend.summary');
    }
}
