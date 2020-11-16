<?php

use App\Board;
use App\Helpers\CuriousPeople\CuriousNum;
use App\Helpers\CuriousPeople\CuriousNumBias;
use App\Post;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class UsersReactionsSeeder extends Seeder
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

        $vars = config('seeder.users.reactions.users');

        $users = User::all();
        $output = new ConsoleOutput();
        $progress = new ProgressBar($output, count($users));
        $progress->setFormat('%message%: %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%'."\n");
        $progress->setMessage('Generating Reactions');
        $progress->start();

        // LARAVEL-lOVE REACTIONS
        User::chunk(100, function ($users) use ($vars, $progress) {
            foreach ($users as $user) {
                $reacterFacade = $user->viaLoveReacter();
                $count = CuriousNum::getRandomBias($vars);
                $action = $vars['reactions'];

                User::inRandomOrder()->limit($count)->each(function ($model) use ($user, $reacterFacade, $action) {
                    shuffle($action);
                    $reacterFacade->reactTo($model, $action[0], 1.0);
                });

                $progress->advance();
            }
        });

        $progress->finish();

        $this->setFKCheckOn();
        Model::reguard();
        //Model::setEventDispatcher(new \Illuminate\Events\Dispatcher);
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
