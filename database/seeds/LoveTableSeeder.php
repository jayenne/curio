<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class LoveTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Model::unguard();
        $this->setFKCheckOff();

        $reaction = config('seeder.laravel-love.options');

        DB::table('love_reaction_types')->truncate();

        foreach ($reaction as $key => $val) {
            DB::table('love_reaction_types')->insert([
                'name' => "$key",
                'mass' => $val,
            ]);
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
