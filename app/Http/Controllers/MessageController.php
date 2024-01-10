<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function sendMessage(Request $request)
    {
        $message = new Message();
        $message->sender_id = $request->sender_id;
        $message->receiver_id = $request->receiver_id;
        $message->message = $request->message;
        $message->type = $request->type;
        $message->appointment_id = $request->appointment_id;
        $message->save();
        broadcast(new MessageSent($message));

        return response()->json($message, 201);
    }

    public function fetchMessages($user1, $user2, $page = 1)
    {
        $perPage = 18;

        $messages = Message::with('appointment')->where(function ($query) use ($user1, $user2) {
            $query->where('sender_id', $user1)->where('receiver_id', $user2);
        })->orWhere(function ($query) use ($user1, $user2) {
            $query->where('sender_id', $user2)->where('receiver_id', $user1);
        })->orderBy('created_at', 'desc')
            ->paginate($perPage, ['*'], 'page', $page);

        return response()->json($messages);
    }
}
