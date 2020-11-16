<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Twitter;

class SendTweet implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $data;
    protected $config;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
        $this->data['format'] = 'json';

        $this->config = [
            'app_name' => config('app.name'),
            'token' => config('laravel-twitter-streaming-api.access_token'),
            'secret' => config('laravel-twitter-streaming-api.access_token_secret'),
        ];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Twitter::reconfig($this->config);
        $response = Twitter::postTweet($this->data);
        //\Log::channel('dev')->info(['postTweet' => $response]);
        return $response;
    }
}
