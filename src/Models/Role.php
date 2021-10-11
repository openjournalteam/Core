<?php



namespace OpenJournalTeam\Core\Models;

use Spatie\Permission\Models\Role as Models;

class Role extends Models
{
    public const SUPER_ADMIN = 'Super Admin';
    public const ADMIN = 'Admin';
    public const SUPPORT = 'Support';
    public const USER = 'User';

    public static function getRoles(): array
    {
        try {
            return array_values(static::lastConstants());
        } catch (\ReflectionException $exception) {
            return [];
        }
    }

    static function lastConstants()
    {
        $parentConstants = static::getParentConstants();

        $allConstants = static::getConstants();

        return array_diff($allConstants, $parentConstants);
    }

    static function getConstants()
    {
        $rc = new \ReflectionClass(get_called_class());

        return $rc->getConstants();
    }

    static function getParentConstants()
    {
        $rc = new \ReflectionClass(get_parent_class(static::class));
        $consts = $rc->getConstants();

        return $consts;
    }
}
