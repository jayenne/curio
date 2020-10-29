<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Bus\DispatchesJobs;

use Twitter;

class SendDmTweet implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $data ;
    protected $config ;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
        $this->data['format'] = 'json';
        $this->data['type'] = 'message_create';
        $this->data['message_create'] =[
            'target' => ['recipient_id' => $this->data['target']],
            'message_data' => ['text' => $this->data['text']]
        ];

        $this->config = [
            'listener' => [
                'screen_name' => config('platform.twitter.listener_screen_name'),
                'user_id' => config('platform.twitter.listener_id')
            ],
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
        // check is following then add follow if false;
        Twitter::reconfig($this->data['target_auth']);
        $friendships = Twitter::getFriendshipsLookup($this->config['listener']);
        $following = in_array('following', array_values($friendships[0]->connections)) ? true : false;
        if (!$following) {
            Twitter::postFollow($this->config['listener']);
        }
        // post dm
        Twitter::reconfig($this->config);
        $response = Twitter::postDm($this->data);
        return;// $response;
    }
}
