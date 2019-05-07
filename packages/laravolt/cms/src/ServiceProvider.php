<?php

namespace Laravolt\Cms;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Laravolt\Cms\Services\PostService;

/**
 * Class PackageServiceProvider
 *
 * @package Laravolt\Cms
 */
class ServiceProvider extends BaseServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'laravolt.cms',
            function () {
                return new PostService();
            }
        );

        $this->app->bind(
            'laravolt.cms.models.post',
            function () {
                return $this->app->make(config('laravolt.cms.models.post'));
            }
        );
    }

    /**
     * Application is booting
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->mergeConfigFrom(__DIR__.'/../config/cms.php', 'laravolt.cms');
        $this->publishes(
            [__DIR__.'/../config/cms.php' => config_path('laravolt/cms.php')],
            'config'
        );
        $this->loadRoutes();
    }

    protected function loadRoutes()
    {
        $router = $this->app['router'];

        include __DIR__.'/../routes/web.php';
    }
}
