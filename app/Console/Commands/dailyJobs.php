<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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
    }
}
