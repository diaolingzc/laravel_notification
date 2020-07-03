<?php

namespace App\Listeners;

use App\Events\IotBotGroup;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\IotBotNotification as IotBotChannelNotification;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class IotBotGroupNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param IotBotGroup $event
     */
    public function handleToSeTu(IotBotGroup $event)
    {
        Log::info('handleToSeTu：'.date('Y-m-d H:i:s'));
        $data = $event->getData();
        $is_r18 = Redis::sismember('iotbot_r18_white_group', $data['FromGroupId']);

        if ((in_array($data['FromGroupId'], config('iotbot.white_group')) || Redis::sismember('iotbot_setu_white_group', $data['FromGroupId'])) && strstr($data['Content'], 'setu')) {
            $callback = [
              'toUser' => $data['FromGroupId'],
              'sendToType' => 2,
              'sendMsgType' => 'TextMsg',
              'content' => '程序异常!',
              'groupid' => 0,
              'atUser' => $data['FromUserId'],
          ];

            $message = $this->getSetu($is_r18);

            if ('程序异常!' != $message) {
                $callback['sendMsgType'] = 'PicMsg';
                $callback['content'] = '';
                $callback['picUrl'] = $message;
                $callback['picBase64Buf'] = '';
                $callback['fileMd5'] = '';
            }
            Log::info(json_encode($message));
            Log::info('Notification：'.date('Y-m-d H:i:s'));
            Notification::send(request()->user(), new IotBotChannelNotification($callback));
            Log::info('NotificationEnd：'.date('Y-m-d H:i:s'));
        }
        Log::info('handleToSeTuEnd：'.date('Y-m-d H:i:s'));

        return;
    }

    /**
     * Handle the event.
     *
     * @param IotBotGroup $event
     */
    public function handleToMeiZi(IotBotGroup $event)
    {
        Log::info('handleToSeTu：'.date('Y-m-d H:i:s'));
        $data = $event->getData();

        if ((in_array($data['FromGroupId'], config('iotbot.white_group')) || Redis::sismember('iotbot_meizi_white_group', $data['FromGroupId'])) && strstr($data['Content'], 'meizi')) {
            $callback = [
              'toUser' => $data['FromGroupId'],
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
            Log::info('Notification：'.date('Y-m-d H:i:s'));
            Notification::send(request()->user(), new IotBotChannelNotification($callback));
            Log::info('NotificationEnd：'.date('Y-m-d H:i:s'));
        }
        Log::info('handleToSeTuEnd：'.date('Y-m-d H:i:s'));

        return;
    }

    /**
     * Handle the event.
     *
     * @param IotBotGroup $event
     */
    public function handleToJio(IotBotGroup $event)
    {
        Log::info('handleToJio'.date('Y-m-d H:i:s'));
        $data = $event->getData();

        if ((in_array($data['FromGroupId'], config('iotbot.white_group')) || Redis::sismember('iotbot_meizi_white_group', $data['FromGroupId'])) && strstr($data['Content'], 'jio')) {
            $callback = [
              'toUser' => $data['FromGroupId'],
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
            Log::info('Notification：'.date('Y-m-d H:i:s'));
            Notification::send(request()->user(), new IotBotChannelNotification($callback));
            Log::info('NotificationEnd：'.date('Y-m-d H:i:s'));
        }
        Log::info('handleToJioEnd: '.date('Y-m-d H:i:s'));

        return;
    }

    /**
     * Handle the event.
     *
     * @param IotBotGroup $event
     */
    public function handleToNaiZi(IotBotGroup $event)
    {
        Log::info('handleToNaiZi'.date('Y-m-d H:i:s'));
        $data = $event->getData();

        if ((in_array($data['FromGroupId'], config('iotbot.white_group')) || Redis::sismember('iotbot_meizi_white_group', $data['FromGroupId'])) && strstr($data['Content'], 'naizi')) {
            $callback = [
              'toUser' => $data['FromGroupId'],
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
            Log::info('Notification：'.date('Y-m-d H:i:s'));
            Notification::send(request()->user(), new IotBotChannelNotification($callback));
            Log::info('NotificationEnd：'.date('Y-m-d H:i:s'));
        }
        Log::info('handleToNaiZiEnd: '.date('Y-m-d H:i:s'));

        return;
    }

    /**
     * Handle the event.
     *
     * @param IotBotGroup $event
     */
    public function handleToCoser(IotBotGroup $event)
    {
        Log::info('handleToCoser: '.date('Y-m-d H:i:s'));
        $data = $event->getData();
        $is_r18 = Redis::sismember('iotbot_r18_white_group', $data['FromGroupId']);

        if ( (in_array($data['FromGroupId'], config('iotbot.white_group')) || Redis::sismember('iotbot_cos_white_group', $data['FromGroupId'])) && strstr($data['Content'], 'cos')) {
            $callback = [
              'toUser' => $data['FromGroupId'],
              'sendToType' => 2,
              'sendMsgType' => 'TextMsg',
              'content' => '程序异常!',
              'groupid' => 0,
              'atUser' => $data['FromUserId'],
          ];

            $coser = DB::table('coser_imgs')->where('is_r18', $is_r18)->inRandomOrder()->first();
            
            if ($coser) {
                $callback['sendMsgType'] = 'PicMsg';
                $callback['content'] = '';
                
                // 若 img 存在, 则使用自定义域名地址图片，否则源站下载后转base64
                if ($coser->img) {
                  $callback['picUrl'] = config('iotbot.web_custom_img_path') . $coser->img;
                  $callback['picBase64Buf'] = '';
                  $callback['fileMd5'] = '';
                } else {
                  $callback['picUrl'] = '';
                  $callback['picBase64Buf'] = $this->webImgToBase64($coser->url, $coser->origin);
                  $callback['fileMd5'] = '';
                }
            }
            Log::info(json_encode($callback));
            Log::info('Notification：'.date('Y-m-d H:i:s'));
            Notification::send(request()->user(), new IotBotChannelNotification($callback));
            Log::info('NotificationEnd：'.date('Y-m-d H:i:s'));
        }
        Log::info('handleToCoserEnd: '.date('Y-m-d H:i:s'));

        return;
    }

    /**
     * Handle the event.
     *
     * @param IotBotGroup $event
     */
    public function handleSweetSentence(IotBotGroup $event)
    {
        Log::info('handleSweetSentence：'.date('Y-m-d H:i:s'));
        $data = $event->getData();

        if ((in_array($data['FromGroupId'], config('iotbot.white_group')) || Redis::sismember('iotbot_sweet_white_group', $data['FromGroupId'])) && strstr($data['Content'], '撩我')) {
            $callback = [
              'toUser' => $data['FromGroupId'],
              'sendToType' => 2,
              'sendMsgType' => 'TextMsg',
              'content' => '程序异常!',
              'groupid' => 0,
              'atUser' => $data['FromUserId'],
          ];

            $message = $this->getSweetSentence();

            if ('程序异常!' != $message) {
                $callback['content'] = "\n" . $message;
            }
            Log::info(json_encode($message));
            Notification::send(request()->user(), new IotBotChannelNotification($callback));
        }
        Log::info('handleSweetSentenceEnd：'.date('Y-m-d H:i:s'));

        return;
    }

    /**
     * Handle the event.
     *
     * @param IotBotGroup $event
     */
    public function handleToReStart(IotBotGroup $event)
    {
        Log::info('handleToReStart'.date('Y-m-d H:i:s'));
        $data = $event->getData();

        if (in_array($data['FromUserId'], config('iotbot.master')) && strstr($data['Content'], 'shell')) {
            $callback = [
                'toUser' => $data['FromGroupId'],
                'sendToType' => 2,
                'sendMsgType' => 'TextMsg',
                'content' => '程序异常!',
                'groupid' => 0,
                'atUser' => $data['FromUserId'],
            ];

            $output = '';
            switch ($data['Content']) {
              case 'shell:restart iot':
                  exec(config('iotbot.shell.iot_stop'), $output);
                  exec(config('iotbot.shell.iot_start'));

                  break;
              default:
                  $output = '命令未知!';

                  break;
            }

            Log::info(json_encode($output));

            if ('命令未知!' != $output) {
                $callback['content'] = "\n重启成功!";
            }
            Log::info(json_encode($callback));
            sleep(10);
            Notification::send(request()->user(), new IotBotChannelNotification($callback));
        }
        Log::info('handleToReStartEnd：'.date('Y-m-d H:i:s'));

        return;
    }

    /**
     * Handle the event.
     *
     * @param IotBotGroup $event
     */
    public function handleSetConfig(IotBotGroup $event)
    {
        Log::info('handleSetConfig: '.date('Y-m-d H:i:s'));
        $data = $event->getData();

        if (in_array($data['FromUserId'], config('iotbot.master')) && strstr($data['Content'], 'config')) {
            $callback = [
                'toUser' => $data['FromGroupId'],
                'sendToType' => 2,
                'sendMsgType' => 'TextMsg',
                'content' => '命令未知!',
                'groupid' => 0,
                'atUser' => $data['FromUserId'],
            ];

            $output = '';
            switch ($data['Content']) {
              case 'config:open cos command':
                  Redis::sadd('iotbot_cos_white_group', $data['FromGroupId']);
                  $output = "\n开启群 ". $data['FromGroupId'] ." cos 权限！可执行命令 'cos'";
                  break;

              case 'config:close cos command':
                  Redis::srem('iotbot_cos_white_group', $data['FromGroupId']);
                  $output = "\n已关闭群 ". $data['FromGroupId'] ." cos 权限！";
                  break;
              
              case 'config:open meizi command':
                  Redis::sadd('iotbot_meizi_white_group', $data['FromGroupId']);
                  $output = "\n开启群 ". $data['FromGroupId'] ." meizi 权限！可执行命令 'meizi' 'jio' 'naizi'";
                  break;
  
              case 'config:close meizi command':
                  Redis::srem('iotbot_meizi_white_group', $data['FromGroupId']);
                  $output = "\n已关闭群 ". $data['FromGroupId'] ." meizi 权限！";
                  break;

                case 'config:open sweet command':
                  Redis::sadd('iotbot_sweet_white_group', $data['FromGroupId']);
                  $output = "\n开启群 ". $data['FromGroupId'] ." sweet 权限！可执行命令 '撩我'";
                  break;
    
                case 'config:close sweet command':
                  Redis::srem('iotbot_sweet_white_group', $data['FromGroupId']);
                  $output = "\n已关闭群 ". $data['FromGroupId'] ." sweet 权限！";
                  break;

                case 'config:open setu command':
                  Redis::sadd('iotbot_setu_white_group', $data['FromGroupId']);
                  $output = "\n开启群 ". $data['FromGroupId'] ." setu 权限！可执行命令 'setu'";
                  break;
      
                case 'config:close setu command':
                  Redis::srem('iotbot_setu_white_group', $data['FromGroupId']);
                  $output = "\n已关闭群 ". $data['FromGroupId'] ." setu 权限！";
                  break;

                case 'config:open r18 command':
                  Redis::sadd('iotbot_r18_white_group', $data['FromGroupId']);
                  $output = "\n开启群 ". $data['FromGroupId'] ." r18 权限！命令 'cos' 'setu' 开启 r18 功能";
                  break;
        
                case 'config:close r18 command':
                  Redis::srem('iotbot_r18_white_group', $data['FromGroupId']);
                  $output = "\n已关闭群 ". $data['FromGroupId'] ." r18 权限！";
                  break;

              default:
                  $output = '命令未知!';

                  break;
            }

            if ('命令未知!' != $output) {
                $callback['content'] = $output;
            }
            Log::info(json_encode($callback));
            Notification::send(request()->user(), new IotBotChannelNotification($callback));
        }
        Log::info('handleSetConfigEnd：'.date('Y-m-d H:i:s'));

        return;
    }

    protected function getSetu($r18 = false)
    {
        Log::info('getSetu: '.date('Y-m-d H:i:s'));
        $query = [
          'r18' => $r18,
        ];
        $message = '程序异常!';

        try {
            $client = new Client();
            $response = $client->request('GET', 'http://api.yuban10703.xyz:2333/setu', ['query' => $query]);
            if (200 === $response->getStatusCode()) {
                $response = json_decode($response->getBody()->getContents(), true);
                $message = 'https://cdn.jsdelivr.net/gh/laosepi/setu/pics/'.$response['filename'];
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
        Log::info('getSetuEnd: '.date('Y-m-d H:i:s'));

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

    protected function webImgToBase64(string $img = '', string $refer = '')
    {
        $context = stream_context_create(['http' => ['header' => 'Referer: '.$refer]]);

        return chunk_split(base64_encode(file_get_contents($img, false, $context)));
    }
}
