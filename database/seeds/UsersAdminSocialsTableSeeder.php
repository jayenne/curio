<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\UserSocial;
use League\Csv\Reader;

class UsersAdminSocialsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = public_path().'/../database/seeds/data/usersocials-admin.csv';
        $csv = Reader::createFromPath($file);

        Model::unguard();
        $this->setFKCheckOff();

        foreach ($csv as $row) {
            if (empty($row)) {
                return false;
            }
            
            UserSocial::updateOrCreate(
                [
                    'user_id'=> $row[1],
                ],
                [
                    'user_id' => $row[1],
                    'service' => $row[2],
                    'social_id' => $row[3],
                    'token' => $row[4],
                    'name' => $row[5],
                    'nickname' => $row[6],
                    'avatar' => $row[7],
                    'status' => $row[8],
                ]
            );
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
