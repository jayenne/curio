<?php

namespace Database\Seeders;

use App\Board;
use App\Helpers\CuriousPeople\CuriousNum;
use App\Helpers\CuriousPeople\CuriousStorage;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class BoardsTableSeeder extends Seeder
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
        Board::truncate();

        // BOARD
        $user_count = User::count();
        $output = new ConsoleOutput();
        $progress = new ProgressBar($output, $user_count);
        $progress->setFormat('%message%: %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%'."\n");
        $progress->setMessage('Generating Boards');
        $progress->start();

        User::chunk(100, function ($users) use ($progress) {
            foreach ($users as $user) {
                $boards_num = CuriousNum::getRandomBias(config('seeder.boards.count'));
                $output_boards = new ConsoleOutput();
                $progress_boards = new ProgressBar($output_boards, $boards_num);
                $progress_boards->setFormat('%message%: %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%'."\n");
                $progress_boards->setMessage('Creating Board');
                $progress_boards->start();

                $boards = $user->boards()
                    ->saveMany(
                        Board::factory()->count($boards_num)
                        ->create(['user_id'=>$user->id])
                        ->each(function ($board) use ($user, $progress_boards) {
                            // BOARD STATUS
                            $board_status_array = array_keys(config('platform.database.boards.status.options'));
                            $board_status = array_rand($board_status_array);
                            $board->setStatus($board_status_array[$board_status], 'seeded');

                            //COVER
                            $img = CuriousStorage::randomFileFromPath('/public/seeder/covers/');
                            $url = storage_path('app/'.$img);
                            $board->addMedia($url)
                                ->usingFileName(Str::uuid())
                                ->preservingOriginal()
                                ->toMediaCollection('cover');
                            $progress_boards->advance();
                        })
                    );
                $progress_boards->clear();
                $progress->advance();
            }
            $progress_boards->clear();
            $progress_boards->finish();
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
