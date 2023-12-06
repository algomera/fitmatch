<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;

use App\Models\Appointment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getAppointments($id, $isAthlete)
    {
        if ($isAthlete == 'true') {
            $appointments = Appointment::with('personalTrainer')->where('athlete_id', $id)->get();
        } else {
            $appointments = Appointment::with('athlete')->where('personal_trainer_id', $id)->get();
        }
        return response()->json($appointments);
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

        $date = Carbon::parse($request['date']);
        $appointment = new Appointment([
            'description' => $request['description'],
            'is_confirmed' => false,
            'is_free' => $request['isFree'],
            'date' => $date,
            'price' => $request['price']
        ]);

        $appointment->personalTrainer()->associate(User::find($request['personal_trainer_id']));
        $appointment->athlete()->associate(User::find($request['athlete_id']));

        $appointment->save();
        // dd($appointment->personalTrainer->role);

        return response()->json(['message' => 'Appointment created successfully', 'appointment' => $appointment], 201);
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        //
    }
}
