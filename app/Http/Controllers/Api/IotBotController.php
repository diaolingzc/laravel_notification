<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\IotBotRequest;
use App\Notifications\IotBotNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Log;
use App\Events\IotBotFriend;
use App\Events\IotBotGroup;


class IotBotController extends Controller
{
    public function callback(IotBotRequest $request)
    {
        if ($request->type === 'friend') {
            $data = [
                'Content' => $request->Content,
                'FromUin' => $request->FromUin,
                'MsgSeq' => $request->MsgSeq,
                'MsgType' => $request->MsgType,
                'ToUin' => $request->ToUin,
            ];
            event(new IotBotFriend($data));
        }

        if ($request->type === 'group') {
            $data = [
                'Content' => $request->Content,
                'FromGroupId' => $request->FromGroupId,
                'FromGroupName' => $request->FromGroupName,
                'FromNickName' => $request->FromNickName,
                'FromUserId' => $request->FromUserId,
                'MsgRandom' => $request->MsgRandom,
                'MsgSeq' => $request->MsgSeq,
                'MsgTime' => $request->MsgTime,
                'MsgType' => $request->MsgType,
            ];
            event(new IotBotGroup($data));
        }

        Log::info('请求时间'. date('Y-m-d H:i:s'));
    
        return response()->json(['result' => 0, 'errmsg' => 'OK']);
    }
}
