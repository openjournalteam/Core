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
            'name' => 'Super Admin',
            'email' => 'admin@opensynergic.com',
            'password' => Hash::make('coklatmanis'),
            'status'   => User::ACTIVE
        ]);

        $user->assignRole(Role::SUPER_ADMIN);
    }
}
