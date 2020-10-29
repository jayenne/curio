<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class FlushLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'logs:flush';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove all log files';

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
     * @return int
     */
    public function handle()
    {
        exec('rm ' . storage_path('logs/*.log'));
        $this->comment('Logs have been cleared!');
    }
}
