<?php

namespace OpenJournalTeam\Core\Classes;

use Illuminate\Database\Eloquent\Collection;
use OpenJournalTeam\Core\Models\Menu;

class MenuManager
{
    public static function list()
    {
        $menu = config('core.menus');
        return apply_filters('MenuManager::add', $menu);
    }

    public static function add($name, $route, $icon = false, $role = false)
    {
        add_filter('MenuManager::add', function ($menus) use ($name, $route, $icon, $role) {
            $menu = new Collection(
                [
                    'name' => $name,
                    'route' => $route,
                    'icon' => $icon,
                    'role' => $role
                ]
            );
            $menus[] = $menu;

            return $menus;
        });
    }
}
