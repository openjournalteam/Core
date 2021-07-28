<?php



namespace OpenJournalTeam\Core;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

final class Auth
{
  public const ROLE_ADMIN = 'Admin';
  public const ROLE_SUPPORT = 'Support';
  public const ROLE_USER = 'User';

  public static function permissions(): array
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

  public static function menuPermissions(): array
  {
    try {
      $class = new \ReflectionClass(self::class);
      $constants = $class->getConstants();
      $permissions = Arr::where($constants, function ($value, $key) {
        return Str::startsWith($key, 'PERMISSION_VIEW_MENU_');
      });

      return array_values($permissions);
    } catch (\ReflectionException $exception) {
      return [];
    }
  }

  /**
   * @return array
   */
  public static function roles(): array
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
}
