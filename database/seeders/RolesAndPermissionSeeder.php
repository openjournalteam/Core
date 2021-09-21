<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use OpenJournalTeam\Core\Auth;
use OpenJournalTeam\Core\Models\Permission;
use OpenJournalTeam\Core\Models\Role;

class RolesAndPermissionSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // Create roles
    foreach (Auth::getRoles() as $role) {
      Role::findOrCreate($role);
    }

    $permissions_array = Auth::getPermissions();
    $permissions = collect($permissions_array)->map(function ($permission) {
      return ['name' => $permission, 'guard_name' => 'web'];
    });

    Permission::insert($permissions->toArray());
  }
}
