<?php
use Illuminate\Support\Arr;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

use App\Helpers\CuriousPeople\CuriousNum;
use App\Helpers\CuriousPeople\CuriousNumBias;

use App\User;
use App\Board;
use App\Post;

class PostsReactionsSeeder extends Seeder
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

        $vars = config('seeder.users.reactions.posts');

        $users = User::all();
        $output = new ConsoleOutput();
        $progress = new ProgressBar($output, count($users));
        $progress->setFormat('%message%: %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%'."\n");
        $progress->setMessage('Generating Reactions');
        $progress->start();

        // LARAVE-LOVE REACTIONS
        User::chunk(10, function ($users) use ($vars, $progress) {
            foreach ($users as $user) {
                $reacterFacade = $user->viaLoveReacter();
                $count = CuriousNum::getRandomBias($vars);
                $action = $vars['reactions'];
    
                Post::where('user_id', '!=', $user->id)->inRandomOrder()->limit($count)->each(function ($model) use ($user, $reacterFacade, $action) {
                    shuffle($action);
                    $reactantFacade = $model->viaLoveReactant();
                    //$reacted = $reactantFacade->isReactedBy($user, $action[0]);
                    //if (!$reacted) {
                    $reacterFacade->reactTo($model, $action[0], 1.0);
                    //}
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
