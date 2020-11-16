<?php

use App\User;
use App\UserProfile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use League\Csv\Reader;

class UsersAdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->setFKCheckOff();

        $file = public_path().'/../database/seeds/data/users-admin.csv';
        $csv = Reader::createFromPath($file);
        $timestamp = date('Y-m-d H:i:s');

        foreach ($csv as $row) {
            if (empty($row)) {
                return false;
            }
            $user = User::factory()->create([
                'username' => $row[0],
                'name' => $row[1].' '.$row[2],
                'first_name' => $row[1],
                'last_name' => $row[2],
                'email' => $row[3],
                'password' => $row[4],
            ]);
            $user->setStatus('private', 'seeded');
            $profile = $user->profile()->save(UserProfile::factory()->make(['user_id'=>$user->id, 'nickname'=>$user->username]));
        }

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
