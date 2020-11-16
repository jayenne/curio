<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::disableQueryLog();
        //$this->call( LanguagesTableSeeder::class);
        $this->call(LoveTableSeeder::class);
        $this->call(UsersAdminTableSeeder::class);
        $this->call(UsersAdminSocialsTableSeeder::class);

        // USERS
        // $this->call(UsersTableSeeder::class);
        // $this->call(UsersFollowingsTableSeeder::class);
        // $this->call(UsersReactionsSeeder::class);

        // //BOARDS
        // $this->call(BoardsTableSeeder::class);
        // $this->call(BoardsSubscribesTableSeeder::class);

        // //POSTS
        // $this->call(PostsTableSeeder::class);
        // $this->call(PostsMediaLocalSeeder::class);
        // $this->call(PostsMediaRemoteSeeder::class);
        // $this->call(PostsReactionsSeeder::class);

        // // TAGS
        // $this->call(PostsTagsSeeder::class);
        // $this->call(BoardsTagsSeeder::class);
    }
}
