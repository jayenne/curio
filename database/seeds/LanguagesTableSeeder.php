<?php

use Illuminate\Database\Seeder;
use League\Csv\Reader;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = public_path().'/../database/seeds/data/iso-languages.csv';
        $csv = Reader::createFromPath($file);

        foreach ($csv as $row) {
            if (empty($row)) {
                return false;
            }

            \DB::table('languages')->insert(
                [
                    'family' => $row[0],
                    'name' => $row[1],
                    'native_name' => $row[2],
                    'code_2' => $row[3],
                    'code_3' => $row[4],
                ]
            );
        }
    }
}
