<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
//use database\seeds\UsersAndNotesSeeder;
//use database\seeds\MenusTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersSeeder::class,
            MenusTableSeeder::class,
            EmailSeeder::class,
        ]);
    }
}
