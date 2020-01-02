<?php

use Illuminate\Database\Seeder;

class RootSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $root = config('laravolt.epicentrum.models.role')::create(['name' => 'Root']);
        $root->addPermission('*');

        $rootUser = factory(config('auth.providers.users.model'))->create([
            'email' => 'root@laravolt.app',
            'status' => \App\Enums\UserStatus::ACTIVE,
        ]);
        $rootUser->assignRole($root);
    }
}
