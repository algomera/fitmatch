<?php

use App\Http\Controllers\api\ApiAuthController;
use App\Http\Controllers\api\AppointmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
});
Route::apiResources([
    '/appointments' => AppointmentController::class,
]);
Route::get('/get-appointments/{id}/{isAthlete}', [AppointmentController::class, 'getAppointments']);
Route::post('/register', [ApiAuthController::class, 'register']);
Route::post('/login', [ApiAuthController::class, 'login']);
