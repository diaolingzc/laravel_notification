<?php

namespace App\Listeners;

use App\Events\IotBot;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\IotBotNotification as IotBotChannelNotification;

class IotBotNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     */
    public function handle(IotBot $event)
    {
        $data = $event->getData();

        Notification::send(request()->user(), new IotBotChannelNotification($data));
    }
}
