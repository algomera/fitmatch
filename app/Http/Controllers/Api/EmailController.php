<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\SendEmail;
use App\Mail\SendInviteEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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

        $emailContent = request()->getSchemeAndHttpHost().'/login';
        Mail::to($userEmail)->send(new SendEmail($emailContent));

        return response()->json(['message' => 'Email sent successfully'], 200);
    }

    public function sendInviteEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'name' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Invalid email address'], 400);
        }

        $userEmail = $request->email;

        $link = request()->getSchemeAndHttpHost() . '/register';
        $ptName = $request->name;
        Mail::to($userEmail)->send(new SendInviteEmail($link, $ptName));

        return response()->json(['message' => 'Email sent successfully'], 200);
    }
}
