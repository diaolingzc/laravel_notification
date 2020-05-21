<?php

namespace App\Notifications\Channels;

use Diaolingzc\IotBotHttp;
use GuzzleHttp\RequestOptions;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class IotBotChannel
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
		$message = $notification->toIotBot($notifiable);

    if (config('iotbot.auth.user')) {
      $this->client->setGuzzleOptions(['auth' => [config('iotbot.auth.user'), config('iotbot.auth.pwd')]]);
    }
    
		switch ($message['sendMsgType']) {
			case 'TextMsg':
				$response = $this->client->sendTextMsg($message['toUser'], $message['sendToType'], $message['content'], $message['groupid'], $message['atUser']);
				break;
			case 'PicMsg':
				$response = $this->client->sendPicMsg($message['toUser'], $message['sendToType'], $message['content'], $message['groupid'], $message['atUser'], $message['picUrl'], $message['picBase64Buf'], $message['fileMd5']);
				break;
			case 'VoiceMsg':
				$response = $this->client->sendVoiceMsg($message['toUser'], $message['sendToType'], $message['content'], $message['groupid'], $message['atUser'], $message['voiceUrl'], $message['voiceBase64Buf']);
				break;
			default:
				Log::info('SendMsgType is error!');
				break;
		}

		Log::info(json_encode($response));
	}
}
