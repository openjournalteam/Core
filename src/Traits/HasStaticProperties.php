<?php

namespace OpenJournalTeam\Core\Traits;

trait HasStaticProperties
{
  static function lastStaticProperties()
  {
    $parentConstants = static::getParentStaticProperties();

    $allConstants = static::getStaticProperties();

    return array_diff($allConstants, $parentConstants);
  }

  static function getStaticProperties()
  {
    $rc = new \ReflectionClass(get_called_class());

    return $rc->getStaticProperties();
  }

  static function getParentStaticProperties()
  {
    $rc = new \ReflectionClass(get_parent_class(static::class));
    return $rc->getStaticProperties();
  }
}
