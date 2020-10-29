<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Queue;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Carbon\Carbon;
use Tests\TestCase;
use App\Jobs\ProcessTweet;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Log;

class TweetTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testTweets()
    {
        $path = base_path('tests/data/');
        $files = glob($path.'*.json');

        foreach ($files as $file) {
            $string = file_get_contents($file);
            $tweet = json_decode($string, true);
  
            Queue::fake();
            $job = (new ProcessTweet($tweet))->onQueue('addcurio');
            dispatch($job);
            Queue::assertPushed(ProcessTweet::class, function ($job) use ($tweet, $file) {
                $date = Carbon::parse($tweet['created_at'])->toDateTimeString();
                $posted = $job->handle()->posted_at ?? null;
                $success = $posted == $date ?: false;
                $mark = $success ? "✓ " : "✘ ";
                $white = "\033[0m ";
                $red = "\033[31m ";
                $green = "\033[32m ";
                $color = $success ? $green : $red;
                $msg = $color.$mark.$file."\n\r".$white;
                fwrite(STDERR, print_r($msg, true));
                $white = "\033[0m ";
                return $success;
            });
            
            Queue::assertPushedOn('addcurio', ProcessTweet::class);
        }
    }
}
