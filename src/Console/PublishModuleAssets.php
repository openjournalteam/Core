<?php

namespace OpenJournalTeam\Core\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PublishModuleAssets extends Command
{
  /**
   * The name and signature of the console command.
   */
  protected $signature = 'core:module:publish {module}';

  /**
   * The console command description.
   */
  protected $description = 'Publish assets from module';

  /**
   * Create a new command instance.
   *
   * @return void
   */
  public function __construct()
  {
    parent::__construct();
  }
  /**
   * Execute the console command.
   */
  public function handle()
  {
    $module = $this->argument('module');

    $sourceDir = app_path('Modules/' . $module . '/Public');
    if (!file_exists($sourceDir)) {
      $this->error('Module not found: ' . $sourceDir);
      return;
    };

    if (!file_exists(public_path('modules/'))) {
      File::makeDirectory(public_path('modules/'));
    };

    $targetDir = public_path('modules/' . Str::lower($module));
    if (!file_exists($targetDir)) {
      File::makeDirectory($targetDir);
    };

    File::copyDirectory($sourceDir, $targetDir);

    $this->info('Publishing assets for module: ' . $module . ' completed');
  }
}
