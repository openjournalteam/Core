<?php

namespace OpenJournalTeam\Core\Traits;

use OpenJournalTeam\Core\Models\Config;

trait HasConfig
{
  public function config()
  {
    return $this->morphMany(Config::class, 'configable');
  }
}
