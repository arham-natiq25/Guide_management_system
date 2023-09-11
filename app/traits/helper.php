<?php

namespace App\Traits;

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
}
