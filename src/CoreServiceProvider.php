<?php



namespace OpenJournalTeam\Core;

include_once 'Helpers/helpers.php';

use App\Http\Kernel;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use OpenJournalTeam\Core\Providers\EventServiceProvider;
use Spatie\Crypto\Rsa\KeyPair;


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
        $this->registerKeyManager();
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
                __DIR__ . '/../database/seeders/RoleAndPermissionSeeder.php' => database_path('seeders/RoleAndPermissionSeeder.php'),
                __DIR__ . '/../database/seeders/MenuSeeder.php' => database_path('seeders/MenuSeeder.php'),
            ], 'Core-seeders');

            $this->commands([
                Console\InstallCommand::class,
                Console\PublishCommand::class,
            ]);
        }
    }

    // Spatie key
    private function registerKeyManager(): void
    {
        $keyLocation = $_SERVER['DOCUMENT_ROOT'] . '/../../../secret';

        if (!is_dir($keyLocation)) {
            mkdir($keyLocation, 0755);
        }

        // create public and private key
        $privateKey = $keyLocation . '/private.pem';
        $publicKey = $keyLocation . '/public.pub';

        if (!file_exists($privateKey) || !file_exists($publicKey)) {
            (new KeyPair())->generate($privateKey, $publicKey);
        }
    }

    private function registerMiddlewareAlias(): void
    {
        app()->make('router')->aliasMiddleware('role', \OpenJournalTeam\Core\Http\Middleware\RoleMiddleware::class);
        app()->make('router')->aliasMiddleware('permission', \Spatie\Permission\Middlewares\PermissionMiddleware::class);
    }

    private function registerBladeDirective(): void
    {
    }
}
