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
use Illuminate\Support\Facades\DB;

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
        Log::info('handleToSeTu：'. date('Y-m-d H:i:s'));
        $data = $event->getData();

        if (in_array($data['FromGroupId'], config('iotbot.white_group')) && strstr($data['Content'], 'setu')) {
            $callback = [
              'toUser' => $data['FromGroupId'] ,
              'sendToType' => 2,
              'sendMsgType' => 'TextMsg',
              'content' => '程序异常!',
              'groupid' => 0,
              'atUser' => $data['FromUserId'],
          ];
          
            $message = $this->getSetu();
        
            if ($message != '程序异常!') {
                $callback['sendMsgType'] = 'PicMsg';
                $callback['content'] = '';
                $callback['picUrl'] = $message;
                $callback['picBase64Buf'] = '';
                $callback['fileMd5'] = '';
            }
            Log::info(json_encode($message));
            Log::info('Notification：'. date('Y-m-d H:i:s'));
            Notification::send(request()->user(), new IotBotChannelNotification($callback));
            Log::info('NotificationEnd：'. date('Y-m-d H:i:s'));
        }
        Log::info('handleToSeTuEnd：'. date('Y-m-d H:i:s'));
        return;
    }

    /**
     * Handle the event.
     *
     * @param  IotBotGroup  $event
     * @return void
     */
    public function handleToMeiZi(IotBotGroup $event)
    {
        Log::info('handleToSeTu：'. date('Y-m-d H:i:s'));
        $data = $event->getData();

        if (in_array($data['FromGroupId'], config('iotbot.white_group')) && strstr($data['Content'], 'meizi')) {
            $callback = [
              'toUser' => $data['FromGroupId'] ,
              'sendToType' => 2,
              'sendMsgType' => 'TextMsg',
              'content' => '程序异常!',
              'groupid' => 0,
              'atUser' => $data['FromUserId'],
          ];
          
            $meizi = DB::table('mei_nv_imgs')->inRandomOrder()->first();
            Log::info(json_encode($meizi));
            if ($meizi) {
                $callback['sendMsgType'] = 'PicMsg';
                $callback['content'] = '';
                $callback['picUrl'] = $meizi->url;
                $callback['picBase64Buf'] = '';
                $callback['fileMd5'] = '';
            }
            Log::info(json_encode($meizi));
            Log::info('Notification：'. date('Y-m-d H:i:s'));
            Notification::send(request()->user(), new IotBotChannelNotification($callback));
            Log::info('NotificationEnd：'. date('Y-m-d H:i:s'));
        }
        Log::info('handleToSeTuEnd：'. date('Y-m-d H:i:s'));
        return;
    }

    /**
     * Handle the event.
     *
     * @param  IotBotGroup  $event
     * @return void
     */
    public function handleToJio(IotBotGroup $event)
    {
        Log::info('handleToJio'. date('Y-m-d H:i:s'));
        $data = $event->getData();

        if (in_array($data['FromGroupId'], config('iotbot.white_group')) && strstr($data['Content'], 'jio')) {
            $callback = [
              'toUser' => $data['FromGroupId'] ,
              'sendToType' => 2,
              'sendMsgType' => 'TextMsg',
              'content' => '程序异常!',
              'groupid' => 0,
              'atUser' => $data['FromUserId'],
          ];
          
            $meizi = DB::table('mei_nv_imgs')->where('tag', '丝袜美腿')->inRandomOrder()->first();
            Log::info(json_encode($meizi));
            if ($meizi) {
                $callback['sendMsgType'] = 'PicMsg';
                $callback['content'] = '';
                $callback['picUrl'] = $meizi->url;
                $callback['picBase64Buf'] = '';
                $callback['fileMd5'] = '';
            }
            Log::info('Notification：'. date('Y-m-d H:i:s'));
            Notification::send(request()->user(), new IotBotChannelNotification($callback));
            Log::info('NotificationEnd：'. date('Y-m-d H:i:s'));
        }
        Log::info('handleToJioEnd: '. date('Y-m-d H:i:s'));
        return;
    }

    /**
     * Handle the event.
     *
     * @param  IotBotGroup  $event
     * @return void
     */
    public function handleToNaiZi(IotBotGroup $event)
    {
        Log::info('handleToNaiZi'. date('Y-m-d H:i:s'));
        $data = $event->getData();

        if (in_array($data['FromGroupId'], config('iotbot.white_group')) && strstr($data['Content'], 'naizi')) {
            $callback = [
              'toUser' => $data['FromGroupId'] ,
              'sendToType' => 2,
              'sendMsgType' => 'TextMsg',
              'content' => '程序异常!',
              'groupid' => 0,
              'atUser' => $data['FromUserId'],
          ];
          
            $meizi = DB::table('mei_nv_imgs')->where('tag', '巨乳')->inRandomOrder()->first();
            Log::info(json_encode($meizi));
            if ($meizi) {
                $callback['sendMsgType'] = 'PicMsg';
                $callback['content'] = '';
                $callback['picUrl'] = $meizi->url;
                $callback['picBase64Buf'] = '';
                $callback['fileMd5'] = '';
            }
            Log::info('Notification：'. date('Y-m-d H:i:s'));
            Notification::send(request()->user(), new IotBotChannelNotification($callback));
            Log::info('NotificationEnd：'. date('Y-m-d H:i:s'));
        }
        Log::info('handleToNaiZiEnd: '. date('Y-m-d H:i:s'));
        return;
    }

    /**
     * Handle the event.
     *
     * @param  IotBotGroup  $event
     * @return void
     */
    public function handleToCoser(IotBotGroup $event)
    {
        Log::info('handleToCoser'. date('Y-m-d H:i:s'));
        $data = $event->getData();

        if (in_array($data['FromGroupId'], config('iotbot.white_group')) && strstr($data['Content'], 'cos')) {
            $callback = [
              'toUser' => $data['FromGroupId'] ,
              'sendToType' => 2,
              'sendMsgType' => 'TextMsg',
              'content' => '程序异常!',
              'groupid' => 0,
              'atUser' => $data['FromUserId'],
          ];
          
            $coser = DB::table('coser_imgs')->inRandomOrder()->first();
            
            if ($coser) {
                $callback['sendMsgType'] = 'PicMsg';
                $callback['content'] = '';
                $callback['picUrl'] = '';
                $callback['picBase64Buf'] = $this->webImgToBase64($coser->url);
                $callback['fileMd5'] = '';
            }
            Log::info(json_encode($callback));
            Log::info('Notification：'. date('Y-m-d H:i:s'));
            Notification::send(request()->user(), new IotBotChannelNotification($callback));
            Log::info('NotificationEnd：'. date('Y-m-d H:i:s'));
        }
        Log::info('handleToCoserEnd: '. date('Y-m-d H:i:s'));
        return;
    }

    /**
     * Handle the event.
     *
     * @param  IotBotGroup  $event
     * @return void
     */
    public function handleSweetSentence(IotBotGroup $event)
    {
        Log::info('handleSweetSentence：'. date('Y-m-d H:i:s'));
        $data = $event->getData();

        if (in_array($data['FromGroupId'], config('iotbot.white_group')) && strstr($data['Content'], '撩我')) {
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
            Log::info(json_encode($message));
            Notification::send(request()->user(), new IotBotChannelNotification($callback));
        }
        Log::info('handleSweetSentenceEnd：'. date('Y-m-d H:i:s'));
        return;
    }

    protected function getSetu($r18 = false)
    {
        Log::info('getSetu: '. date('Y-m-d H:i:s'));
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
        Log::info('getSetuEnd: '. date('Y-m-d H:i:s'));
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

    protected function webImgToBase64(string $img = '')
    {
        $refer = 'https://amlyu.com/';
        $context = stream_context_create(['http' => ['header' => 'Referer: ' . $refer]]);
        return chunk_split(base64_encode(file_get_contents($img, false, $context)));
    }
}
