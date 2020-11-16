<?php

namespace Database\Seeders;

use App\Board;
use App\Helpers\CuriousPeople\CuriousNum;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class BoardsSubscribesTableSeeder extends Seeder
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
        Model::unsetEventDispatcher();
        Model::unguard();
        $this->setFKCheckOff();

        $boards_num = config('seeder.users.subscribe.boards');
        $posts_vars = config('seeder.users.subscribe.boards');

        $user_count = User::count();
        $output = new ConsoleOutput();
        $progress = new ProgressBar($output, $user_count);
        $progress->setFormat('%message%: %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%'."\n");
        $progress->setMessage('Generating Subscriptions');
        $progress->start();

        // SUBSCRIPTIONS
        User::chunk(100, function ($users) use ($boards_num, $progress) {
            foreach ($users as $user) {
                $boards_count = CuriousNum::getRandomBias($boards_num);
                $boards_count;

                $output1 = new ConsoleOutput();
                $progress1 = new ProgressBar($output1, $boards_count);
                $progress1->setFormat('%message%: %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%'."\n");
                $progress1->setMessage('Subscribing User '.$user->id.' to '.$boards_count.' Boards');
                $progress1->start();

                // BOARDS
                Board::inRandomOrder()->where('user_id', '!=', $user->id)->limit($boards_count)->each(function ($model) use ($user, $progress1) {
                    $user->toggleSubscribe($model);
                    $progress1->advance();
                });

                $progress1->clear();
                $progress1->finish();
                $progress->advance();
            }
            $progress->clear();
            $progress->finish();
        });

        $this->setFKCheckOn();
        Model::reguard();
        Model::setEventDispatcher(new \Illuminate\Events\Dispatcher);
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
