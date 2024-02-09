<?php

use App\Events\ChangeUserStatus;
use App\Http\Controllers\AgoraController;
use App\Http\Controllers\api\AnamnesiController;
use App\Http\Controllers\api\ApiAuthController;
use App\Http\Controllers\api\AppointmentController;
use App\Http\Controllers\api\EmailController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\api\WorkoutController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\StripeController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Pusher\Pusher;
use Stripe\StripeClient;

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
Route::post('/send-email', [EmailController::class, 'sendEmail']);
// Routes protected by 'auth:sanctum' middleware
Route::group(['middleware' => 'auth:sanctum'], function () {
    //services
    Route::get('/agora/token', [AgoraController::class, 'generateToken']);
    Route::post('/stripe-transfer', [StripeController::class, 'transfer']);
    Route::get('/getStripeKey', [StripeController::class, 'getKey']);

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
    Route::get('/show-workout/{id}', [WorkoutController::class, 'show']);
    Route::put('/updateWorkoutItems', [WorkoutController::class, 'updateItems']);

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
            // Generate the authorization data including the 'user_id'
            $channelData = json_encode(['user_id' => $user->id]); // Convert to JSON

            // Use $channelData as the third parameter for authorizeChannel
            $authData = $pusher->authorizeChannel($channelName, $socketId, $channelData);

            // Convert $authData to an array
            $authDataArray = json_decode($authData, true);

            // Return the 'auth' key as a string and 'user_id' as a string or null
            return response()->json([
                'auth' => $authDataArray['auth'],
                'user_id' => $user->id,
            ]);
        } else {
            return response()->json(['message' => 'Forbidden'], 403);
        }
    });
    Route::post('/update-status', function (Request $request) {

        try {
            $validatedData = $request->validate([
                'id' => 'required|integer|exists:users,id',
                'status' => 'required',
            ]);

            $id = $validatedData['id'];
            $status = $validatedData['status'];

            $user = User::find($id);
            $user->update(['is_online' => $status]);


            event(new ChangeUserStatus($id, $status));

            return response()->json(['message' => 'Status updated']);
        } catch (\Exception $e) {

            return response()->json(['message' => 'Server Error'], 500);
        }
    });
    // Messages
    Route::post('/messages', [MessageController::class, 'sendMessage']);
    Route::get('/getLatestMessages/{id}', [MessageController::class, 'getLatestMessages']);
    Route::get('/messages/{user1}/{user2}/{page}', [MessageController::class, 'fetchMessages']);
});
