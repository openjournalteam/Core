<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
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
    foreach (Role::getRoles() as $role) {
      Role::findOrCreate($role);
    }
  }
}
