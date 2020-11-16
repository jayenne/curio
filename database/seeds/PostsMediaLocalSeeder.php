<?php

use App\Helpers\CuriousPeople\CuriousNum;
use App\Helpers\CuriousPeople\CuriousStorage;
use App\Helpers\CuriousPeople\CuriousUrl;
use App\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

//use Faker\Generator as Faker;

class PostsMediaLocalSeeder extends Seeder
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
        DB::table('media')->where('model_type', 'App\Post')->delete();

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

                $addimg = rand(0, 10);
                if ($post->type == 'image' || ($addimg > 7 && $post->type != 'text')) {
                    $img = CuriousStorage::randomFileFromPath('/public/seeder/covers/');
                    $url = storage_path('app/'.$img);
                    $post->addMedia($url)
                    ->usingFileName(Str::uuid())
                    ->preservingOriginal()
                    ->toMediaCollection('cover');
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
