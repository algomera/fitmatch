<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getAppointments($id, $isAthlete)
    {
        // dd($id);
        if ($isAthlete == 'true') {
            $appointments = Appointment::with('personalTrainer.personalTrainerAvl')->where('athlete_id', $id)->get();
            return response()->json(['appointments' => $appointments]);
        } else {
            $appointments = Appointment::with('athlete')->where('personal_trainer_id', $id)->get();
            $user = User::find($id);
            $athletes = $user->athletes;
            $times = $user->personalTrainerTimes;
            $avl = $user->personalTrainerAvl;
            return response()->json(['appointments' => $appointments, 'athletes' => $athletes, 'times' => $times, 'avl' => $avl]);
        }
    }

    public function confirmAppointment(Request $request)
    {
        try {
            $appointment = Appointment::find($request->id);
            if (!$appointment) {
                return response()->json(['message' => 'Appointment not found'], 404);
            }

            $appointment->is_confirmed = 1;
            $appointment->update();

            return response()->json(['message' => 'Appointment confirmed'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred'], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        //
    }

    public function denyAppointment(Request $request)
    {
        try {
            $appointment = Appointment::find($request->id);

            if ($appointment) {
                $message = $appointment->message;

                if ($message) {
                    $message->delete();
                }

                $appointment->delete();
            }

            return response()->json(['message' => 'Appuntamento Rifiutato'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred: ' . $e], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'personal_trainer_id' => 'required',
            'athlete_id' => 'required',
            'description' => 'required|string',
            'price' => 'required',
            'isFree' => 'required',
            'date' => 'required',
        ]);

        if ($validator->fails()) {
            $response = ['message' => 'Validation error', 'errors' => $validator->errors()];
            return response()->json($response, 400);
        }

        try {
            DB::beginTransaction();

            $appointment = new Appointment();
            $appointment->description = $request['description'];
            $appointment->is_confirmed = false;
            $appointment->is_free = $request['isFree'];
            $appointment->date = $appointment->getDateAttribute($request->date);
            $appointment->price = $request['price'];
            $appointment->session_number = $request['session_number'];

            $appointment->personalTrainer()->associate(User::find($request['personal_trainer_id']));
            $appointment->athlete()->associate(User::find($request['athlete_id']));
            $appointment->save();

            DB::commit();

            return response()->json([
                'message' => 'Appointment created successfully', 'appointment' => $appointment
            ], 201);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json(['message' => 'Error creating appointment', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        try {
            $message = $appointment->message;
            $message->delete();
            $appointment->delete();
            return response()->json(['message' => 'Appointment deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete appointment: ' . $e->getMessage()], 500);
        }
    }
}
