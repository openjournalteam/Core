<?php

namespace OpenJournalTeam\Core\Models;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
  protected $fillable = ['key', 'value'];
  protected $primaryKey = 'key';
  protected $keyType = 'string';

  public $incrementing = false;
  public $timestamps = false;
}
