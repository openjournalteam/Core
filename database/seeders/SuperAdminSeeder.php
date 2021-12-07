<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use OpenJournalTeam\Core\Models\Role;
use OpenJournalTeam\Core\Models\User;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userModel = config('auth.providers.users.model');
        $user = $userModel::create([
            'username' => 'sadmin',
            'name' => 'Super Admin',
            'email' => 'admin@opensynergic.com',
            'status' => User::ACTIVE,
            'password' => Hash::make('coklatmanis')
        ]);

        $user->assignRole(Role::SUPER_ADMIN);
    }
}
