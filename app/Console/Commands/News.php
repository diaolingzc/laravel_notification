<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use App\Events\IotBot;

class News extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'iot:news';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'iot news';

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
        $response = json_decode($client->get('https://pacaio.match.qq.com/irs/rcd?cid=108&ext=&token=349ee24cdf9327a050ddad8c166bd3e3&page=1&expIds=')->getBody()->getContents(), true);

        $message = '腾讯新闻：'. date('Y-m-d H:i:s') . PHP_EOL;
        for ($i=0; $i < count($response['data']); $i++) { 
          $message .= PHP_EOL . $response['data'][$i]['title'] . ": " . $this->getSinaShortUrl($response['data'][$i]['surl']);
        }
        $this->info($message);
        $data = [
          'toUser' => config('iotbot.news_group'),
          'sendToType' => 2,
          'sendMsgType' => 'TextMsg',
          'content' => $message,
          'groupid' => 0,
          'atUser' => 0,
        ];
        event(new IotBot($data));
    }

    protected function getSinaShortUrl($url)
    {
      $client = new Client();
      $url = 'http://suo.im/api.htm?format=json&url=' . urlencode($url) . '&key=' . config('iotbot.suoim_key') . '&expireDate=' . date("Y-m-d",strtotime("+1 day"));
      $response = $client->request('GET', $url);

      if ($response->getStatusCode() === 200) {
        return substr(json_decode($response->getBody()->getContents(), true)['url'], 7);
      } else {
        return substr($url, 7);
      }
    }
}
