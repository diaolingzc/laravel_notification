<?php

namespace App\Notifications\Channels;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Notifications\Notification;

class RobotChannel
{
  protected $client;

  public function __construct(Client $client)
  {
    $this->client = $client;
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
    $message = $notification->toWechatRobot($notifiable);

    $data = [
      'msgtype' => 'markdown',
      'markdown' => [
        'content' => $message
      ]
    ];

    $key = config('wechat.SmsRobotKey');

    $url = 'https://qyapi.weixin.qq.com/cgi-bin/webhook/send?key=' . $key;

    $response = $this->client->post($url, [
      RequestOptions::JSON => $data
    ]);
  }
}
