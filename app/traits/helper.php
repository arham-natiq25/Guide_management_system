<?php

namespace App\Traits;

use App\Models\Guide;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

trait Helper
{
    function isAdmin()
    {
        if (Auth::user()->role == 'admin') {
            return 'admin';
        }
    }

    function isGuide()
    {
        if (Auth::user()->role == 'guide') {
            return 'guide';
        }
    }

    function isCustomer()
    {
        if (Auth::user()->role == 'customer') {
            return 'customer';
        }
    }
    function assignGuide($trip) {
        $reservations = Reservation::all();
        $guides = Guide::all();
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
                            break;
                            // $res->guide_id = $guideID;
                        }

                    }
                    return $guideID;
    }
}
