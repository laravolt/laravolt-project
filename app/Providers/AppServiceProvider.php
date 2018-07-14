<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $section = $this->app['laravolt.menu']->add('Sample Menu A');
        $menu = $section->add('Menu', '#')->data('icon', 'circle outline');
        foreach(range(1, 10) as $i) {
            $menu->add('Submenu '.$i, '#');
        }

        $section = $this->app['laravolt.menu']->add('Sample Menu B');
        foreach(range(1, 8) as $h) {
            $menu = $section->add('Menu '.$h, '#')->data('icon', 'circle outline');
            foreach(range(1, 4) as $i) {
                $menu->add('Submenu '.$i, '#');
            }
        }
    }
}
