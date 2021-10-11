<?php



namespace OpenJournalTeam\Core\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use OpenJournalTeam\Core\Models\Role;
use Spatie\Permission\Exceptions\UnauthorizedException;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role, $guard = null)
    {
        $authGuard = Auth::guard($guard);
        if ($authGuard->user()->hasRole(Role::SUPER_ADMIN)) {
            return $next($request);
        }

        if ($authGuard->guest()) {
            throw UnauthorizedException::notLoggedIn();
        }

        $roles = is_array($role)
            ? $role
            : explode('|', $role);

        if (!$authGuard->user()->hasAnyRole($roles)) {
            throw UnauthorizedException::forRoles($roles);
        }

        return $next($request);
    }
}
