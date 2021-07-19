<?php

namespace OpenJournalTeam\Core\Classes;

class MenuManager
{
    public static function list()
    {
        $menu = config('core.menus');
        return apply_filters('MenuManager::add', $menu);
    }

    // TODO add function to add submenus
    // static public function addSubmenu($parent, $name, $route, $icon = false)
    // {
    //   add_filter('MenuManager::add', function ($menu) use ($parent, $name, $route, $icon) {

    //     return $menu;
    //   });
    // }

    public static function add($name, $route, $icon = false, $role = false)
    {
        add_filter('MenuManager::add', fn ($menu) => array_merge($menu, [['title' => $name, 'route' => $route ?? false,  'icon' => $icon, 'role' => $role]]));
    }
}
