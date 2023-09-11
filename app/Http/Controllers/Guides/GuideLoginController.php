<?php

namespace App\Http\Controllers\Guides;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuideLoginController extends Controller
{
    function index(){
        return view('GuideRoutes.dashboard');
    }
    function reservations() {
        $reservations= Reservation::where('guide_id',Auth::user()->guide->id)->with('trip','guide')->get();
        return view('GuideRoutes.reservation',compact('reservations'));
    }
}
