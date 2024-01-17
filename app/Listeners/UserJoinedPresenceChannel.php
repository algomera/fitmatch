<?php

namespace App\Listeners;

use App\Events\ChangeUserStatus;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Support\Facades\Log;

class UserJoinedPresenceChannel
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        Log::info('asd');
    }

    /**
     * Handle the event.
     */
    public function handle(ChangeUserStatus $event)
    {
        Log::info($event);
        $user = $event;

        // Update the user's status to 'online'
        // $user->update(['status' => 'online']);
    }
}
