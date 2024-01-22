<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\StripeClient;

class StripeController extends Controller
{
    public function transfer(Request $request)
    {
        try {
            $stripe = new StripeClient(env('STRIPE_SECRET'));

            Log::info(intval($request['amount']));
            Log::info(User::find($request['user_id'])->stripe_account_id);
            Log::info($request['appointment_id']);


            $transfer =  $stripe->transfers->create([
                'amount' => intval($request['amount']),
                'currency' => 'eur',
                'destination' => User::find($request['user_id'])->stripe_account_id,
                'transfer_group' => 'APPOINTMENT_' . $request['appointment_id'],
            ]);
            Log::info($transfer);
            return response()->json('sucsess', 200);
        } catch (Exception $e) {
            Log::error($e);
            return response()->json($e->getMessage(), 500);
        }
    }
}
