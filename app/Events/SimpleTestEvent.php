<?php

// app/Events/SimpleTestEvent.php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Facades\Log;

class SimpleTestEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    public function __construct()
    {
        $this->message = 'Hello from SimpleTestEvent!';
    }

    public function broadcastOn()
    {
        Log::info('Broadcasting to private channel');
        return new PrivateChannel('private-test-channel');
    }

    public function broadcastAs()
    {
        return 'client-test-event';
    }
}
