<?php



namespace OpenJournalTeam\Core\Console;

use Illuminate\Support\Facades\Hash;
use Illuminate\Console\Command;
use OpenJournalTeam\Core\Models\Role;

class GenerateRequiredData extends Command
{
  /**
   * The name and signature of the console command.
   */
  protected $signature = 'core:generate';

  /**
   * The console command description.
   */
  protected $description = 'Generate Required Data';

  /**
   * Execute the console command.
   */
  public function handle()
  {
    foreach (Role::getRoles() as $role) {
      Role::findOrCreate($role);
    }

    $userModel = config('auth.providers.users.model');
    $user = $userModel::create([
      'name' => 'Super Admin',
      'email' => 'admin@opensynergic.com',
      'password' => Hash::make('admin')
    ]);

    $user->assignRole(Role::SUPER_ADMIN);

    $this->info('Data generated successfully');
  }
}
