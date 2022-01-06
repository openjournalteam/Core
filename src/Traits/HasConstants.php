<?php

namespace OpenJournalTeam\Core\Traits;

trait HasConstants
{
  static function lastConstants()
  {
    $parentConstants = static::getParentConstants();

    $allConstants = static::getConstants();

    return array_diff($allConstants, $parentConstants);
  }

  static function getConstants()
  {
    $rc = new \ReflectionClass(get_called_class());

    return array_filter($rc->getConstants(), function ($consts) {
      $ignore = ['created_at', 'updated_at'];
      return !in_array($consts, $ignore);
    });
  }

  static function getParentConstants()
  {
    $rc = new \ReflectionClass(get_parent_class(static::class));
    $consts = $rc->getConstants();

    return $consts;
  }
}
