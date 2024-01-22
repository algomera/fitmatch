<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Cargo;
use App\Models\Recovery;
use App\Models\Repetition;
use App\Models\User;
use App\Models\Workout;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WorkoutController extends Controller
{
    public function index($id)
    {
        $current_user = User::find($id);

        if ($current_user) {
            $user_role = $current_user->getRoleAttribute()->name;

            if ($user_role == 'personal-trainer') {
                $workouts = $current_user->personal_trainer_workouts()
                    ->load(['athlete', 'goal']);
            } else {
                $workouts = $current_user->athlete_workouts()
                    ->with(['personal_trainer', 'goal'])
                    ->get();
            }

            return response()->json($workouts);
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    }

    public function show($id)
    {
        $workoutModel = Workout::find($id);
        $workout_weeks = $workoutModel->workout_weeks;
        $workout = [];
        foreach ($workout_weeks as $week) {
            $week_label = str_pad($week->week, 2, "0", STR_PAD_LEFT);
            // $workout[$week_label] = [];
            foreach ($week->workout_days as $day) {
                $workout[$week_label][$day->day] = [];
                $workout[$week_label][$day->day] = ['label' => config('fitmatch.days.' . $day->day)];
                $i = 1;
                foreach ($day->workout_sets as $set) {
                    $iteration = str_pad($i, 2, "0", STR_PAD_LEFT);
                    $i++;

                    $workout[$week_label][$day->day][$iteration] = [];
                    foreach ($set->workout_series as $serie) {
                        $workout[$week_label][$day->day][$iteration]['items'] = [];
                        foreach ($serie->items as $item) {
                            switch ($item->item_type) {
                                case 'App\\Models\\Exercise':
                                    $item->load(['exercise', 'intensity']);
                                    break;
                                case 'App\\Models\\Repetition':
                                    $item->load('repetition');
                                    break;
                                case 'App\\Models\\Recovery':
                                    $item->load('recovery');
                                    break;
                                case 'App\\Models\\Cargo':
                                    $item->load('cargo');
                                    break;
                            }

                            $workout[$week_label][$day->day][$iteration]['items'][] = $item;
                        }
                    }
                }
            }
        }
        // config('fitmatch.days.1')
        $workoutModel->unsetRelation('workout_weeks');
        return response()->json(['info' => $workoutModel, 'workout' => $workout]);
    }

    public function updateItems(Request $request)
    {
        // Start transaction
        DB::beginTransaction();

        try {
            if ($request['cargo_id'] !== null && $request['cargo_id'] !== 'null') {
                $cargo = Cargo::findOrFail($request['cargo_id']);
                $cargo->update([
                    'executed' => $request['cargo_executed'],
                    'freestyle' => $request['cargo_freestyle']
                ]);
            }

            if ($request['reps_id'] !== null && $request['reps_id'] !== 'null') {
                $repetition = Repetition::findOrFail($request['reps_id']);
                $repetition->update(['executed' => $request['reps_executed']]);
            }

            if ($request['recovery_id'] !== null && $request['recovery_id'] !== 'null') {
                $recovery = Recovery::findOrFail($request['recovery_id']);
                $recovery->update(['executed' => $request['recovery_executed']]);
            }

            DB::commit();

            return response()->json(['message' => 'Items aggiornati'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Qualcosa è andato storto', 'error' => $e->getMessage()], 500);
        }
    }
}
