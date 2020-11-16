<?php

namespace App\Console\Commands;

use App\Jobs\ProcessTweet;
use Illuminate\Console\Command;
use Illuminate\Foundation\Bus\DispatchesJobs;
use TwitterStreamingApi;

class ListenForMentions extends Command
{
    use DispatchesJobs;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'twitter:mentions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Listen for mentions of a given handle on Twitter';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $handle = config('platform.twitter.listener_handle');
        TwitterStreamingApi::publicStream()
            ->whenHears($handle, function (array $tweet) {
                //\Log::channel('dev')->info(['found_tweet' => $tweet['id']]);
                $job = (new ProcessTweet($tweet))->onQueue('addcurio');
                $this->dispatch($job);
            })
            ->startListening();
    }
}
