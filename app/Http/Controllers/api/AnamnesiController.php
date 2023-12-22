<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Anamnesi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\JsonDecoder;

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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $schedaAnamnesi = new Anamnesi();
            $schedaAnamnesi->fill($request->all());
            $schedaAnamnesi->save();
            DB::commit();
            return response()->json(['message' => 'Scheda anamnesi creata correttamente', 'anamnesi' => $schedaAnamnesi], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['r' => $request, 'message' => 'Error creating anamnesi', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $anamnesi = Anamnesi::where('athlete_id', $id)->get();

        if ($anamnesi->isEmpty()) {
            return response()->json('error', 404);
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            DB::beginTransaction();

            // Retrieve the Eloquent model instance using find or another appropriate method
            $schedaAnamnesi = Anamnesi::find($id);

            if (!$schedaAnamnesi) {
                // Handle the case where the record is not found
                return response()->json(['message' => 'Scheda anamnesi non trovata'], 404);
            }

            // Use the fill method on the model instance to update its attributes
            // json_decode($request);
            $schedaAnamnesi->fill($request->all());
            $schedaAnamnesi->save(); // Save the changes to the database

            DB::commit();
            return response()->json(['message' => 'Scheda anamnesi aggiornata correttamente', 'anamnesi' => $schedaAnamnesi], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Errore aggiornamento anamnesi', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
