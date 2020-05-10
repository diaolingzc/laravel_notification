<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Notifications\RobotNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Log;

class SmsController extends Controller
{
  public function callback(Request $request)
  {
    $sdkappid = $request->input('sdkappid');
    $title = '应用 ' . $sdkappid . ' 回调推送';
    $message = '```javascript' . PHP_EOL . $request->getContent() . PHP_EOL  . '```';
    $message = "$title" . PHP_EOL . PHP_EOL . "$message";
    Notification::send(request()->user(), new RobotNotification($message));
    return response()->json(['result' => 0, 'errmsg' => 'OK']);
  }

  public function reply(Request $request)
  {
    $sdkappid = $request->input('sdkappid');
    $title = '应用 ' . $sdkappid . ' 回复推送';
    $message = '```javascript' . PHP_EOL . $request->getContent() . PHP_EOL  . '```';
    $message = "$title" . PHP_EOL . PHP_EOL . "$message";
    Notification::send(request()->user(), new RobotNotification($message));
    return response()->json(['result' => 0, 'errmsg' => 'OK']);
  }
}
