<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserInformations;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function getAthletes($id)
    {
        try {

            $user = User::find($id);

            if (!$user) {
                return response()->json(['error' => 'User not found'], 404);
            }

            $athletes = $user->athletes()->wherePivot('accepted', 1)->get();
            $workouts = $user->personal_trainer_workouts->load(['workout_weeks', 'sets', 'athletes', 'goal']);



            return response()->json(['athletes' => $athletes, 'workouts' => $workouts], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }


    public function attachAthletePersonalTrainer(Request $request)
    {
        try {
            DB::beginTransaction();

            $athlete = User::find($request->athlete_id);
            $personalTrainer = User::find($request->personal_trainer_id);

            $athlete->personal_trainers()->syncWithoutDetaching($personalTrainer->id);

            DB::commit();
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json(['error' => $e], 500);
        }
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $userInfo = UserInformations::find($id);

            if (!$userInfo) {
                throw new \Exception('User not found');
            }

            // Get the incoming date of birth string
            $dob = $request->input('dob');
            // Replace '/' with '-' to convert "dd/MM/yyyy" to "dd-MM-yyyy" format
            $dob = str_replace('/', '-', $dob);
            // Parse the date string
            $parsedDate = date_create_from_format('d-m-Y', $dob, new DateTimeZone('UTC'));
            $formattedDob = $parsedDate->format('U');

            $request['dob'] = $formattedDob;

            $userInfo->update([
                'first_name' => $request['first_name'],
                'last_name' => $request['last_name'],
                'gender' => $request['gender'],
                'dob' => $request['dob'],
                'phone' => $request['phone']
            ]);

            DB::commit();

            return response()->json($userInfo);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function acceptContactRequest(Request $request)
    {
        try {
            $personalTrainerId = $request->input('personal_trainer_id');
            $athleteId = $request->input('athlete_id');

            $personalTrainer = User::find($personalTrainerId);

            if (!$personalTrainer) {
                return response()->json(['error' => 'Personal trainer not found.'], 404);
            }

            $personalTrainer->athletes()->updateExistingPivot(
                $athleteId,
                ['accepted' => 1]
            );

            return response()->json(['message' => 'Pivot updated successfully', 200]);
        } catch (\Exception $e) {
            // Handle the exception here, you can log it or return an error response.
            return response()->json(['error' => 'An error occurred while updating pivot.'], 500);
        }
    }

    public function denyContactRequest(Request $request)
    {
        try {
            $personalTrainerId = $request->input('personal_trainer_id');
            $athleteId = $request->input('athlete_id');

            // Find the user relationship and detach it to remove the pivot record
            User::find($personalTrainerId)->athletes()->detach($athleteId);

            return response()->json(['message' => 'Pivot record deleted successfully', 200]);
        } catch (\Exception $e) {
            // Handle the exception here, you can log it or return an error response.
            return response()->json(['error' => 'An error occurred while deleting pivot record.'], 500);
        }
    }

    public function uploadProfilePicture(Request $request)
    {
        try {
            $userId = $request->input('user_id');
            $file = $request->file('profile_image');
            $userInfo = UserInformations::where('user_id', $userId);
            if (!$file) {
                return response()->json(['error' => 'Profile image not provided'], 400);
            }

            $filePath = '/public/user/' . $userId . '/profile_image/';

            $fileName = Str::uuid() . '.webp';
            $file->storeAs($filePath, $fileName);
            $withoutPublic = str_replace('/public', '', $filePath);
            $userInfo->update(['profile_image' => $withoutPublic . $fileName]);


            return response()->json(['message' => 'Profile picture uploaded successfully', 'path' => $filePath, 'file_name' => $fileName], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong: ' . $e], 500);
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $info = UserInformations::where('user_id', $id)->first();
        try {
            $user->delete();
            $info->delete();
            return response()->json(['message' => 'Profilo eliminato']);
        } catch (\Exception $e) {
            return response()->json('error', 'Failed to delete user. Please try again.');
        }
    }
}
