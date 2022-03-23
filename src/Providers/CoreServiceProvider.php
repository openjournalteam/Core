<?php

namespace OpenJournalTeam\Core\Providers;


use App\Http\Kernel;
use Illuminate\Contracts\Auth\Access\Authorizable;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use OpenJournalTeam\Core\Console\GenerateRequiredData;
use OpenJournalTeam\Core\Console\InstallCommand;
use OpenJournalTeam\Core\Console\Modules\MakeViewWidget;
use OpenJournalTeam\Core\Console\Modules\MakeWidget;
use OpenJournalTeam\Core\Console\PublishCommand;
use OpenJournalTeam\Core\Console\PublishModuleAssets;
use OpenJournalTeam\Core\CoreManager;
use OpenJournalTeam\Core\Http\Livewire\Admin\MailTemplatePage;
use OpenJournalTeam\Core\Http\Livewire\Pages\DashboardPage;
use OpenJournalTeam\Core\Http\Middleware\RoleMiddleware;
use OpenJournalTeam\Core\Http\Middleware\LogHandler;
use Shohel\Pluggable\PluggableServiceProvider;
use Spatie\Permission\Middlewares\PermissionMiddleware;
use OpenJournalTeam\Core\Http\Livewire\Pages\MenuPages;
use OpenJournalTeam\Core\Http\Livewire\Components\MenuSideBarComponent;
use OpenJournalTeam\Core\Http\Livewire\Components\NotificationsDropdownComponent;
use OpenJournalTeam\Core\Http\Livewire\Components\UserDropdownComponent;
use OpenJournalTeam\Core\Models\Permission;
use Illuminate\Contracts\Auth\Access\Gate;
use OpenJournalTeam\Core\Facades\Core;
use OpenJournalTeam\Core\Http\Livewire\Components\Profile\ApiTokenComponent;

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

        $this->bootGate();
        $this->bootMiddlewareAlias();
    }

    private function bootMiddlewareAlias(): void
    {
        app()->make('router')->aliasMiddleware('role', RoleMiddleware::class);
        app()->make('router')->aliasMiddleware('permission', PermissionMiddleware::class);
        app()->make('router')->aliasMiddleware('log_handler', LogHandler::class);
    }

    protected function bootGate(): void
    {
        app(Gate::class)->before(function (Authorizable $user, string $ability) {
            $permission = Permission::getPermission(['name' => $ability]);
            if (!$permission) {
                DB::transaction(function () use ($ability) {
                    Permission::create([
                        'name' => $ability,
                    ]);
                });
            }
        });
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/config.php', 'core');

        if (!config('core.enabled')) {
            return;
        }

        $this->app->singleton('core', function (): CoreManager {
            return new CoreManager();
        });

        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'core');



        $this->registerProviders();
        $this->registerComponents();
        $this->registerLivewirePages();
        $this->registerNavigationItems();
        $this->registerLivewireComponent();
    }

    protected function registerNavigationItems()
    {
        Core::registerNavigationItems(config('core.navigation', []));
    }



    /**
     * Register Service Providers
     */

    protected function registerProviders(): void
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(PluggableServiceProvider::class);
        $this->app->register(RegisterModuleServiceProvider::class);
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
                GenerateRequiredData::class,
                MakeWidget::class,
                MakeViewWidget::class,
            ]);
        }
    }

    private function registerLivewireComponent(): void
    {
        Livewire::component('core:menu:sidebar', MenuSideBarComponent::class);
        Livewire::component('core:notifications-dropdown', NotificationsDropdownComponent::class);
        Livewire::component('core:user-dropdown', UserDropdownComponent::class);
        Livewire::component('core:mailtemplatepage', MailTemplatePage::class);
        Livewire::component('core:profile.api-token', ApiTokenComponent::class);
    }

    private function registerLivewirePages()
    {
        Livewire::component(MenuPages::getName(), MenuPages::class);
        Livewire::component(DashboardPage::getName(), DashboardPage::class);
    }

    private function registerComponents(): void
    {
        Blade::componentNamespace('OpenJournalTeam\\Core\\View\\Components', 'core');
    }
}
