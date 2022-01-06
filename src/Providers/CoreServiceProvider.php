<?php

namespace OpenJournalTeam\Core\Providers;

// include_once __DIR__ . '/../Helpers/helpers.php';

use App\Http\Kernel;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use OpenJournalTeam\Core\Console\GenerateRequiredData;
use OpenJournalTeam\Core\Console\InstallCommand;
use OpenJournalTeam\Core\Console\PublishCommand;
use OpenJournalTeam\Core\Console\PublishModuleAssets;
use OpenJournalTeam\Core\CoreManager;
use OpenJournalTeam\Core\Http\Livewire\Admin\MailTemplatePage;
use OpenJournalTeam\Core\Http\Livewire\DashboardPage;
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
        $this->registerComponents();
        $this->registerLivewireComponent();
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../../config/config.php', 'core');

        // Register the main class to use with the facade
        $this->app->singleton('core', function (): CoreManager {
            return new CoreManager();
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
            ], 'core-config');
            $this->publishes([
                __DIR__ . '/../../public' => public_path('vendor/core'),
            ], 'core-assets');
            $this->publishes([
                __DIR__ . '/../../resources/views' => resource_path('views/vendor/core'),
            ], 'core-views');

            $this->commands([
                InstallCommand::class,
                PublishCommand::class,
                PublishModuleAssets::class,
                GenerateRequiredData::class
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
        Livewire::component('core:mailtemplatepage', MailTemplatePage::class);
        Livewire::component(DashboardPage::getName(), DashboardPage::class);
    }

    private function registerComponents(): void
    {
        Blade::componentNamespace('OpenJournalTeam\\Core\\View\\Components', 'core');
    }
}
