<?php

namespace Database\Seeders;

use App\Board;
use App\Helpers\CuriousPeople\CuriousNum;
use App\Post;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class UsersFollowingsTableSeeder extends Seeder
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
        Model::unguard();
        $this->setFKCheckOff();

        $users = User::all();
        $output = new ConsoleOutput();
        $progress = new ProgressBar($output, count($users));
        $progress->setFormat('%message%: %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%'."\n");
        $progress->setMessage('Generating Follows');
        $progress->start();
        // FOLLOWS & FOLLOWERS
        User::chunk(100, function ($users) use ($progress) {
            foreach ($users as $user) {
                // cap follwing to number of users
                $follows = config('seeder.users.following');

                $follows['max'] = $follows['max'] <= config('seeder.users.count') ? $follows['max'] : config('seeder.users.count');
                $follows['min'] = $follows['min'] >= $follows['max'] ? $follows['min'] : $follows['max'];

                $follow_count = CuriousNum::getRandomBias($follows);
                $following = $follow_count; // <= config('seeder.users.count') ? $follow_count : config('seeder.users.count');

                $reciprocated_count = CuriousNum::getRandomBias(config('seeder.users.reciprocated'));
                $reciprocated = $reciprocated_count <= config('seeder.users.reciprocated.bias') ? true : false;

                $following = User::inRandomOrder()->limit($following)->each(function ($fuser) use ($user, $reciprocated) {
                    if ($user->id != $fuser->id) {
                        $user->follow($fuser);
                        if ($reciprocated == true) {
                            $fuser->follow($user);
                        }
                    }
                });
                $progress->advance();
            }
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
