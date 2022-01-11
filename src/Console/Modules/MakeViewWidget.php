<?php

namespace OpenJournalTeam\Core\Console\Modules;

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Str;
use Nwidart\Modules\Commands\GeneratorCommand;
use Nwidart\Modules\Support\Config\GenerateConfigReader;
use Nwidart\Modules\Support\Stub;
use Nwidart\Modules\Traits\ModuleCommandTrait;
use Symfony\Component\Console\Input\InputArgument;

class MakeViewWidget extends GeneratorCommand
{
  use ModuleCommandTrait;

  /**
   * The name of argument name.
   *
   * @var string
   */
  protected $argumentName = 'name';

  /**
   * The console command name.
   *
   * @var string
   */
  protected $name = 'module:make-widget-view';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Create a new widget-view for the specified module.';

  /**
   * Get the console command arguments.
   *
   * @return array
   */
  protected function getArguments()
  {
    return [
      ['name', InputArgument::REQUIRED, 'The name of the widget.'],
      ['module', InputArgument::OPTIONAL, 'The name of module will be used.'],
    ];
  }

  /**
   * @return mixed
   */
  protected function getTemplateContents()
  {
    return (new Stub('/widget-view.stub', ['QUOTE' => Inspiring::quote()]))->render();
  }

  /**
   * @return mixed
   */
  protected function getDestinationFilePath()
  {
    $path = $this->laravel['modules']->getModulePath($this->getModuleName());
    $factoryPath = GenerateConfigReader::read('widget-view');

    return $path . $factoryPath->getPath() . '/' . $this->getFileName();
  }

  /**
   * @return string
   */
  private function getFileName()
  {
    return Str::lower($this->argument('name')) . '.blade.php';
  }
}
