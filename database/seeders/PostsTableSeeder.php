<?php

namespace Database\Seeders;

use App\Board;
use App\Helpers\CuriousPeople\CuriousNum;
use App\Helpers\CuriousPeople\CuriousStorage;
use App\Post;
use App\PostMentions;
//use Illuminate\Support\Facades\File;
//use Illuminate\Support\Facades\Storage;

use App\PostUrls;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Tags\Tag;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function run()
    {
        //Model::unsetEventDispatcher();
        Model::unguard();
        $this->setFKCheckOff();
        Post::truncate();
        PostMentions::truncate();
        PostUrls::truncate();

        // BOARD
        $board_count = Board::count() ?: 0;
        if (! $board_count > 0) {
            die(error_log('There are no boards to add posts to'));
        }
        $output = new ConsoleOutput();
        $progress = new ProgressBar($output, $board_count);
        $progress->setFormat('%message%: %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%'."\n");
        $progress->setMessage('Generating Posts');
        $progress->start();

        Board::chunk(100, function ($boards) use ($progress) {
            foreach ($boards as $board) {
                $posts_num = CuriousNum::getRandomBias(config('seeder.posts.count'));
                $output_posts = new ConsoleOutput();
                $progress_posts = new ProgressBar($output_posts, $posts_num);
                $progress_posts->setFormat('%message%: %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%'."\n");
                $progress_posts->setMessage('Creating Posts');
                $progress_posts->start();
                // POSTS
                $posts = $board->posts()
                    ->saveMany(
                        Post::factory()->count($posts_num)
                            ->create(['user_id'=>$board->user_id])
                            ->each(
                                function ($post) use ($progress_posts) {
                                    $post_status_array = config('platform.database.posts.status.options');
                                    $post_status = array_rand($post_status_array);
                                    $post->setStatus($post_status_array[$post_status], 'seeded');
                                    $mentions_num = CuriousNum::getRandomBias(config('seeder.posts.mentions'));
                                    $post->mentions()->saveMany(PostMentions::factory()->count($mentions_num)->make());
                                    $urls_num = CuriousNum::getRandomBias(config('seeder.posts.urls'));
                                    $post->urls()->saveMany(PostUrls::factory()->count($urls_num)->make());

                                    $progress_posts->advance();
                                }
                            )
                    );
                $progress_posts->clear();
                $progress_posts->finish();
                $progress->advance();
            }
            $progress_posts->clear();
            $progress_posts->finish();
            $progress->clear();
        });
        $progress->finish();

        $this->setFKCheckOn();
        Model::reguard();
    }

    private function setFKCheckOff()
    {
        switch (DB::getDriverName()) {
            case 'mysql':
                DB::statement('SET FOREIGN_KEY_CHECKS=0');
                break;
            case 'sqlite':
                DB::statement('PRAGMA foreign_keys = OFF');
                break;
        }
    }

    private function setFKCheckOn()
    {
        switch (DB::getDriverName()) {
            case 'mysql':
                DB::statement('SET FOREIGN_KEY_CHECKS=1');
                break;
            case 'sqlite':
                DB::statement('PRAGMA foreign_keys = ON');
                break;
        }
    }
}
