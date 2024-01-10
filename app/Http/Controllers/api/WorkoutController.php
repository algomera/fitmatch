<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Workout;
use Illuminate\Http\Request;

class WorkoutController extends Controller
{
    public function index($id)
    {
        $current_user = User::find($id);
        $user_role = $current_user->getRoleAttribute()->name;

        if ($user_role == 'personal-trainer') {
            $workouts = $current_user->personal_trainer_workouts->load(['workout_weeks', 'sets', 'workout_days', 'athlete', 'goal']);
        } else {
            $workouts = $current_user->athlete_workouts->load(['workout_weeks', 'sets', 'workout_days', 'personal_trainer', 'goal']);
        }
        return response()->json($workouts);
    }
}
