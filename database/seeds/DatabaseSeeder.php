<?php

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
        app('laravolt.acl')->syncPermission();
        $this->call(RootSeeder::class);
        $this->call(UserSeeder::class);
    }
}
