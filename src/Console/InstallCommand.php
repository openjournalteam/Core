<?php



namespace OpenJournalTeam\Core\Console;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected string $signature = 'core:install';

    /**
     * The console command description.
     */
    protected string $description = 'Install all of the Core resources';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->comment('Publishing Core Service Provider...');
        $this->callSilent('vendor:publish', ['--tag' => 'Core-provider']);

        $this->comment('Publishing Core Assets...');
        $this->callSilent('vendor:publish', ['--tag' => 'Core-assets']);

        $this->comment('Publishing Core Configuration...');
        $this->callSilent('vendor:publish', ['--tag' => 'Core-config']);

        $this->comment('Publishing Core Databases...');
        $this->callSilent('vendor:publish', ['--tag' => 'Core-databases']);

        $this->info('Core scaffolding installed successfully.');
    }
}
