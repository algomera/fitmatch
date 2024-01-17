<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmailController extends Controller
{
    public function sendEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Invalid email address'], 400);
        }

        $userEmail = $request->email;

        $emailContent = request()->getSchemeAndHttpHost() . '/login';
        Mail::to($userEmail)->send(new SendEmail($emailContent));

        return response()->json(['message' => 'Email sent successfully'], 200);
    }
}
