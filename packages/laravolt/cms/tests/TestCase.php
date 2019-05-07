<?php

namespace Laravolt\Cms\Tests;

use Kalnoy\Nestedset\NestedSetServiceProvider;
use Laravolt\Cms\Tests\Dummy\User;
use Laravolt\Suitable\ServiceProvider;
use Spatie\SchemalessAttributes\SchemalessAttributesServiceProvider;
use Spatie\Tags\TagsServiceProvider;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->setUpDatabase();
        $this->be($this->createUser());
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    protected function getPackageProviders($app)
    {
        return [
            \Laravolt\Cms\ServiceProvider::class,
            \Orchestra\Database\ConsoleServiceProvider::class,
            TagsServiceProvider::class,
            SchemalessAttributesServiceProvider::class,
            NestedSetServiceProvider::class,
            ServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'mysql');
        $app['config']->set('auth.providers.users.model', User::class);
        $app['config']->set('session.expire_on_close', false);
    }

    protected function setUpDatabase()
    {
        $this->loadLaravelMigrations();
        $this->loadMigrationsFrom(realpath(__DIR__.'/../database/migrations'));
        $this->loadMigrationsFrom(realpath(__DIR__.'/database/migrations'));
    }

    protected function createUser()
    {
        return User::create(['name' => 'Andi', 'email' => 'andi@laravolt.com', 'password' => bcrypt('password')]);
    }
}
