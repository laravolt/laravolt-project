<?php

namespace Laravolt\Etalase;

use App\User;
use Faker\Factory;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

/**
 * Class PackageServiceProvider
 *
 * @package Laravolt\Ui
 * @see http://laravel.com/docs/master/packages#service-providers
 * @see http://laravel.com/docs/master/providers
 */
class ServiceProvider extends BaseServiceProvider
{
    public function register()
    {
        $this->app->singleton('laravolt.etalase', function(){
            return new Etalase();
        });
    }

    public function boot()
    {
        $this->loadViewsFrom(realpath(__DIR__.'/../resources/views'), 'etalase');
        $this->loadRoutes();
        $this->registerMenu();
        $this->registerBlade();
        $this->registerVariables();

        //auth()->login(User::first());
    }

    protected function loadRoutes()
    {
        /**
         * @var \Illuminate\Routing\Router $router
         */
        $router = $this->app['router'];

        $router->group(['prefix' => 'etalase', 'middleware' => ['web']], function () use ($router) {

            $router->get('search/{query?}', function($query){

                $data = \Indonesia::search($query)->paginateVillages();

                $results = [];
                foreach($data as $village) {
                    $data->load('district.city.province');
                    $results[] = [
                        'name'  => "<strong>$village->name</strong>, $village->district_name, $village->city_name, $village->province_name",
                        'description'  => "$village->name, $village->district_name, $village->city_name, $village->province_name",
                        'value'  => $village->id,
                    ];
                }

                $json = ['success' => true, 'results' => $results];
                return response()->json($json);
            });

            $router->get('{page}', function ($page) {
                try {
                    return view('etalase::example.'.$page);
                } catch (\Exception $e) {
                    return view('etalase::missing', compact('page'));
                }
            })->where('page', '.*');

        });
    }

    protected function registerMenu()
    {
        if ($this->app->bound('laravolt.menu')) {

            $menu = $this->app['laravolt.menu']->add('UI Element')->data('icon', 'puzzle');
            $menu->add('Button', url('etalase/button'));
            $menu->add('Definition', url('etalase/definition'));
            $menu->add('Table', url('etalase/table'));
            $menu->add('Form', url('etalase/form'));
            $menu->add('Flash Message', url('etalase/flash'));
            $menu->add('Breadcrumb', url('etalase/breadcrumb'));

            $menu = $this->app['laravolt.menu']->add('Layout')->data('icon', 'block layout');
            $menu->add('Sidebar', url('etalase/layout/sidebar'));
            $menu->add('Minimalist', url('etalase/layout/minimalist'));

            $menu = $this->app['laravolt.menu']->add('Utility')->data('icon', 'high battery');
            $menu->add('Text Color', url('etalase/text'));
            $menu->add('Spacing', url('etalase/spacing'));

            $menu = $this->app['laravolt.menu']->add('Sample Page')->data('icon', 'browser');
            $menu->add('Dashboard', url('etalase/dashboard'));
            $menu->add('Control Panel', url('etalase/dashboard/control-panel'));
            $menu->add('Launcher', url('etalase/launcher'));
            $menu->add('Summary Board', url('etalase/dashboard/summary'));
            $menu->add('Inbox', url('etalase/inbox'));
            $menu->add('Dropdown Shipping', url('etalase/shipping'));
        }
    }

    protected function registerBlade()
    {

        Blade::directive('etalase', function($expression) {
            return "<?php echo app('laravolt.etalase')->start($expression); ?>";
        });

        Blade::directive('endetalase', function($expression) {
            return "<?php echo app('laravolt.etalase')->stop(); ?>";
        });
    }

    protected function registerVariables()
    {
        View::composer('etalase::*', function($view){
            $faker = Factory::create();
            $view->with('faker', $faker);
        });
    }
}
