<?php
use Illuminate\Support\Arr;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

use App\Helpers\CuriousPeople\CuriousNum;
use App\Helpers\CuriousPeople\CuriousStorage;

use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

use App\User;
use App\UserProfile;
use App\UserSocial;

use Spatie\Tags\Tag;

class UsersTableSeeder extends Seeder
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
        //User::truncate();
        
        $users_num = config('seeder.users.count');
        
        $output = new ConsoleOutput();
        $progress = new ProgressBar($output, $users_num);
        $progress->setFormat('%message%: %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%'."\n");
        $progress->setMessage('Creating Users');
        $progress->start();
       
        $users = factory(User::class, $users_num)->create()->each(
            function ($user) use ($progress) {
                // STATUS
                $user->setStatus('public', 'seeded');

                //USER PROFILE
                $profile = $user->profile()->save(
                    factory(UserProfile::class)->make([
                    'user_id'=>$user->id,
                    'nickname'=> Str::limit($user->username, 15),
                    ])
                );

                // USER IMAGES
                $img = CuriousStorage::randomFileFromPath('/public/seeder/covers/');
                $url = storage_path('app/'.$img);
                $profile->addMedia($url)
                    ->usingFileName(Str::uuid())
                    ->preservingOriginal()
                    ->toMediaCollection('cover');

                $img = CuriousStorage::randomFileFromPath('/public/seeder/avatars/'.$profile->sex);
                $url = storage_path('app/'.$img);
                $profile->addMedia($url)
                    ->usingFileName(Str::uuid())
                    ->preservingOriginal()
                    ->toMediaCollection('avatar');
                
                // USER SOCIAL
                $social = $user->socials()->save(
                    factory(UserSocial::class)
                    ->make([
                        'user_id'=>$user->id,
                        'name'=>$user->first_name.' '.$user->last_name,
                        'nickname'=> Str::limit($user->username, 15),
                    ])
                );
                
                $progress->advance();
            }
        );
        
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
