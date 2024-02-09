<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $type;
    public $senderId;
    public $receiverId;

    public function __construct(Message $message)
    {
        $this->message = $message->message;
        $this->type = $message->type;
        $this->senderId = $message->sender_id;
        $this->receiverId = $message->receiver_id;
    }

    public function broadcastOn()
    {
        $channelName = 'chat.' . min($this->senderId, $this->receiverId) . '.' . max($this->senderId, $this->receiverId);
        return new Channel($channelName);
    }

    public function broadcastAs()
    {
        return 'message-sent';
    }

    public function broadcastWith()
    {
        Log::info($this->message);
        return [
            'message' => $this->message,
            'sender_id' => $this->senderId,
            'receiver_id' => $this->receiverId,
            'type' => $this->type
        ];
    }
}
