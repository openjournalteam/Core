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

    protected $casts = [
        'roles' => AsArrayObject::class,
    ];

    public function childs()
    {
        return $this->hasMany('OpenJournalTeam\Core\Models\Menu', 'parent_id', 'id')->orderBy('order');
    }

    public function roles()
    {
        $cachename = 'roles_' . implode('_', $this->roles->toArray());

        $roles = Cache::remember($cachename, 60 * 60 * 24, function () {
            return Role::whereIn('id', $this->roles)->pluck('name')->toArray();
        });

        $roles = !in_array(Auth::ROLE_ADMIN, $roles) ? array_merge($roles, [Auth::ROLE_ADMIN]) : $roles;

        return implode('|', $roles);
    }
}
