<?php



namespace OpenJournalTeam\Core\Models;

use Spatie\Permission\Models\Role as Models;

class Role extends Models
{
    public const SUPER_ADMIN = 'Super Admin';
    public const ADMIN = 'Admin';
    public const SUPPORT = 'Support';
    public const USER = 'User';

    public const PERMISSION_VIEW_MENU_ADMINISTRATION = 'view_menu_administration';
    public const PERMISSION_VIEW_MENU_MENUS = 'view_menu_menus';
    public const PERMISSION_VIEW_MENU_USER_ROLES = 'view_menu_user_roles';
    public const PERMISSION_VIEW_MENU_PLUGINS = 'view_menu_plugins';
    public const PERMISSION_VIEW_MENU_SETTINGS = 'view_menu_settings';
}
