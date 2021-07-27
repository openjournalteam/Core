<?php

namespace OpenJournalTeam\Core\Models;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
  protected $table = 'menus';
  protected $guarded = [];
  protected $connection = "sqlite";

  protected $casts = [
    'roles' => AsArrayObject::class,
  ];

  public function childs()
  {
    return $this->hasMany('OpenJournalTeam\Core\Models\Menu', 'parent_id', 'id')->orderBy('order');
  }

  public function roles()
  {
    $roles = Role::whereIn('id', $this->roles)->pluck('name')->toArray();

    $roles = !in_array(Role::ADMIN, $roles) ? array_merge($roles, [Role::ADMIN]) : $roles;

    $roles = implode('|', $roles);
    return $roles;
  }
}
