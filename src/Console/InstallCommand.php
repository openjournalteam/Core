<?php



namespace OpenJournalTeam\Core\Console;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'core:install';

    /**
     * The console command description.
     */
    protected $description = 'Install all of the Core resources';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->comment('Publishing required vendor');
        $this->callSilent('vendor:publish', ['--provider' => "Spatie\Permission\PermissionServiceProvider"]);

        $this->comment('Publishing Core Service Provider...');
        $this->callSilent('vendor:publish', ['--tag' => 'Core-provider']);

        $this->comment('Publishing Core Assets...');
        $this->callSilent('vendor:publish', ['--tag' => 'Core-assets']);

        $this->comment('Publishing Core Configuration...');
        $this->callSilent('vendor:publish', ['--tag' => 'Core-config']);

        $this->comment('Publishing Core Databases...');
        $this->callSilent('vendor:publish', ['--tag' => 'Core-databases']);

        $this->comment('Publishing Core Seeders...');
        $this->callSilent('vendor:publish', ['--tag' => 'Core-seeders']);

        // $this->comment('Seeding Database...');
        // $this->callSilent('db:seed', ['--class' => 'RolesAndPermissionSeeder']);
        // $this->callSilent('db:seed', ['--class' => 'MenuSeeder']);

        $this->info('Core scaffolding installed successfully.');
    }
}
