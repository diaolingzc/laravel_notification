<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Events\IotBot;

class dailyJobs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:dailyJobs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'dailyJobs';

    /**
     * Create a new command instance.
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
    public function handle()
    {
        $data = DB::table('coser_imgs')->where('img', null)->limit(20)->get()->map(function ($value) {
            return (array) $value;
        })->toArray();

        foreach ($data as $key => $value) {
            try {
                $localImgData = $this->webImgToLocalImg($value['url'], config('iotbot.local_img_path'), $value['is_r18'] ? 'https://www.zazhitaotu.com' : 'https://amlyu.com/');

                $value['img'] = $localImgData['img'];
                DB::table('coser_imgs')->where('id', $value['id'])->update($value);

                Log::info('已更新图片：'.$value['id']);
            } catch (\Exception $e) {
                Log::debug($e->getMessage());
                $data =
                event(new IotBot([
                  'toUser' => config('iotbot.master')[0],
                  'sendToType' => 1,
                  'sendMsgType' => 'TextMsg',
                  'content' => '程序异常: id-'.$value['id'],
                  'groupid' => 0,
                  'atUser' => 0,
                ]));
            }
        }
    }

    protected function webImgToLocalImg(string $url, string $path = '.', string $refer = 'https://amlyu.com/')
    {
        $type = '.'.pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION);

        $arrContextOptions = [
        'http' => [
          'header' => 'Referer: '.$refer,
        ],
        'ssl' => [
          'verify_peer' => false,
          'verify_peer_name' => false,
        ],
      ];
        $base64 = chunk_split(base64_encode(file_get_contents($url, false, stream_context_create($arrContextOptions))));

        $base64Hash = hash('sha256', $base64);
        $localImgPath = $path.'/'.hash('sha256', $base64).$type;
        if (file_put_contents($localImgPath, base64_decode($base64))) {
            return ['img' => hash('sha256', $base64).$type, 'localImgPath' => $localImgPath];
        } else {
            return false;
        }
    }
}
