<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;

class FlushPlatform extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'platform:flush {--deep : perform a deep flush or a light clean} {--queue : just restart the queue and flush the logs}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rebases the platform to an entirly clean version';

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
        $deep = $this->option('deep');
        $queue = $this->option('queue');
        $this->call('config:cache');
        
        if ($queue) {
            //  Flush Redis
            Redis::command('flushdb');
            $this->call('logs:flush');
            $this->call('queue:flush');
            $this->call('queue:restart');

            return true;
        }

        if ($deep) {
            system('composer dump-autoload');
            system('composer install');
            //  Add storage link
            if (!\File::exists('public/storage')) {
                $this->call('storage:link');
            } else {
                $this->info('The symblink "public/storage" already exists.');
                // delete old image uploads
                if (\File::exists('storage/app/public/users/media')) {
                    \File::deleteDirectory("storage/app/public/users/media/");
                    $this->info('users/media folder removed.');
                } else {
                    $this->info('can`t find users/media folder.');
                };
                if (\File::exists('storage/media-library')) {
                    \File::deleteDirectory("storage/media-library");
                    $this->info('media-library folder removed.');
                } else {
                    $this->info('can`t find media-library folder.');
                };
                if (\File::exists('storage/app/public/images/grids')) {
                    \File::cleanDirectory("storage/app/public/images/grids");
                    $this->info('images/grids folder cleaned.');
                } else {
                    \File::makeDirectory("storage/app/public/images/grids");
                    $this->info('Created images/grids folder.');
                };
            }
            //  Generate app key
            $this->call('key:generate');
            // install Horizon
            $this->call('horizon:install');
            // install Telescope
            $this->call('telescope:install');
            // flush sessions
            $this->call('session:flush', ['--driver'=>'all']);
        }
        //  Migrate & Seed DB
        $this->call('migrate:fresh');
        $this->call('DB:seed');
        $this->call('love:recount');
    
        //  Flush Redis
        Redis::command('flushdb');
        //  Flush Queues
        $this->call('queue:flush');
        //  Flush logs
        $this->call('logs:flush');
        // publish
        $this->call('telescope:publish');
        // set Caches
        $this->call('config:cache');
        //$this->call('route:cache');
        $this->call('view:cache');
        // restart queue
        $this->call('queue:restart');
    }
}
