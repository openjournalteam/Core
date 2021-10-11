<?php

namespace OpenJournalTeam\Core\Providers;

use OpenJournalTeam\Core\Http\Middleware\Authenticate;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Livewire\Livewire;

class ModuleServiceProvider extends ServiceProvider
{
    public $cacheTime;

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->cacheTime = config('core.cache_enable', false) ? config('core.cache_time', 0) : 0;

        $this->registerLivewire();
        $this->registerRoutes();
        $this->registerViews();
    }

    /**
     * Registering route modules
     */
    private function registerRoutes()
    {
        $this->routes(function () {
            // Route for Logged In User
            Route::group([
                'prefix' => config('core.path'),
                'middleware' => array_merge(config('core.middleware'), [Authenticate::class, 'permission_by_route']),
            ], function (): void {
                $paths = Cache::remember('routes_user_module_path', $this->cacheTime, function () {
                    return glob(app_path('Modules/*/Routes*/user.php'));
                });

                foreach ($paths as $router) {
                    $this->loadRoutesFrom($router);
                }
            });

            // Route for guest user
            Route::group([
                'prefix' => config('core.path'),
                'middleware' => config('core.middleware', ['web']),
            ], function (): void {
                $paths = Cache::remember('routes_guest_module_path', $this->cacheTime, fn () => glob(app_path('Modules/*/Routes/guest.php')));

                foreach ($paths as $router) {
                    $this->loadRoutesFrom($router);
                }
            });
        });
    }

    /**
     * Registering views
     * @return void
     */
    public function registerViews()
    {
        $paths = Cache::remember('views_module_path', $this->cacheTime, fn () => glob(app_path('Modules/*')));

        foreach ($paths as $path) {
            $this->loadViewsFrom($path . '/Views', Str::lower(basename($path)));
        };
    }

    public function registerLivewire()
    {
        $paths = Cache::remember('livewire_module_path', $this->cacheTime, function () {
            $a = glob(app_path('Modules/*/Livewire/*/*.php'));
            $b = glob(app_path('Modules/*/Livewire/*.php'));
            return array_merge($a, $b);
        });

        foreach ($paths as $path) {
            $alias = Str::lower(Str::between($path, 'Modules/', '/Livewire')) . ':' . Str::kebab(basename($path, '.php'));
            $viewClass = Str::replace('/', '\\', 'App/' . Str::between($path, 'app/', '.php'));
            Livewire::component($alias, $viewClass);
        };
    }
}
