<?php

namespace OpenJournalTeam\Core\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use OpenJournalTeam\Core\CoreManager;
use OpenJournalTeam\Core\Facades\Core;

abstract class ModuleServiceProvider extends ServiceProvider
{
  protected array $widgets = [];

  protected array $navigationItems = [];

  /**
   * Bootstrap the application services.
   *
   * @return void
   */
  public function boot()
  {
    foreach ($this->getWidgets() as $widget) {
      Livewire::component($widget::getName(), $widget);
    }
  }

  /**
   * Register the application services.
   *
   * @return void
   */
  public function register()
  {
    $this->app->singletonIf(
      'core',
      fn (): CoreManager => new CoreManager()
    );

    Core::registerNavigationItems($this->getNavigationItems());
    Core::registerWidgets($this->getWidgets());
  }

  protected function getWidgets(): array
  {
    return $this->widgets;
  }

  protected function getNavigationItems(): array
  {
    return $this->navigationItems;
  }
}
