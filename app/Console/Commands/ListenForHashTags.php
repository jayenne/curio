<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use TwitterStreamingApi;

class ListenForHashTags extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'twitter:hashtags';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Listen for hashtags being used on Twitter';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        TwitterStreamingApi::publicStream()
            ->whenHears('#addcurio', function (array $tweet) {
                //dump("{$tweet['user']['screen_name']} tweeted {$tweet['text']}");
            })
            ->startListening();
    }
}
