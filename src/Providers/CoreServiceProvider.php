<?php



namespace OpenJournalTeam\Core\Providers;

include_once __DIR__ . '/../Helpers/helpers.php';

use OpenJournalTeam\Core\Core;
use App\Http\Kernel;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use OpenJournalTeam\Core\Console\InstallCommand;
use OpenJournalTeam\Core\Console\PublishCommand;
use OpenJournalTeam\Core\Console\PublishModuleAssets;
use OpenJournalTeam\Core\Http\Middleware\CheckPermissionsByRoute;
use OpenJournalTeam\Core\Http\Middleware\RoleMiddleware;
use OpenJournalTeam\Core\Http\Middleware\LogHandler;
use Shohel\Pluggable\PluggableServiceProvider;
use Spatie\Permission\Middlewares\PermissionMiddleware;
use OpenJournalTeam\Core\Http\Livewire\MenuComponent;
use OpenJournalTeam\Core\Http\Livewire\MenuSideBarComponent;
use OpenJournalTeam\Core\Http\Livewire\NotificationsDropdownComponent;
use OpenJournalTeam\Core\Http\Livewire\UserDropdownComponent;

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

        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'core');
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        $this->registerMiddlewareAlias();
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
        $this->registerLivewireComponent();
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../../config/config.php', 'core');

        // Register the main class to use with the facade
        $this->app->singleton('core', function () {
            return new Core();
        });
    }

    /**
     * Register Service Providers
     */

    protected function registerProviders(): void
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(PluggableServiceProvider::class);
        $this->app->register(ModuleServiceProvider::class);
    }

    /**
     * Register the package's commands.
     */
    protected function registerCommands(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../../config/config.php' => config_path('core.php'),
            ], 'Core-config');
            $this->publishes([
                __DIR__ . '/../../public' => public_path('vendor/core'),
            ], 'Core-assets');
            $this->publishes([
                __DIR__ . '/../../resources/views' => resource_path('views/vendor/core'),
            ], 'Core-views');
            $this->publishes([
                __DIR__ . '/../../database/seeders' => database_path('seeders'),
            ], 'Core-seeders');

            $this->commands([
                InstallCommand::class,
                PublishCommand::class,
                PublishModuleAssets::class,
            ]);
        }
    }

    private function registerMiddlewareAlias(): void
    {
        app()->make('router')->aliasMiddleware('role', RoleMiddleware::class);
        app()->make('router')->aliasMiddleware('permission', PermissionMiddleware::class);
        app()->make('router')->aliasMiddleware('permission_by_route', CheckPermissionsByRoute::class);
        app()->make('router')->aliasMiddleware('log_handler', LogHandler::class);
    }

    private function registerLivewireComponent(): void
    {
        Livewire::component('core:menu', MenuComponent::class);
        Livewire::component('core:menu:sidebar', MenuSideBarComponent::class);
        Livewire::component('core:notifications-dropdown', NotificationsDropdownComponent::class);
        Livewire::component('core:user-dropdown', UserDropdownComponent::class);
    }
}
