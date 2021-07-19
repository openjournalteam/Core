<?php

namespace OpenJournalTeam\Core;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use OpenJournalTeam\Core\Http\Middleware\Authenticate;
use OpenJournalTeam\Core\Models\Role;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Called before routes are registered.
     *
     * Register any model bindings or pattern based filters.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapGuestRoutes();
        $this->mapUserRoutes();
        $this->mapAdminRoutes();
    }

    protected function mapGuestRoutes()
    {
        Route::group([
            'namespace' => 'OpenJournalTeam\Core\Http\Controllers',
            'prefix' => config('core.path'),
            'as' => 'core.',
            'middleware' => config('core.middleware', ['web']),
        ], function () {
            $this->loadRoutesFrom(__DIR__ . '/../routes/guest.php');
        });
    }

    protected function mapUserRoutes()
    {
        $middleware = array_merge(config('core.middleware'), [Authenticate::class]);

        Route::group([
            'namespace' => 'OpenJournalTeam\Core\Http\Controllers',
            'prefix' => config('core.path'),
            'as' => 'core.',
            'middleware' => $middleware,
        ], function () {
            $this->loadRoutesFrom(__DIR__ . '/../routes/user.php');
        });
    }

    protected function mapAdminRoutes()
    {
        $middleware = array_merge(config('core.middleware'), [Authenticate::class, 'role:' . Role::ADMIN]);

        Route::group([
            'namespace' => 'OpenJournalTeam\Core\Http\Controllers\Admin',
            'prefix' => config('core.path') . '/admin',
            'as' => 'core.admin.',
            'middleware' => $middleware,
        ], function () {
            $this->loadRoutesFrom(__DIR__ . '/../routes/admin.php');
        });
    }
}
