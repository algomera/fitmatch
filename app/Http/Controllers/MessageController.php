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
        $message->save();
        broadcast(new MessageSent(['message' => $message->message, 'user_id' => 3]))->toOthers();

        return response()->json($message, 201);
    }

    public function fetchMessages($user1, $user2)
    {
        $messages = Message::where(function ($query) use ($user1, $user2) {
            $query->where('sender_id', $user1)->where('receiver_id', $user2);
        })->orWhere(function ($query) use ($user1, $user2) {
            $query->where('sender_id', $user2)->where('receiver_id', $user1);
        })->get();

        return response()->json($messages);
    }
}
