<?php

namespace OpenJournalTeam\Core\Console;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'core:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install all of the Core resources';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->comment('Publishing Core Service Provider...');
        $this->callSilent('vendor:publish', ['--tag' => 'Core-provider']);

        $this->comment('Publishing Core Assets...');
        $this->callSilent('vendor:publish', ['--tag' => 'Core-assets']);

        $this->comment('Publishing Core Configuration...');
        $this->callSilent('vendor:publish', ['--tag' => 'Core-config']);

        $this->info('Core scaffolding installed successfully.');
    }
}
