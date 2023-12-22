<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getAthletes(Request $request)
    {
        try {
            if (!$request->has('id')) {
                return response()->json(['error' => 'Missing id parameter'], 400);
            }

            $user = User::find($request->id);

            if (!$user) {
                return response()->json(['error' => 'User not found'], 404);
            }

            $athletes = $user->athletes;

            return response()->json($athletes, 200);
        } catch (\Exception $e) {

            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }
}
