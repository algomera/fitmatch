<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Availabilities;
use App\Models\PersonalTrainerTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonalTrainerTimeController extends Controller
{
    public function sendTimes(Request $request)
    {
        try {
            $types = json_decode($request->input('types'));

            // Get the ID of the personal trainer from the request
            $personalTrainerId = $request->id;

            // Start a transaction to ensure data integrity
            DB::beginTransaction();

            // If the array in the request is empty, remove all rows with the personal_trainer_id
            if (empty($types)) {
                PersonalTrainerTime::where('personal_trainer_id', $personalTrainerId)->delete();
            } else {
                // Get all unique type titles from the request
                $requestTypeTitles = array_column($types, 'title');

                // Delete rows with types not included in the request
                PersonalTrainerTime::where('personal_trainer_id', $personalTrainerId)
                    ->whereNotIn('type', ['morning', 'afternoon', 'evening'])
                    ->delete();

                // Delete existing rows with matching personal_trainer_id and type that are not in the request
                PersonalTrainerTime::where('personal_trainer_id', $personalTrainerId)
                    ->whereNotIn('type', $requestTypeTitles)
                    ->delete();

                // Iterate over the types array and save/update rows
                foreach ($types as $type) {
                    // Check if a row with the same type already exists
                    $existingRow = PersonalTrainerTime::where('personal_trainer_id', $personalTrainerId)
                        ->where('type', $type->title)
                        ->first();

                    if ($existingRow) {
                        // Update the existing row
                        $existingRow->from = $type->from;
                        $existingRow->to = $type->to;
                        $existingRow->step = $request->step;
                        $existingRow->save();
                    } else {
                        // Create a new PersonalTrainerTime instance
                        $ptTime = new PersonalTrainerTime();
                        $ptTime->personal_trainer_id = $personalTrainerId;
                        $ptTime->type = $type->title;
                        $ptTime->from = $type->from;
                        $ptTime->to = $type->to;
                        $ptTime->step = $request->step;
                        $ptTime->save();
                    }
                }
            }

            // Commit the transaction
            DB::commit();

            return response()->json(['message' => 'Times set successfully']);
        } catch (\Exception $e) {
            // Rollback the transaction in case of an error
            DB::rollback();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function generateAvailabilities(Request $request)
    {
        try {
            $times = json_decode($request->input('availabilities'));

            foreach ($times as $time) {
                // Check if the date and time already exist
                $existingAvailability = Availabilities::where('personal_trainer_id', $request->id)
                    ->where('date', $request->date)
                    ->where('time', $time)
                    ->first();

                if (!$existingAvailability) {
                    $avl = new Availabilities();
                    $avl->personal_trainer_id = $request->id;
                    $avl->date = $request->date;
                    $avl->time = $time;
                    $avl->save();
                }
            }

            return response()->json(['message' => 'Availabilities generated'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function updateAvailabilities(Request $request)
    {
        try {
            $times = json_decode($request->input('availabilities'));

            $existingAvailabilities = Availabilities::where('personal_trainer_id', $request->id)
                ->where('date', $request->date)
                ->get();


            $existingTimes = $existingAvailabilities->pluck('time')->toArray();


            foreach ($times as $time) {
                // Format the time to match the format in the database ("hh:mm:ss")
                $formattedTime = substr($time, 0, 5) . ':00'; // Extract "hh:mm" from "hh:mm:ss"

                if (!in_array($formattedTime, $existingTimes)) {
                    $avl = new Availabilities();
                    $avl->personal_trainer_id = $request->id;
                    $avl->date = $request->date;
                    $avl->time = $formattedTime;
                    $avl->save();
                }
            }

            // Remove times from existing availabilities that are not in the request
            foreach ($existingAvailabilities as $existingAvailability) {
                // Convert the existing time to match the format in the request
                $existingTime = substr($existingAvailability->time, 0, 5); // Extract "hh:mm" from "hh:mm:ss"

                // Check if the time from the database matches any time in the request
                if (!in_array($existingTime, $times)) {
                    $existingAvailability->delete();
                }
            }
            return response()->json(['message' => 'Availabilities updated'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }



    public function assignAvl(Request $request)
    {
        try {
            $times = json_decode($request->input('times'));

            $old_appointment = Appointment::where('id', $request->appointment_id)->first();
            $tokens = $old_appointment->session_number;

            if ($tokens == 1) {
                $old_appointment->delete();
            } else {
                $tokens--;
                $old_appointment->update(['session_number' => $tokens]);
            }

            foreach ($times as $time) {

                $formattedDate = date('Y-m-d', strtotime($request->date));

                $avl = Availabilities::where('personal_trainer_id', $request->personal_trainer_id)
                    ->where('date', $formattedDate)->where('time', $time)
                    ->first();

                if ($avl) {
                    $avl->update(['athlete_id' => $request->athlete_id]);
                }


                $new_appointment = new Appointment();
                $new_appointment->description = 'invite';
                $new_appointment->personal_trainer_id = $request->personal_trainer_id;
                $new_appointment->athlete_id = $request->athlete_id;
                $new_appointment->is_confirmed = true;
                $new_appointment->is_free = true;
                $new_appointment->date = $formattedDate . ' ' . $time;
                $new_appointment->price = 0;
                $new_appointment->session_number = 1;
                $new_appointment->save();
            }


            return response()->json(['message' => 'Availabilities updated'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
