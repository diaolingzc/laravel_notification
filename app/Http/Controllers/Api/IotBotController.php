<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\IotBotRequest;
use Illuminate\Support\Facades\Log;
use App\Events\IotBotFriend;
use App\Events\IotBotGroup;

class IotBotController extends Controller
{
    public function callback(IotBotRequest $request)
    {
        if ('friend' === $request->type) {
            $data = [
                'Content' => $request->Content,
                'FromUin' => $request->FromUin,
                'MsgSeq' => $request->MsgSeq,
                'MsgType' => $request->MsgType,
                'ToUin' => $request->ToUin,
            ];
            event(new IotBotFriend($data));
        }

        if ('group' === $request->type) {
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

        Log::info('RequestTime: '.date('Y-m-d H:i:s'));

        return response()->json(['result' => 0, 'errmsg' => 'OK']);
    }
}
