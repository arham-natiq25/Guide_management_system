<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerLoginController extends Controller
{
    function index()
    {
        return view('customers.dashboard');
    }
    function reservation() {
        $reservations= Reservation::where('user_id',Auth::user()->id)->with('trip','guide')->get();
        return view('customers.reservation',compact('reservations'));
    }
}
