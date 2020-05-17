<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use App\Events\IotBot;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class IotBili extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'iot:bili';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'iot:bili';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Client $client)
    {
        Log::info('iot:bili 执行:' . date('Y-m-d H:i:s'));
        $live_status = Cache::get(config('iotbot.bili_up_id'), 0);

        $response = json_decode($client->get('https://api.live.bilibili.com/room/v1/Room/get_info?&platform=h5&room_id=' . config('iotbot.bili_up_id'))->getBody()->getContents(), true);


        $data = [
          'toUser' => config('iotbot.bili_up_qq'),
          'sendToType' => 2,
          'sendMsgType' => 'TextMsg',
          'content' => '',
          'groupid' => 0,
          'atUser' => 0,
        ];
        $message = '';
        if ($live_status != $response['data']['live_status']) {
          switch ($live_status) {
            case 1:
              Cache::put(config('iotbot.bili_up_id'), 0);
              $live_time = Cache::pull(config('iotbot.bili_up_id') . 'live_time');
              $message = '您喜欢的 UP主 已经下播啦！' . PHP_EOL . '今日共直播 ' . date('G小时i分钟', time()-$live_time-8*3600) . '。 继续加油哦！(*^▽^*)';
              break;
            case 0:
              Cache::put(config('iotbot.bili_up_id'), 1);
              Cache::put(config('iotbot.bili_up_id') . 'live_time', strtotime($response['data']['live_time']));
              $message = '您喜欢的 UP 主已经开播啦！' . PHP_EOL . '快访问 live.bilibili.com/' . config('iotbot.bili_up_id') . ' 观看吧！';
            default:
              break;
          }

          $data['content'] = $message;

          $this->info(json_encode($data));
          event(new IotBot($data));
        }
    }
}
