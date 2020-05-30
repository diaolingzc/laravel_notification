<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

      $data = DB::table('coser_imgs')->where('img', null)->limit(10)->get()->map(function ($value) {
        return (array)$value;
      })->toArray();

      foreach ($data as $key => $value) {
        $localImgData = $this->webImgToLocalImg($value['url'], config('iotbot.local_img_path'), $value['is_r18'] ? 'https://www.zazhitaotu.com' : 'https://amlyu.com/');

        $value['img'] = $localImgData['img'];
        DB::table('coser_imgs')->where('id', $value['id'])->update($value);

        Log::info('已更新图片：' . $value['id']);
      }
    }

    protected function webImgToLocalImg(string $url, string $path = '.', string $refer = 'https://amlyu.com/')
    {
      $type = '.' . pathinfo( parse_url( $url, PHP_URL_PATH ), PATHINFO_EXTENSION );
      $base64 = chunk_split(base64_encode(file_get_contents($url, false, stream_context_create(['http' => ['header' => 'Referer: '.$refer]]))));
      $base64Hash = hash('sha256', $base64);
      $localImgPath = $path . '/' . hash('sha256', $base64) . $type;
      if (file_put_contents($localImgPath, base64_decode($base64))) {
        return ['img' => hash('sha256', $base64) . $type, 'localImgPath' => $localImgPath];
      } else {
        return false;
      }
    }
}
