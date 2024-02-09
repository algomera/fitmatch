<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Message;
use App\Models\User;
use App\Models\UserInformations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiAuthController extends Controller
{
    public function getData($id)
    {
        $categories = Category::all();
        $pts = User::where('status', 'approved')->get();

        // Loop through the $pts collection to load the relations for each user
        foreach ($pts as $pt) {
            $pt->load(['job_experiences', 'medias', 'athletes', 'categories']);
        }

        $current_user = User::find($id);

        if ($current_user->getRoleAttribute()->name == 'personal-trainer') {
            $chat_users = $current_user->athletes()->get();
        } else {
            $chat_users = $current_user->personal_trainers()
                ->wherePivot('accepted', 1)
                ->with(['job_experiences', 'medias', 'athletes', 'categories'])
                ->get();
        }

        // Group notifications by sender and select only one notification per sender
        $notifications = Message::where('receiver_id', $id)
            ->where('is_seen', 0)
            ->with('sender')
            ->whereIn('id', function ($query) {
                $query->select(DB::raw('MAX(id)'))
                    ->from('messages')
                    ->groupBy('sender_id');
            })
            ->get();


        return response()->json(['categories' => $categories, 'personal_trainers' => $pts, 'chat_users' => $chat_users, 'notifications' => $notifications]);
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

        if ($user != [] && Hash::check($request->password, $user->password)) {
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
            $user->status = $request->isAthlete ? null : 'pending';
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
