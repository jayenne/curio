<?php

namespace Database\Seeders;

use App\Board;
use App\Helpers\CuriousPeople\CuriousNum;
use App\Helpers\CuriousPeople\CuriousStorage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Tags\Tag;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

//use Faker\Generator as Faker;

class BoardsTagsSeeder extends Seeder
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

        // BOARD
        $boards_count = Board::count();
        $output = new ConsoleOutput();
        $progress = new ProgressBar($output, $boards_count);
        $progress->setFormat('%message%: %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%'."\n");
        $progress->setMessage('Generating Board Tags');
        $progress->start();

        Board::chunk(100, function ($boards) use ($progress, $boards_count, $faker) {
            foreach ($boards as $board) {
                $output_tags = new ConsoleOutput();
                $progress_tags = new ProgressBar($output_tags, $boards_count);
                $progress_tags->setFormat('%message%: %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%'."\n");
                $progress_tags->setMessage('Creating Tags');
                $progress_tags->start();

                $tags_count = CuriousNum::getRandomBias(config('seeder.boards.hashtags'));
                for ($i = 0; $i < $tags_count; $i++) {
                    $tag = $faker->word;
                    $this_tag = Tag::findOrCreate($tag, 'hashtag');
                    $board->attachTag($this_tag);
                    $progress_tags->advance();
                }

                $cats_count = CuriousNum::getRandomBias(config('seeder.boards.categories'));
                for ($i = 0; $i < $cats_count; $i++) {
                    $tag = $faker->word;
                    $this_tag = Tag::findOrCreate($tag, 'category');
                    $board->attachTag($this_tag);
                    $progress_tags->advance();
                }

                $progress_tags->clear();
                $progress->advance();
            }
            $progress_tags->clear();
            $progress_tags->finish();
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
