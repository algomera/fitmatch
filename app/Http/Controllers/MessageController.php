<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        // Retrieve messages
        $messages = Message::with('appointment')
            ->where(function ($query) use ($user1, $user2) {
                $query->where('sender_id', $user1)->where('receiver_id', $user2);
            })
            ->orWhere(function ($query) use ($user1, $user2) {
                $query->where('sender_id', $user2)->where('receiver_id', $user1);
            })
            ->orderBy('created_at', 'desc')
            ->paginate($perPage, ['*'], 'page', $page);

        // Mark messages as seen
        Message::where('receiver_id', $user2)
            ->where('sender_id', $user1)
            ->where('is_seen', false)
            ->update(['is_seen' => true]);

        return response()->json($messages);
    }

    public function getLatestMessages($userId)
    {
        // Subquery to find the latest message ID for each conversation
        $latestMessageSubQuery = Message::selectRaw('
            MAX(id) as last_message_id,
            LEAST(sender_id, receiver_id) as user_one,
            GREATEST(sender_id, receiver_id) as user_two
        ')
            ->where('sender_id', $userId)
            ->orWhere('receiver_id', $userId)
            ->groupBy('user_one', 'user_two');

        // Main query to get the latest messages details
        $latestMessages = DB::table('messages as m')
            ->joinSub($latestMessageSubQuery, 'latest', function ($join) {
                $join->on('m.id', '=', 'latest.last_message_id');
            })
            ->leftJoin('users as sender', 'm.sender_id', '=', 'sender.id')
            ->leftJoin('users as receiver', 'm.receiver_id', '=', 'receiver.id')
            ->select([
                'm.id',
                'm.sender_id',
                'm.receiver_id',
                'm.message',
                'm.type',
                'm.created_at',
                'm.is_seen',

            ])
            ->orderBy('m.created_at', 'desc')
            ->get();

        return $latestMessages;
    }
    public function getPusherKey()
    {
        $key = env('PUSHER_APP_KEY');
        return response()->json(['key' => $key]);
    }
}
