<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        $schedule->call(function () {
            Log::info(date('Y-m-d H:i:s'));
        })->everyMinute();
        $schedule->command('command:dailyJobs')->everyMinute();

        $schedule->command('iot:bili')->everyMinute();

        $schedule->command('iot:news')->twiceDaily(8, 12);

        $schedule->command('iot:news')->twiceDaily(17, 22);

        $schedule->command('iot:github')->twiceDaily(18);
    }

    /**
     * Register the commands for the application.
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
