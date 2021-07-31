<?php



namespace OpenJournalTeam\Core;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

final class Auth
{
  public const ROLE_ADMIN = 'Admin';
  public const ROLE_SUPPORT = 'Support';
  public const ROLE_USER = 'User';

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
}
