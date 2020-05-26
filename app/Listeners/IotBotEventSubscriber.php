<?php

namespace App\Listeners;

use App\Events\IotBotFriend;
use App\Events\IotBotGroup;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\IotBotNotification as IotBotChannelNotification;
use Illuminate\Support\Facades\Log;
use App\Listeners\IotBotFriendNotification;

class IotBotEventSubscriber implements ShouldQueue
{
    use InteractsWithQueue;
    /**
     * 处理用户登录事件
     */
    public function handleIotBotfriend($event)
    {
        $data = $event->getData();

        Log::info(json_encode($data));
    }

    /**
     * 处理用户注销事件
     */
    public function handleIotBotGroup($event)
    {
        $data = $event->getData();

        Log::info(json_encode($data));
    }

    /**
     * 为事件订阅者注册监听器
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'App\Events\IotBotFriend',
            'App\Listeners\IotBotFriendNotification@handleToSeTu'
        );

        $events->listen(
            'App\Events\IotBotFriend',
            'App\Listeners\IotBotFriendNotification@handleFrom'
        );

        $events->listen(
            'App\Events\IotBotFriend',
            'App\Listeners\IotBotFriendNotification@handleSweetSentence'
        );

        $events->listen(
            'App\Events\IotBotGroup',
            'App\Listeners\IotBotGroupNotification@handleToSeTu'
        );

        
        $events->listen(
            'App\Events\IotBotGroup',
            'App\Listeners\IotBotRevokeMsgNotification@handleRevokeMsg'
        );

        $events->listen(
            'App\Events\IotBotGroup',
            'App\Listeners\IotBotGroupNotification@handleSweetSentence'
        );

        $events->listen(
            'App\Events\IotBotGroup',
            'App\Listeners\IotBotGroupNotification@handleToMeiZi'
        );

        $events->listen(
            'App\Events\IotBotGroup',
            'App\Listeners\IotBotGroupNotification@handleToJio'
        );

        $events->listen(
            'App\Events\IotBotGroup',
            'App\Listeners\IotBotGroupNotification@handleToNaiZi'
        );

        $events->listen(
            'App\Events\IotBotGroup',
            'App\Listeners\IotBotGroupNotification@handleToCoser'
        );

        $events->listen(
            'App\Events\IotBotGroup',
            'App\Listeners\IotBotGroupNotification@handleToReStart'
        );
    }
}
