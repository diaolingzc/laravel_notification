<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use App\Events\IotBotGroup;

class IotCoser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'iot:coser';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'iot:coser';

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
    public function handle()
    {
        $data = [
        'FromGroupId' => config('iotbot.news_group'),
        'FromUserId' => config('iotbot.robot_qq'),
        'MsgType' => 'TextMsg',
        'Content' => 'cos'
    ];

        event(new IotBotGroup($data));
    }
}
