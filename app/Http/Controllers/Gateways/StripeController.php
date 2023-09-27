<?php

namespace App\Http\Controllers\Gateways;

use App\Http\Controllers\Controller;
use App\Models\PaymentStripe;
use App\Models\StripePayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Stripe\Charge;
use Stripe\Stripe;
use Stripe\Token;

class StripeController extends Controller
{
    public function payment(Request $request)
{
    Stripe::setApiKey(config('stripe.sk'));
    // $token = $request->input('stripeToken');
    // $token = $request->input('stripeToken');
    // $userId = $request->input('user_id');

    dd($request->all());
    // $charge = Charge::create([
    //     'amount' => $request->total * 100, // Amount in cents
    //     'currency' => 'usd',
    //     'source' => $token,
    //     'description' => 'Payment for Trip Booking',
    // ]);

    // Log::info($token);

    // try {
    //     // Create a charge using the token


    //     // Payment successful, save the payment token and user ID
    //     PaymentStripe::create([
    //         'user_id' => $userId,
    //         'payment_token' => $token,
    //     ]);

    //     // Redirect to a success page
    //     return redirect()->route('payment.success')->with('success', 'Payment was successful.');
    // } catch (\Exception $e) {
    //     // Payment failed
    //     return redirect()->route('payment.cancel')->with('error', $e->getMessage());
    // }
}

    public function success()
    {
        return  'Payment successfull';
    }

    public function cancel()
    {
        return view('frontend.failed');
    }


}
