<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with('guide')->get(); // Fetch reservations with guide info

        // Convert date strings to JavaScript-friendly format
        $formattedReservations = $reservations->map(function ($reservation) {
            return [
                'guide_name' => $reservation->guide->fname.$reservation->guide->lname,
                'date' => date('m/d/Y', strtotime($reservation->date)),
                'color'=>$reservation->guide->color
            ];
        });

        return view('calendar.index', compact('formattedReservations'));
    }
}
