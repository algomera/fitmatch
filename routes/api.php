<?php

use App\Events\SimpleTestEvent;
use App\Http\Controllers\api\AnamnesiController;
use App\Http\Controllers\api\ApiAuthController;
use App\Http\Controllers\api\AppointmentController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;
use Pusher\Pusher;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/getData', [ApiAuthController::class, 'getData']);
    Route::apiResources([
        '/appointments' => AppointmentController::class
    ]);
    Route::apiResources([
        '/scheda-anamnesi' => AnamnesiController::class
    ]);
    Route::get('/get-appointments/{id}/{isAthlete}', [AppointmentController::class, 'getAppointments']);
    Route::post('/getAthletes', [UserController::class, 'getAthletes']);

    Route::post('/broadcasting/auth', function (Request $request) {
        $user = Auth::user(); // Authenticate the user
        $socketId = $request->input('socket_id');
        $channelName = $request->input('channel_name');
        // Log::info($user);
        // Log::info($socketId);
        // Log::info($channelName);
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            ['cluster' => env('PUSHER_APP_CLUSTER')]
        );

        if ($user) {
            // Authenticate the user's subscription to the channel
            $authData = $pusher->authorizeChannel($channelName, $socketId);
            $authDataArray = json_decode($authData, true);

            return response()->json(['auth' => $authDataArray['auth']]);
        } else {
            return response()->json(['message' => 'Forbidden'], 403);
        }
    });
});
Route::post('/register', [ApiAuthController::class, 'register']);
Route::post('/login', [ApiAuthController::class, 'login']);

Route::post('/messages', [MessageController::class, 'sendMessage']);
Route::get('/messages/{user1}/{user2}', [MessageController::class, 'fetchMessages']);
