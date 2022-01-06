<?php

namespace OpenJournalTeam\Core\Console\Modules;

use Illuminate\Support\Str;
use Nwidart\Modules\Commands\GeneratorCommand;
use Nwidart\Modules\Support\Config\GenerateConfigReader;
use Nwidart\Modules\Support\Stub;
use Nwidart\Modules\Traits\ModuleCommandTrait;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class MakeWidget extends GeneratorCommand
{
    use ModuleCommandTrait;

    /**
     * The name of argument being used.
     *
     * @var string
     */
    protected $argumentName = 'widget';

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:make-widget';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate new widget for the specified module.';


    public function handle(): int
    {
        if (parent::handle() === E_ERROR) {
            return E_ERROR;
        }
        $this->writeWidgetViewTemplate();

        return 0;
    }

    /**
     * Get controller name.
     *
     * @return string
     */
    public function getDestinationFilePath()
    {
        $path = $this->laravel['modules']->getModulePath($this->getModuleName());

        $controllerPath = GenerateConfigReader::read('widget');

        return $path . $controllerPath->getPath() . '/' . $this->getWidgetName() . '.php';
    }

    /**
     * Write the view template for the widget.
     *
     * @return void
     */
    protected function writeWidgetViewTemplate()
    {
        $this->call('module:make-widget-view', ['name' => $this->argument('widget'), 'module' => $this->argument('module')]);
    }

    /**
     * @return string
     */
    protected function getTemplateContents()
    {
        $module = $this->laravel['modules']->findOrFail($this->getModuleName());

        return (new Stub($this->getStubName(), [
            'NAME'              => $this->getWidgetName(false),
            'LOWER_NAME'        => $this->getLowerWidgetName(false),
            'WIDGETNAME'        => $this->getWidgetName(),
            'LOWER_WIDGET_NAME' => $this->getLowerWidgetName(),
            'MODULENAME'        => $module->getStudlyName(),
            'NAMESPACE'         => $module->getStudlyName(),
            'LOWER_MODULE_NAME' => $module->getLowerName(),
            'STUDLY_NAME'       => $module->getStudlyName(),
            'CLASS_NAMESPACE'   => $this->getClassNamespace($module),
            'CLASS'             => $this->getWidgetNameWithoutNamespace(),
            'MODULE'            => $this->getModuleName(),
            'MODULE_NAMESPACE'  => $this->laravel['modules']->config('namespace'),
        ]))->render();
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['widget', InputArgument::REQUIRED, 'The name of the widget class.'],
            ['module', InputArgument::OPTIONAL, 'The name of module will be used.'],
        ];
    }

    /**
     * @return array
     */
    protected function getOptions()
    {
        return [];
    }

    /**
     * @return array|string
     */
    protected function getWidgetName($suffix = true)
    {
        if (!$suffix) {
            return $this->argument('widget');
        }


        $name = Str::studly($this->argument('widget'));

        if (Str::contains(strtolower($name), 'widget') === false) {
            $name .= 'Widget';
        }

        return $name;
    }

    protected function getLowerWidgetName($suffix = true)
    {
        return Str::lower($this->getWidgetName($suffix));
    }

    /**
     * @return array|string
     */
    private function getWidgetNameWithoutNamespace()
    {
        return class_basename($this->getWidgetName());
    }

    public function getDefaultNamespace(): string
    {
        $module = $this->laravel['modules'];

        return $module->config('paths.generator.widget.namespace') ?: $module->config('paths.generator.widget.path', 'Widgets');
    }

    /**
     * Get the stub file name based on the options
     * @return string
     */
    protected function getStubName()
    {
        return '/widget.stub';
    }
}
