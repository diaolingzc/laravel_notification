<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use QL\QueryList;
use App\Events\IotBot;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;

class GithubTrending extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'iot:github';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Github trending';

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
        $githubTrendings = $this->getGithubTrendings();

        DB::table('github_trendings')->insert($githubTrendings);

        $iotBotGithubTrendings = array_chunk($githubTrendings, 5);

        $data = [
          'toUser' => config('iotbot.github_group'),
          'sendToType' => 2,
          'sendMsgType' => 'TextMsg',
          'content' => '',
          'groupid' => 0,
          'atUser' => 0,
        ];

        for ($i = 0; $i < count($iotBotGithubTrendings); ++$i) {
            $j = $i + 1;
            $message = 'GithubTrending: '.date('Y-m-d H:i:s').' Part '.$j.PHP_EOL;

            foreach ($iotBotGithubTrendings[$i] as $key => $value) {
                $message .= PHP_EOL.$value['author'].'/'.$value['repository'].': '.$this->getSinaShortUrl($value['url']).PHP_EOL.$value['description'].PHP_EOL.$value['language'].' '.$value['star'].' '.$value['fork'];
            }

            $this->info($message);

            $data['content'] = $message;

            event(new IotBot($data));
        }
    }

    protected function getSinaShortUrl($url)
    {
        $client = new Client();
        $url = 'http://suo.im/api.htm?format=json&url='.urlencode($url).'&key='.config('iotbot.suoim_key').'&expireDate='.date('Y-m-d', strtotime('+7 day'));
        $response = $client->request('GET', $url);

        if (200 === $response->getStatusCode()) {
            return substr(json_decode($response->getBody()->getContents(), true)['url'], 7);
        } else {
            return substr($url, 7);
        }
    }

    protected function getGithubTrendings(string $language = '')
    {
        $githubTrendingUrl = 'https://github.com/trending';

        if ($language) {
            $githubTrendingUrl .= '/'.$language;
        }

        $ql = QueryList::get($githubTrendingUrl);

        $rules = [
        'url' => ['h1>a:eq(0)', 'href'],
        'description' => ['p', 'text'],
        'star' => ['div:eq(1)>a:eq(0)', 'text'],
        'language' => ['div:eq(1)>span:eq(0)>span:eq(1)', 'text'],
        'fork' => ['div:eq(1)>a:eq(1)', 'text'],
      ];

        $range = '.Box>div:eq(1)>.Box-row';

        $rt = $ql->rules($rules)->range($range)->query()->getData();

        // 过滤结果
        $data = $rt->map(function ($item) {
            preg_match('/^\/(?P<author>.*)\/(?P<repository>.*)/', $item['url'], $match);
            $item['author'] = $match['author'];
            $item['repository'] = $match['repository'];
            $item['url'] = 'https://github.com'.$item['url'];
            $item['star'] = str_replace(',', '', $item['star']);
            $item['fork'] = str_replace(',', '', $item['fork']);
            $item['created_at'] = $item['updated_at'] = date('Y-m-d H:i:s');

            foreach ($item as $key => $value) {
                $item[$key] = trim($value);
            }

            return $item;
        })->all();

        return $data;
    }
}
