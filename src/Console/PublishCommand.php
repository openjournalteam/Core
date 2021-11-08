<?php



namespace OpenJournalTeam\Core\Console;

use Illuminate\Console\Command;

class PublishCommand extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'core:publish {--force : Overwrite any existing files}';

    /**
     * The console command description.
     */
    protected $description = 'Publish all of the Core resources';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->call('vendor:publish', [
            '--tag' => 'core-config',
            '--force' => $this->option('force'),
        ]);

        $this->call('vendor:publish', [
            '--tag' => 'core-assets',
            '--force' => true,
        ]);
    }
}
