<?php

namespace App\Listeners;

use App\Events\IotBotFriend;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\IotBotNotification as IotBotChannelNotification;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;

class IotBotFriendNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param IotBotFriend $event
     */
    public function handleToSeTu(IotBotFriend $event)
    {
        $data = $event->getData();

        if ($data['FromUin'] === (int) config('iotbot.master')[0] && strstr($data['Content'], 'setu')) {
            $callback = [
                'toUser' => $data['FromUin'],
                'sendToType' => 1,
                'sendMsgType' => 'TextMsg',
                'content' => '程序异常!',
                'groupid' => 0,
                'atUser' => 0,
            ];

            $message = $this->getSetu(true);

            if ('程序异常!' != $message) {
                $callback['sendMsgType'] = 'PicMsg';
                $callback['content'] = '';
                $callback['picUrl'] = $message;
                $callback['picBase64Buf'] = '';
                $callback['fileMd5'] = '';
            }

            Notification::send(request()->user(), new IotBotChannelNotification($callback));
        }
    }

    public function handleFrom(IotBotFriend $event)
    {
        $data = $event->getData();
        Log::info(json_encode($data));
        //Notification::send(request()->user(), new IotBotChannelNotification($data));
    }

    /**
     * Handle the event.
     *
     * @param IotBotFriend $event
     */
    public function handleSweetSentence(IotBotFriend $event)
    {
        $data = $event->getData();

        if (strstr($data['Content'], '撩我')) {
            $callback = [
              'toUser' => $data['FromUin'],
              'sendToType' => 1,
              'sendMsgType' => 'TextMsg',
              'content' => '程序异常!',
              'groupid' => 0,
              'atUser' => 0,
          ];

            $message = $this->getSweetSentence();

            if ('程序异常!' != $message) {
                $callback['content'] = $message;
            }

            Notification::send(request()->user(), new IotBotChannelNotification($callback));
        }
    }

    protected function getSetu($r18 = false)
    {
        $query = [
          'r18' => $r18,
        ];
        $message = '程序异常!';

        try {
            $client = new Client();
            $response = $client->request('GET', 'http://api.yuban10703.xyz:2333/setu', ['query' => $query]);
            if (200 === $response->getStatusCode()) {
                $response = json_decode($response->getBody()->getContents(), true);
                $message = 'https://cdn.jsdelivr.net/gh/laosepi/setu/pics/'.$response['filename'][0];
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }

        return $message;
    }

    protected function getSweetSentence()
    {
        $message = '程序异常!';

        try {
            $client = new Client();
            $response = $client->request('GET', 'https://chp.shadiao.app/api.php');
            if (200 === $response->getStatusCode()) {
                $message = $response->getBody()->getContents();
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }

        return $message;
    }
}
