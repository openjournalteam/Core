<?php

namespace OpenJournalTeam\Core\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Exceptions\UnauthorizedException;
use OpenJournalTeam\Core\Models\Permission;
use Illuminate\Support\Facades\Cache;


class CheckPermissionsByRoute
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, \Closure $next)
    {
        dd($this);
        /* Tidak diperlukan di userpanel */
        if ((bool) env('USER_PANEL')) {
            return $next($request);
        }

        $current_route = Route::getCurrentRoute()->getName();
        if (empty($current_route)) {
            return $next($request);
        };

        if (!Cache::rememberForever('permission_' . $current_route, fn () => Permission::where('name', $current_route)->first())) {
            Permission::create([
                'name' => $current_route
            ]);
            Cache::forget('permission_', $current_route);
        }

        if (!user()) {
            throw UnauthorizedException::notLoggedIn();
        }

        if (user()->can($current_route)) {
            return $next($request);
        }

        $permissions = is_array($current_route)
            ? $current_route
            : explode('|', $current_route);

        throw UnauthorizedException::forPermissions($permissions);
    }
}
