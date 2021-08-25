<?php



namespace OpenJournalTeam\Core;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use OpenJournalTeam\Core\Http\Middleware\Authenticate;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Called before routes are registered.
     *
     * Register any model bindings or pattern based filters.
     */
    public function boot(): void
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     */
    public function map(): void
    {
        $this->mapGuestRoutes();
        $this->mapUserRoutes();
        $this->mapAdminRoutes();
        $this->mapApiRoutes();
    }

    protected function mapApiRoutes()
    {
        $middleware = array_merge(config('core.middleware', []), [Authenticate::class]);

        Route::group([
            'namespace'     => 'OpenJournalTeam\Core\Http\Controllers\Api',
            'prefix'        => config('core.path') . '/api/v1',
            'as'            => 'api.',
            'middleware'    => $middleware,
        ], function () {
            $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
        });
    }

    protected function mapGuestRoutes(): void
    {
        Route::group([
            'namespace' => 'OpenJournalTeam\Core\Http\Controllers',
            'prefix' => config('core.path'),
            'as' => 'core.',
            'middleware' => config('core.middleware', ['web']),
        ], function (): void {
            $this->loadRoutesFrom(__DIR__ . '/../routes/guest.php');
        });
    }

    protected function mapUserRoutes(): void
    {
        $middleware = array_merge(config('core.middleware'), [Authenticate::class]);

        Route::group([
            'namespace' => 'OpenJournalTeam\Core\Http\Controllers',
            'prefix' => config('core.path'),
            'as' => 'core.',
            'middleware' => $middleware,
        ], function (): void {
            $this->loadRoutesFrom(__DIR__ . '/../routes/user.php');
        });
    }

    protected function mapAdminRoutes(): void
    {
        $middleware = array_merge(config('core.middleware'), [Authenticate::class, 'role:' . Auth::ROLE_SUPER_ADMIN]);

        Route::group([
            'namespace' => 'OpenJournalTeam\Core\Http\Controllers\Admin',
            'prefix' => config('core.path') . '/admin',
            'as' => 'core.admin.',
            'middleware' => $middleware,
        ], function (): void {
            $this->loadRoutesFrom(__DIR__ . '/../routes/admin.php');
        });
    }
}
