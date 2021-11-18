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
        $this->callSilent('vendor:publish', ['--provider' => "Octopy\LaraPersonate\ImpersonateServiceProvider"]);

        $this->comment('Publishing Dinas Service Provider...');
        $this->callSilent('vendor:publish', ['--provider' => 'OpenJournalTeam\Core\Providers\CoreServiceProvider']);

        $this->info('Core scaffolding installed successfully.');
    }
}
