<?php

namespace OpenJournalTeam\Core\Models;

use Spatie\Permission\Models\Role as Models;

class Role extends Models
{
    public const ADMIN = 'Admin';
    public const USER = 'User';
}
