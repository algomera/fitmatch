<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use App\Models\UserInformations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiAuthController extends Controller
{
    public function getData()
    {
        $categories = Category::all();
        return response()->json(['categories' => $categories]);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            $response = ['message' => 'Validation error', 'errors' => $validator->errors()];
            return response()->json($response, 400);
        }

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            $response = ['message' => 'User not found'];
            return response()->json($response, 404);
        }

        $userID = $user->id;
        if ($user != '[]' && Hash::check($request->password, $user->password)) {
            $token = User::find($userID)->createToken('token')->plainTextToken;
            $response = ['token' => $token, 'user' => $user, 'user_type' => $user->getRoleAttribute()->name, 'message' => 'Login effettuato con successo'];
            return response()->json($response, 200);
        }
    }

    public function register(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'isAthlete' => 'required',
            'password' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
        ]);

        if ($validator->fails()) {
            $response = ['message' => 'Validation error', 'errors' => $validator->errors()];
            return response()->json($response, 400);
        }

        DB::beginTransaction();

        try {

            $user = new User();
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->assignRole($request->isAthlete ? 'athlete' : 'personal-trainer');
            $user->save();
            // dd($user->informations()->create());

            $user_info = new UserInformations();
            $user_info->first_name = $request->input('first_name');
            $user_info->last_name = $request->input('last_name');
            $user_info->remote = 1;
            $user_info->in_person = 0;
            $user_info->user_id = $user->id;
            $user_info->save();

            DB::commit();

            $token = $user->createToken('token')->plainTextToken;

            $response = [
                'message' => 'Utente registrato',
                'user' => $user,
                'token' => $token,
            ];

            return response()->json($response, 201);
        } catch (\Exception $e) {
            // An error occurred, rollback changes
            DB::rollback();

            $response = ['message' => 'Errore durante la registrazione', 'error' => $e->getMessage()];
            return response()->json($response, 500);
        }
    }
}
