<?php

namespace App\Listeners;

use App\Events\IotBotGroup;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\IotBotNotification as IotBotChannelNotification;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class IotBotGroupNotification implements ShouldQueue
{
    use InteractsWithQueue;
    /**
     * Handle the event.
     *
     * @param  IotBotGroup  $event
     * @return void
     */
    public function handleToSeTu(IotBotGroup $event)
    {
        $data = $event->getData();

        if (in_array($data['FromGroupId'],config('iotbot.white_group')) && strstr($data['Content'], 'setu')) {
          $callback = [
              'toUser' => $data['FromGroupId'] ,
              'sendToType' => 2,
              'sendMsgType' => 'TextMsg',
              'content' => '程序异常!',
              'groupid' => 0,
              'atUser' => $data['FromUserId'],
          ];
          
          $message = $this->getSetu(true);
        
          if ($message != '程序异常!') {
            $callback['sendMsgType'] = 'PicMsg';
            $callback['content'] = '';
            $callback['picUrl'] = $message;
            $callback['picBase64Buf'] = '';
            $callback['fileMd5'] = '';
          }

          Notification::send(request()->user(), new IotBotChannelNotification($callback));
      }
    }

    /**
     * Handle the event.
     *
     * @param  IotBotGroup  $event
     * @return void
     */
    public function handleSweetSentence(IotBotGroup $event)
    {
        $data = $event->getData();

        if (in_array($data['FromGroupId'],config('iotbot.white_group')) && strstr($data['Content'], '撩我')) {
          $callback = [
              'toUser' => $data['FromGroupId'] ,
              'sendToType' => 2,
              'sendMsgType' => 'TextMsg',
              'content' => '程序异常!',
              'groupid' => 0,
              'atUser' => $data['FromUserId'],
          ];
          
          $message = $this->getSweetSentence();
        
          if ($message != '程序异常!') {
            $callback['content'] = $message;
          }

          Notification::send(request()->user(), new IotBotChannelNotification($callback));
      }
    }

    protected function getSetu($r18 = false)
    {
        $query = [
          'r18' => $r18
        ];
        $message = '程序异常!';
        try {
            $client = new Client();
            $response = $client->request('GET', 'http://api.yuban10703.xyz:2333/setu', ['query' => $query]);
            if ($response->getStatusCode() === 200) {
                $response = json_decode($response->getBody()->getContents(), true);
                $message = 'https://cdn.jsdelivr.net/gh/laosepi/setu/pics/' . $response['filename'][0];
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
            if ($response->getStatusCode() === 200) {
                $message = $response->getBody()->getContents();
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }

        return $message;
    }
}
