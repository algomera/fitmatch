<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Stripe\Stripe;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware([])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('home');
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('onboarding')->name('onboarding.')->group(function () {
        Route::get('/step-1', [\App\Http\Livewire\Onboarding\Step1::class, '__invoke'])->name('step-1');
        Route::get('/step-2', [\App\Http\Livewire\Onboarding\Step2::class, '__invoke'])->name('step-2');
        Route::get('/step-3', [\App\Http\Livewire\Onboarding\Step3::class, '__invoke'])->name('step-3');
        Route::get('/step-4', [\App\Http\Livewire\Onboarding\Step4::class, '__invoke'])->name('step-4');
        Route::get('/step-5', [\App\Http\Livewire\Onboarding\Step5::class, '__invoke'])->name('step-5');
        Route::get('/step-6', [\App\Http\Livewire\Onboarding\Step6::class, '__invoke'])->name('step-6');
        Route::get('/step-7', [\App\Http\Livewire\Onboarding\Step7::class, '__invoke'])->name('step-7');
        Route::get('/step-8', [\App\Http\Livewire\Onboarding\Step8::class, '__invoke'])->name('step-8');
        Route::get('/step-9', [\App\Http\Livewire\Onboarding\Step9::class, '__invoke'])->name('step-9');
        Route::get('/step-10', [\App\Http\Livewire\Onboarding\Step10::class, '__invoke'])->name('step-10');
        Route::get('/step-11', [\App\Http\Livewire\Onboarding\Step11::class, '__invoke'])->name('step-11');
        Route::get('/step-12', [\App\Http\Livewire\Onboarding\Step12::class, '__invoke'])->name('step-12');
    });

    Route::get('/subscribe', [\App\Http\Livewire\Onboarding\Subscribe::class, '__invoke'])->name('subscribe');
    Route::get('/subscription-ok', function () {
        if (auth()->user()->subscribed()) {
            return redirect()->route('personal-trainer.dashboard');
        }
    })->name('subscription-ok');
    Route::get('/subscription-failed', function () {
        return "Iscrizione fallita, riprova.";
    })->name('subscription-failed');


    Route::middleware(['verified', 'onboarding'])->group(function () {
        // Admin
        Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
            Route::get('/dashboard', function () {
                return view('dashboard');
            })->name('dashboard');
            Route::get('/requests', [
                \App\Http\Livewire\PersonalTrainer\Requests\Index::class, '__invoke'
            ])->name('requests');
            Route::get('/personal-trainer/{user}', [
                \App\Http\Livewire\PersonalTrainer\Show::class, '__invoke'
            ])->name('personal-trainer.show');
            Route::get('/exercises', [
                \App\Http\Livewire\PersonalTrainer\Exercises\Index::class, '__invoke'
            ])->name('exercises');
        });
        // Personal Trainer
        Route::middleware([
            'role:personal-trainer',
            // 'subscriber' //TODO: decommentare
        ])->prefix('personal-trainer')->name('personal-trainer.')->group(function () {
            Route::get('/dashboard', [
                \App\Http\Livewire\PersonalTrainer\Dashboard::class, '__invoke'
            ])->name('dashboard');
            Route::get('/athletes', [
                \App\Http\Livewire\PersonalTrainer\Athletes\Index::class, '__invoke'
            ])->name('athletes');
            Route::get('/athletes/{user}/performance', [
                \App\Http\Livewire\PersonalTrainer\Athletes\Performance::class, '__invoke'
            ])->name('athlete.performance');
            Route::get('/workouts', [
                \App\Http\Livewire\PersonalTrainer\Workouts\Index::class, '__invoke'
            ])->name('workouts');
            Route::get('/workouts/{workout}', [
                \App\Http\Livewire\PersonalTrainer\Workouts\Show::class, '__invoke'
            ])->name('workout');
            Route::get('/workouts/{workout}/pdf', [
                \App\Http\Livewire\Workouts\Pdf::class, '__invoke'
            ])->name('workout.pdf');
            Route::get('/exercises', [
                \App\Http\Livewire\PersonalTrainer\Exercises\Index::class, '__invoke'
            ])->name('exercises');
            Route::get('/profile', [
                \App\Http\Livewire\PersonalTrainer\Profile\Edit::class, '__invoke'
            ])->name('profile');

            Route::get('/oauth/confirm', function (Request $request) {
                $token = $request->get('code');

                Stripe::setApiKey(env('STRIPE_SECRET'));
                $response = \Stripe\OAuth::token([
                    'grant_type' => 'authorization_code',
                    'code' => $token,
                ]);

                auth()->user()->update([
                    'stripe_account_id' => $response->stripe_user_id
                ]);

                return redirect()->route('personal-trainer.profile', ['currentTab' => 'account']);
            });

            Route::get('/billing', function (Request $request) {
                return $request->user()->redirectToBillingPortal(route('personal-trainer.dashboard'));
            })->name('billing');
        });
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
