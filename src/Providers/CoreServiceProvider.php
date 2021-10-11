<?php



namespace OpenJournalTeam\Core\Providers;

include_once __DIR__ . '/../Helpers/helpers.php';

use OpenJournalTeam\Core\Core;
use App\Http\Kernel;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;


class CoreServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(Kernel $kernel): void
    {
        $this->registerCommands();

        if (!config('core.enabled')) {
            return;
        }

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'core');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        View::addExtension('php', 'blade');

        $this->registerMiddlewareAlias();
        $this->registerBladeDirective();
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        if (!config('core.enabled')) {
            return;
        }

        $this->registerProviders();
        $this->registerAlias();
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'core');

        // Register the main class to use with the facade
        $this->app->singleton('core', function () {
            return new Core();
        });
    }

    public function registerAlias(): void
    {
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('CoreAuth', 'OpenJournalTeam\Core\Auth');
    }

    /**
     * Register Service Providers
     */

    protected function registerProviders(): void
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(LiveWireComponentServiceProvider::class);
        $this->app->register(EventServiceProvider::class);
        $this->app->register(\Shohel\Pluggable\PluggableServiceProvider::class);
    }

    /**
     * Register the package's commands.
     */
    protected function registerCommands(): void
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
            $this->publishes([
                __DIR__ . '/../resources/views' => resource_path('views/vendor/core'),
            ], 'Core-views');
            $this->publishes([
                __DIR__ . '/../database/seeders/RolesAndPermissionSeeder.php' => database_path('seeders/RolesAndPermissionSeeder.php'),
                __DIR__ . '/../database/seeders/MenuSeeder.php' => database_path('seeders/MenuSeeder.php'),
            ], 'Core-seeders');

            $this->commands([
                \OpenJournalTeam\Core\Console\InstallCommand::class,
                \OpenJournalTeam\Core\Console\PublishCommand::class,
            ]);
        }
    }

    private function registerMiddlewareAlias(): void
    {
        app()->make('router')->aliasMiddleware('role', \OpenJournalTeam\Core\Http\Middleware\RoleMiddleware::class);
        app()->make('router')->aliasMiddleware('permission', \Spatie\Permission\Middlewares\PermissionMiddleware::class);
        app()->make('router')->aliasMiddleware('permission_by_route', \OpenJournalTeam\Core\Http\Middleware\CheckPermissionsByRoute::class);
    }

    private function registerBladeDirective(): void
    {
    }
}
