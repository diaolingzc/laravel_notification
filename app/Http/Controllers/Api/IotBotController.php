<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Notifications\IotBotNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class IotBotController extends Controller
{
  public function tianqi(Client $client)
  {
    $url = 'http://www.weather.com.cn/data/cityinfo/101280601.html';
    $response = $client->get($url);
    $message = $response->getBody()->getContents();
    // Notification::send(request()->user(), new IotBotNotification('111'));
    $data = [
      'toUser' => config('iotbot.user_qq'),
      'sendToType' => 1,
      'sendMsgType' => 'TextMsg',
      'content' => $message,
      'groupid' => 0,
      'atUser' => 0,
    ];

    $url = config('iotbot.web_api_path') . '?qq=' . config('iotbot.robot_qq') . '&funcname=SendMsg';

    // $response = $this->client->post($url, [
    //   RequestOptions::JSON => $data
    // ], [
    //   'auth' => [config('iotbot.auth.name'), config('iotbot.auth.pwd'), 'basic']
    // ]);

    $response = $client->request('POST', $url, [
      RequestOptions::JSON => $data,
      'auth' => [config('iotbot.auth.name'), config('iotbot.auth.pwd')]
    ]);
    dd($response);
    return response()->json(['result' => 0, 'errmsg' => 'OK']);
  }
}
