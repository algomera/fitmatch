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

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $params;

    public function __construct($params)
    {
        $this->params = $params;
    }


    public function broadcastOn()
    {
        return new PrivateChannel('private-chat.3');
    }

    public function broadcastAs()
    {
        return 'message-sent';
    }
    public function broadcastWith()
    {
        return ['message' => $this->params['message'], 'user_id' => $this->params['user_id']];
    }
}
