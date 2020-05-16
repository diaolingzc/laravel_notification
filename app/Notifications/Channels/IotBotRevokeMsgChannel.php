<?php
/*
 * @Author: Yunli
 * @Date: 2020-05-16 15:31:49
 * @LastEditTime: 2020-05-16 15:36:59
 * @LastEditors: Please set LastEditors
 * @Description: IotBotRevokeMsgChannel
 */ 

namespace App\Notifications\Channels;

use Diaolingzc\IotBotHttp;
use GuzzleHttp\RequestOptions;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class IotBotRevokeMsgChannel
{
	protected $client;

	public function __construct()
	{
		$this->client = app('iotbot');
	}

	/**
	 * 发送指定的通知.
	 *
	 * @param  mixed  $notifiable
	 * @param  \Illuminate\Notifications\Notification  $notification
	 * @return void
	 */
	public function send($notifiable, Notification $notification)
	{
		$message = $notification->toIotBotRevokeMsg($notifiable);

    $this->client->setGuzzleOptions(['auth' => ['iotqq', 12345678]]);
    
    $response = $this->client->RevokeMsg($message['FromGroupId'], $message['MsgSeq'], $message['MsgRandom']);

		Log::info(json_encode($response));
	}
}
