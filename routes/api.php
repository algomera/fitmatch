<?php

use App\Http\Controllers\api\AnamnesiController;
use App\Http\Controllers\api\ApiAuthController;
use App\Http\Controllers\api\AppointmentController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\api\WorkoutController;
use App\Http\Controllers\MessageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

// Authentication routes
Route::post('/register', [ApiAuthController::class, 'register']);
Route::post('/login', [ApiAuthController::class, 'login']);

// Routes protected by 'auth:sanctum' middleware
Route::group(['middleware' => 'auth:sanctum'], function () {
    // User data retrieval
    Route::get('/getData/{id}', [ApiAuthController::class, 'getData']);

    // Appointments
    Route::apiResources([
        '/appointments' => AppointmentController::class,
    ]);
    Route::put('/confirmAppointment', [AppointmentController::class, 'confirmAppointment']);
    Route::get('/get-appointments/{id}/{isAthlete}', [AppointmentController::class, 'getAppointments']);
    Route::put('/denyAppointment', [AppointmentController::class, 'denyAppointment']);

    // Anamnesi
    Route::apiResources(['/scheda-anamnesi' => AnamnesiController::class]);
    Route::post('/anamnesi/create_request', [AnamnesiController::class, 'createRequest']);
    Route::post('/anamnesi/accept_request', [AnamnesiController::class, 'acceptRequest']);
    Route::put('/anamnesi/deny_request', [AnamnesiController::class, 'denyRequest']);
    Route::get('/anamnesi/showAllRequests/{id}', [AnamnesiController::class, 'showAllRequests']);

    // User Management
    Route::get('/getAthletes/{id}', [UserController::class, 'getAthletes']);
    Route::get('/getAthletesRequests/{id}', [UserController::class, 'getAthletesRequests']);
    Route::post('/attachAthletePersonalTrainer', [UserController::class, 'attachAthletePersonalTrainer']);
    Route::put('/acceptContactRequest', [UserController::class, 'acceptContactRequest']);
    Route::put('/denyContactRequest', [UserController::class, 'denyContactRequest']);
    Route::post('/uploadProfilePicture', [UserController::class, 'uploadProfilePicture']);
    Route::apiResources([
        '/users' => UserController::class,
    ]);

    //Workouts Managmeent
    Route::get('/workouts/{id}', [WorkoutController::class, 'index']);

    // Broadcasting Authentication
    Route::post('/broadcasting/auth', function (Request $request) {
        $user = Auth::user(); // Authenticate the user
        $socketId = $request->input('socket_id');
        $channelName = $request->input('channel_name');

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

    // Messages
    Route::post('/messages', [MessageController::class, 'sendMessage']);
    Route::get('/messages/{user1}/{user2}/{page}', [MessageController::class, 'fetchMessages']);
});
