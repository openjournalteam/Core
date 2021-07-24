<?php

namespace OpenJournalTeam\Core;

include_once 'Helpers/helpers.php';

use App\Http\Kernel;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class CoreServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(Kernel $kernel)
    {
        $this->registerCommands();

        if (!config('core.enabled')) {
            return;
        }

        // dd(__DIR__ . '/../database/migrations');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'core');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        View::addExtension('php', 'blade');

        // $kernel->prependMiddleware(OpenJournalTeam\Core\Http\Middleware\ThemeLoader::class);

        $this->registerMiddlewareAlias();
        $this->registerBladeDirective();
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        if (!config('core.enabled')) {
            return;
        }

        // dd('test');

        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'core');

        // Register Provider
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(LiveWireComponentServiceProvider::class);
        $this->app->register(\Shohel\Pluggable\PluggableServiceProvider::class);

        // Register the main class to use with the facade
        $this->app->singleton('core', function () {
            return new Core();
        });
    }

    /**
     * Register the package's commands.
     *
     * @return void
     */
    protected function registerCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('core.php'),
                __DIR__ . '/../config/modules.php' => config_path('modules.php'),
            ], 'Core-config');
            $this->publishes([
                __DIR__ . '/../public' => public_path('vendor/core'),
            ], 'Core-assets');
            $this->publishes([
                __DIR__ . '/../database/database.sqlite' => database_path('database.sqlite'),
            ], 'Core-databases');

            $this->commands([
                Console\InstallCommand::class,
                Console\PublishCommand::class,
            ]);
        }
    }

    private function registerMiddlewareAlias()
    {
        app()->make('router')->aliasMiddleware('role', \Spatie\Permission\Middlewares\RoleMiddleware::class);
        app()->make('router')->aliasMiddleware('permission', \Spatie\Permission\Middlewares\PermissionMiddleware::class);
    }

    private function registerBladeDirective()
    {
    }
}
