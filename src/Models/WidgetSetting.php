<?php

namespace OpenJournalTeam\Core\Models;

use Illuminate\Database\Eloquent\Model;

class WidgetSetting extends Model
{
  protected $fillable = ['name', 'setting', 'value'];
}
