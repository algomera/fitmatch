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

    public function getLatestMessages($id)
    {

        $subQuery = Message::select(DB::raw('
        LEAST(sender_id, receiver_id) as user_one,
        GREATEST(sender_id, receiver_id) as user_two,
        MAX(id) as last_message_id
    '))
            ->where('sender_id', $id)
            ->orWhere('receiver_id', $id)
            ->groupBy('user_one', 'user_two');

        // Subquery for counting unseen messages
        $unseenCountSubQuery = Message::select('receiver_id', DB::raw('COUNT(*) as unseen_count'))
            ->where('receiver_id', $id)
            ->where('is_seen', 0)
            ->groupBy('receiver_id');

        // Main query to get the message details and unseen count
        $latestMessages = DB::table('messages')
            ->joinSub($subQuery, 'latest_messages', function ($join) {
                $join->on('messages.id', '=', 'latest_messages.last_message_id');
            })
            ->leftJoinSub($unseenCountSubQuery, 'unseen_counts', function ($join) use ($id) {
                $join->on('messages.sender_id', '=', 'unseen_counts.receiver_id')
                    ->orOn('messages.receiver_id', '=', 'unseen_counts.receiver_id');
            })
            ->get([
                'messages.sender_id',
                'messages.receiver_id',
                'messages.message',
                'messages.type',
                'unseen_counts.unseen_count'
            ]);

        return $latestMessages;
    }
}
