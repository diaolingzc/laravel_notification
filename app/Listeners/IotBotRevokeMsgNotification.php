<?php
/*
 * @Author: Yunli
 * @Date: 2020-05-16 13:54:44
 * @LastEditTime: 2020-05-16 15:46:56
 * @LastEditors: Please set LastEditors
 * @Description: In User Settings Edit
 */

namespace App\Listeners;

use App\Events\IotBotGroup;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\IotBotRevokeMsgNotification as IotBotRevokeMsgChannelNotification;
use Illuminate\Support\Facades\Log;

class IotBotRevokeMsgNotification implements ShouldQueue
{
    use InteractsWithQueue;

    public $delay = 30;

    /**
     * Handle the event.
     *
     * @param IotBotGroup $event
     */
    public function handleRevokeMsg(IotBotGroup $event)
    {
        Log::info('handleRevokeMsg: '.date('Y-m-d H:i:s'));
        $data = $event->getData();

        if ('PicMsg' === $data['MsgType'] && $data['FromUserId'] === (int) config('iotbot.robot_qq')) {
            Notification::send(request()->user(), new IotBotRevokeMsgChannelNotification($data));
        }
        Log::info('handleRevokeMsgEnd: '.date('Y-m-d H:i:s'));

        return;
    }
}
