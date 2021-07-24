<?php

namespace OpenJournalTeam\Core\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
  protected $table = 'menus';
  protected $fillable = ['token', 'name', 'path', 'parent_id', 'order', 'type', 'icon'];

  public function childs()
  {
    return $this->hasMany('OpenJournalTeam\Core\Models\Menu', 'parent_id', 'id');
  }
}
