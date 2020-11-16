<?php

use App\Helpers\CuriousPeople\CuriousNum;
use App\Helpers\CuriousPeople\CuriousStorage;
use App\Helpers\CuriousPeople\CuriousUrl;
use App\Post;
use App\PostRemoteMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

//use Faker\Generator as Faker;

class PostsMediaRemoteSeeder extends Seeder
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
        $faker = Faker\Factory::create();
        Model::unguard();
        $this->setFKCheckOff();
        PostRemoteMedia::truncate();

        // POST
        $posts_count = Post::count();
        $output = new ConsoleOutput();
        $progress = new ProgressBar($output, $posts_count);
        $progress->setFormat('%message%: %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%'."\n");
        $progress->setMessage('Generating Post Images');
        $progress->start();

        Post::chunk(100, function ($posts) use ($progress, $posts_count, $faker) {
            $output_model = new ConsoleOutput();
            $progress_model = new ProgressBar($output_model, $posts_count);
            $progress_model->setFormat('%message%: %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%'."\n");
            $progress_model->setMessage('Creating Images');
            $progress_model->start();

            foreach ($posts as $post) {
                // add remote images
                $num = CuriousNum::getRandomBias(config('seeder.posts.media'));
                $protocol = config('platform.app.protocol');
                $domain = config('platform.app.url');

                switch ($post->type) {
                    case 'image':
                        $num = CuriousNum::getRandomBias(config('seeder.posts.media'));
                        $post->remoteMedia()->saveMany(factory(PostRemoteMedia::class, $num)->make(['type'=>'image']));
                        break;
                    case 'video':
                        $file = config('platform.media.posts.medium.missing.video');
                        $url = $protocol.$domain.$file;
                        $post->remoteMedia()->save(factory(PostRemoteMedia::class)->make(['type'=>'video', 'url' => $url]));
                        break;
                    case 'anim':
                        $file = CuriousStorage::randomFileFromPath('/public/seeder/gifs/');
                        $file = str_replace('public', '/storage', $file);
                        $url = $protocol.$domain.$file;
                        $post->remoteMedia()->save(factory(PostRemoteMedia::class)->make(['type'=>'anim', 'url' => $url]));
                        break;
                    case 'audio':
                        $file = config('platform.media.posts.medium.missing.audio');
                        $url = $protocol.$domain.$file;
                        $post->remoteMedia()->save(factory(PostRemoteMedia::class)->make(['type'=>'audio', 'url' => $url]));
                        break;
                }

                $progress_model->advance();
            }
            $progress_model->clear();
            $progress_model->finish();
            $progress->advance();
        });
        $progress->clear();
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
