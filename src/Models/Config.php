<?php

namespace OpenJournalTeam\Core\Models;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
  protected $fillable = ['key', 'value', 'created_at', 'updated_at'];
  protected $primaryKey = 'key';
  protected $keyType = 'string';

  public $incrementing = false;
}
