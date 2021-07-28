<?php



namespace openjournalteam\Core\Console;

use Illuminate\Console\Command;

class PublishCommand extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected string $signature = 'core:publish {--force : Overwrite any existing files}';

    /**
     * The console command description.
     */
    protected string $description = 'Publish all of the Core resources';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->call('vendor:publish', [
            '--tag' => 'Core-config',
            '--force' => $this->option('force'),
        ]);

        $this->call('vendor:publish', [
            '--tag' => 'Core-assets',
            '--force' => true,
        ]);
    }
}
