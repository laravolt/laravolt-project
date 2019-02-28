<?php

namespace Laravolt\Collab;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Laravolt\Collab\Console\Commands\Pull;
use Laravolt\Collab\Http\Controllers\ProjectController;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Register the service provider.
     *
     * @see    http://laravel.com/docs/master/providers#the-register-method
     * @return void
     */
    public function register()
    {
        $this->app->singleton('laravolt.collab', function(){
            return new Collab(config('laravolt.collab.connection'));
        });
    }

    /**
     * Application is booting
     *
     * @see    http://laravel.com/docs/master/providers#the-boot-method
     * @return void
     */
    public function boot()
    {
        $this->registerViews();
        $this->registerConfigurations();

        if (!$this->app->routesAreCached()) {
            $this->registerRoutes();
        }

        if ($this->app->runningInConsole()) {
            $this->commands([Pull::class]);
        }

        $this->loadMigrationsFrom($this->packagePath('database/migrations'));

    }

    /**
     * Register the package views
     *
     * @see    http://laravel.com/docs/master/packages#views
     * @return void
     */
    protected function registerViews()
    {
        // register views within the application with the set namespace
        $this->loadViewsFrom($this->packagePath('resources/views'), 'collab');

        // allow views to be published to the storage directory
        $this->publishes(
            [$this->packagePath('resources/views') => base_path('resources/views/vendor/collab')],
            'views'
        );
    }

    /**
     * Register the package configurations
     *
     * @see    http://laravel.com/docs/master/packages#configuration
     * @return void
     */
    protected function registerConfigurations()
    {
        $this->mergeConfigFrom(
            $this->packagePath('config/config.php'),
            'laravolt.collab'
        );
        $this->publishes(
            [$this->packagePath('config/config.php') => config_path('laravolt/collab.php')],
            'config'
        );
    }

    /**
     * Register the package routes
     *
     * @warn   consider allowing routes to be disabled
     * @see    http://laravel.com/docs/master/routing
     * @see    http://laravel.com/docs/master/packages#routing
     * @return void
     */
    protected function registerRoutes()
    {
        $this->app['router']->group(
            [
                'middleware' => config('laravolt.collab.router.middleware'),
                'prefix'     => config('laravolt.collab.router.prefix'),
                'as'         => 'collab::',
            ],
            function (Router $router) {
                $router->resource('projects', ProjectController::class);
            }
        );
    }

    /**
     * Loads a path relative to the package base directory
     *
     * @param  string $path
     * @return string
     */
    protected function packagePath($path = '')
    {
        return sprintf("%s/../%s", __DIR__, $path);
    }
}
