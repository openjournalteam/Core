<?php

namespace OpenJournalTeam\Core\Traits;

use Illuminate\Support\Str;

trait HasToken
{
  protected static function bootHasToken()
  {
    static::creating(function ($model) {
      if ($model->token) return;
      $model->token = (string) Str::uuid();
    });
  }
}
