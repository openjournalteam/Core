<?php



namespace OpenJournalTeam\Core\Models;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use OpenJournalTeam\Core\Auth;

class Menu extends Model
{
    protected $table = 'menus';
    protected $guarded = [];
    protected $connection = 'sqlite';

    public function childs()
    {
        return $this->hasMany('OpenJournalTeam\Core\Models\Menu', 'parent_id', 'id')->orderBy('order');
    }
}
