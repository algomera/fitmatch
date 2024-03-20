<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Anamnesi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AnamnesiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function createRequest(Request $request)
    {
        DB::beginTransaction();

        try {
            $user = User::find($request->athlete_id);
            if (!$user) {
                throw new \Exception('User not found');
            }
            $anamnesi = $user->anamnesi;
            // Check if the record exists in the pivot table
            $existingRecord = DB::table('anamnesi_personal_trainer')
                ->where('anamnesi_id', $anamnesi->id)
                ->where('personal_trainer_id', $request->personal_trainer_id)
                ->exists();

            if (!$existingRecord) {
                $anamnesi->personal_trainers()->syncWithoutDetaching($request->personal_trainer_id, [
                    'anamnesi_id' => $anamnesi->id,
                    'personal_trainer_id' => $request->personal_trainer_id,
                    'accepted' => 0
                ]);
            }

            DB::commit();
            return response()->json(['message' => 'Request created successfully', 'exists' => $existingRecord], 200);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return response()->json(['error' => $e->getMessage(), 'anamensi' => $anamnesi], 500);
        }
    }

    public function acceptRequest(Request $request)
    {


        if (!$request->personal_trainer_id) {
            return response()->json(['error' => 'User not found'], 404);
        }

        DB::table('anamnesi_personal_trainer')
            ->where('personal_trainer_id', $request->personal_trainer_id)
            ->update(['accepted' => 1]);


        return response()->json(['message' => 'Record updated successfully'], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            DB::beginTransaction();

            $schedaAnamnesi = Anamnesi::find($id);

            if (!$schedaAnamnesi) {
                return response()->json(['message' => 'Scheda anamnesi non trovata'], 404);
            }

            // Check if smoke_stopped_since has been provided in the request
            if ($request->has('smoke_stopped_since')) {
                $numberOfDays = $request->input('smoke_stopped_since');
                $currentDate = now();
                $newDate = $currentDate->clone()->startOfDay()->subDays($numberOfDays);

                // Check if the new date is different from the current value in the database
                if (!$newDate->eq($schedaAnamnesi->smoke_stopped_since)) {
                    $request->merge(['smoke_stopped_since' => $newDate]);
                } else {
                    // Remove the smoke_stopped_since field from the request if it hasn't changed
                    $request->offsetUnset('smoke_stopped_since');
                }
            }

            $schedaAnamnesi->fill($request->all());
            $schedaAnamnesi->save();
            DB::commit();

            return response()->json([
                'message' => 'Scheda anamnesi aggiornata correttamente', 'anamnesi' => $schedaAnamnesi
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Errore aggiornamento anamnesi', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $schedaAnamnesi = new Anamnesi();

            // Handle smoke_stopped_since if it's provided in the request
            if ($request->has('smoke_stopped_since')) {
                $numberOfDays = $request->input('smoke_stopped_since');
                $currentDate = now();
                $newDate = $currentDate->clone()->startOfDay()->subDays($numberOfDays);
                $request->merge(['smoke_stopped_since' => $newDate]);
            }

            $schedaAnamnesi->fill($request->all());
            $schedaAnamnesi->save();
            DB::commit();

            return response()->json([
                'message' => 'Scheda anamnesi creata correttamente', 'anamnesi' => $schedaAnamnesi
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Error creating anamnesi', 'error' => $e->getMessage()], 500);
        }
    }

    public function showAllRequests($id)
    {
        try {
            $user = User::find($id);

            if (!$user) {
                return response()->json(['error' => 'User not found'], 404);
            }

            // Get all records from the personal_trainer_athlete pivot table
            $allRecords = $user->personal_trainers;

            // Create an array to store the results with the access flag
            $results = [];

            foreach ($allRecords as $record) {
                // Assuming you have a function to retrieve anamnesi_id based on athlete_id and personal_trainer_id
                $anamnesi = $record->shared_anamnesis;

                // Check if the $anamnesi array is not empty and has at least one element
                if (!empty($anamnesi) && count($anamnesi) > 0) {
                    // Check if the user has access to the current Anamnesi model
                    $hasAccess = $record->anamnesiAccepted($anamnesi[0]->id);

                    // Add the record to the results array with the access flag
                    $results[] = [
                        'anamnesi_id' => $anamnesi[0]->id,
                        'personal_trainer' => $record,
                        'has_access' => $hasAccess,
                    ];
                }
            }

            return response()->json($results, 200);
        } catch (\Exception $e) {
            // Handle the exception and return an appropriate error response
            return response()->json(['error' => 'An error occurred while processing the request'], 500);
        }
    }

    public function denyRequest(Request $request)
    {
        try {
            // Delete the specified record from the anamnesi_personal_trainer pivot table
            DB::table('anamnesi_personal_trainer')
                ->where('personal_trainer_id', $request->personal_trainer_id)
                ->delete();

            return response()->json(['message' => 'deleted successfully'], 200);
        } catch (\Exception $e) {
            // Handle the exception here, you can log it or return an error response.
            return response()->json(['error' => 'Internal server error'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $anamnesi = Anamnesi::where('athlete_id', $id)->get();

        if ($anamnesi->isEmpty()) {
            return response()->json('Error, anamnesi non trovata', 404);
        }
        return response()->json($anamnesi, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
