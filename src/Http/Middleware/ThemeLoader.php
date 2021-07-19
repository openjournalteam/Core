<?php

namespace OpenJournalTeam\Core\Http\Middleware;

use Closure;
use Hexadog\ThemesManager\Http\Middleware\ThemeLoader as HexadogThemeLoader;

class ThemeLoader extends HexadogThemeLoader
{
    public function handle($request, Closure $next, $theme = null)
    {
        // Check if request url starts with core.path prefix
        if ($request->segment(1) === config('core.path')) {
            // Set a specific theme for matching urls
            $theme = 'openjournalteam/default';
        }

        // Call parent Middleware handle method
        return parent::handle($request, $next, $theme);
    }
}
