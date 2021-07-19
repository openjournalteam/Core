<?php

namespace OpenJournalTeam\Core;

include_once 'Helpers/helpers.php';

use App\Http\Kernel;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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

        View::addExtension('php', 'blade');

        $kernel->prependMiddleware(OpenJournalTeam\Core\Http\Middleware\ThemeLoader::class);

        $this->registerMiddlewareAlias();
        $this->registerBladeDirective();

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'core');
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'core');

        // Register Provider
        $this->app->register(RouteServiceProvider::class);

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
            ], 'Core-config');
            $this->publishes([
                __DIR__ . '/../public' => public_path('vendor/core'),
            ], 'Core-assets');

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
