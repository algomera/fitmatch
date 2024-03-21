<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\VideoGrant;

class TwilioTokenController extends Controller
{
    public function generateToken(Request $request)
    {
        // Validate request input
        $this->validate($request, [
            'identity' => 'required|string',
            'roomName' => 'required|string',
        ]);

        // Your Twilio credentials from the .env file
        $twilioAccountSid = env('TWILIO_ACCOUNT_SID');
        $twilioApiKey = env('TWILIO_API_KEY');
        $twilioApiSecret = env('TWILIO_API_SECRET');

        // Create an access token which we will sign and return to the client,
        // containing the grant we just created
        $token = new AccessToken(
            $twilioAccountSid,
            $twilioApiKey,
            $twilioApiSecret,
            3600, // Token duration
            $request->identity
        );

        // Grant access to Video
        $videoGrant = new VideoGrant();
        $videoGrant->setRoom($request->roomName);
        $token->addGrant($videoGrant);

        // Return generated token as JSON
        return response()->json(['token' => $token->toJWT()], 200);
    }
}
