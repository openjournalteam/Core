<?php



namespace OpenJournalTeam\Core;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

final class Auth
{
  public const ROLE_SUPER_ADMIN = 'Super Admin';
  public const ROLE_ADMIN = 'Admin';
  public const ROLE_SUPPORT = 'Support';
  public const ROLE_USER = 'User';
  public const ROLE_CUSTOMER = 'Customer';

  public const PERMISSION_VIEW_MENU_ADMINISTRATION = 'view_menu_administration';
  public const PERMISSION_VIEW_MENU_MENUS = 'view_menu_menus';
  public const PERMISSION_VIEW_MENU_USER_ROLES = 'view_menu_user_roles';
  public const PERMISSION_VIEW_MENU_PLUGINS = 'view_menu_plugins';
  public const PERMISSION_VIEW_MENU_SETTINGS = 'view_menu_settings';

  /**
   * @return array
   */
  public static function getRoles(): array
  {
    try {
      $class = new \ReflectionClass(self::class);
      $constants = $class->getConstants();
      $roles = Arr::where($constants, function ($value, $key) {
        return Str::startsWith($key, 'ROLE_');
      });

      return array_values($roles);
    } catch (\ReflectionException $exception) {
      return [];
    }
  }



  public static function getPermissions(): array
  {
    try {
      $class = new \ReflectionClass(self::class);
      $constants = $class->getConstants();
      $permissions = Arr::where($constants, function ($value, $key) {
        return Str::startsWith($key, 'PERMISSION_');
      });

      return array_values($permissions);
    } catch (\ReflectionException $exception) {
      return [];
    }
  }
}
