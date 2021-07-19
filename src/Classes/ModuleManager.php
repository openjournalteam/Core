<?php

namespace OpenJournalTeam\Core\Classes;

use Illuminate\Config\Repository as Config;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;
use Nwidart\Modules\Module;

class ModuleManager
{
    /**
     * @var Module
     */
    private $module;
    /**
     * @var Config
     */
    private $config;
    /**
     * @var PackageInformation
     */

    /**
     * @param Config $config
     * @param PackageInformation $packageVersion
     * @param Filesystem $finder
     */
    public function __construct(Config $config, PackageInformation $packageVersion, Filesystem $finder)
    {
        $this->module = app('modules');
        $this->config = $config;
        $this->packageVersion = $packageVersion;
        $this->finder = $finder;
    }

    /**
     * Return all modules
     *
     * @return \Illuminate\Support\Collection
     */
    public function all()
    {
        return new Collection($this->module->all());
    }

    /**
     * Return all the enabled modules
     *
     * @return array
     */
    public function enabled()
    {
        return $this->module->enabled();
    }

    /**
     * Get the core modules that shouldn't be disabled
     *
     * @return array|mixed
     */
    public function getCoreModules()
    {
        $coreModules = $this->config->get('asgard.core.config.CoreModules');
        return array_flip($coreModules);
    }

    /**
     * Get the enabled modules, with the module name as the key
     *
     * @return array
     */
    public function getFlippedEnabledModules()
    {
        $enabledModules = $this->module->enabled();

        $enabledModules = array_map(function (Module $module) {
            return $module->getName();
        }, $enabledModules);

        return array_flip($enabledModules);
    }

    /**
     * Disable the given modules
     *
     * @param $enabledModules
     */
    public function disableModules($enabledModules)
    {
        $coreModules = $this->getCoreModules();

        foreach ($enabledModules as $moduleToDisable => $value) {
            if (isset($coreModules[$moduleToDisable])) {
                continue;
            }
            $module = $this->module->get($moduleToDisable);
            $module->disable();
        }
    }

    /**
     * Enable the given modules
     *
     * @param $modules
     */
    public function enableModules($modules)
    {
        foreach ($modules as $moduleToEnable => $value) {
            $module = $this->module->get($moduleToEnable);
            $module->enable();
        }
    }
}
