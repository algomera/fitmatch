<?php

    use App\Http\Controllers\ProfileController;
    use Illuminate\Support\Facades\Route;

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
        Route::middleware(['verified', 'onboarding'])->group(function () {
            Route::get('/dashboard', function () {
                return view('dashboard');
            })->name('dashboard');
        });
    });

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    require __DIR__ . '/auth.php';
