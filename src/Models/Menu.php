<?php

namespace OpenJournalTeam\Core\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';
    protected $guarded = [];

    public function childs()
    {
        return $this->hasMany(static::class, 'parent_id', 'id')->orderBy('order');
    }
}
