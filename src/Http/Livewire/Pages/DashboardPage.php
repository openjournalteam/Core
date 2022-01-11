<?php

namespace OpenJournalTeam\Core\Http\Livewire\Pages;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use OpenJournalTeam\Core\Facades\Core;
use OpenJournalTeam\Core\Models\WidgetSetting;

class DashboardPage extends Component
{
  public $widgetGroup;
  public $customize = false;

  function boot()
  {
    if (!Auth::check()) {
      return redirect()->route('core.login');
    }

    $this->widgetGroup = Core::getGroupedWidgets(!$this->customize);
  }

  function mount()
  {
    add_script('vendor/core/libs/sortablejs/sortablejs.bundle.js');
  }

  public function render()
  {
    return render_livewire('core::livewire.dashboard.index');
  }

  function toggleCustomize()
  {
    $this->customize = !$this->customize;
    $this->widgetGroup = Core::getGroupedWidgets(!$this->customize);
  }

  function updateSortWidget($list, $column)
  {
    foreach ($list as $key => $widget) {
      $widgetSetting = Core::getWidgetSettingByName($widget) ?? WidgetSetting::settingSystemByUser();

      $value = $widgetSetting->value;
      $value['column'] = $column;
      $value['sort'] = $key + 1;

      $widgetSetting->value = $value;
      $widgetSetting->save();
    }

    Core::forgetCache();

    $this->widgetGroup = Core::getGroupedWidgets(!$this->customize);
  }

  function toggleWidget($widget)
  {
    $widgetSetting = Core::getWidgetSettingByName($widget);
    $value = $widgetSetting->value;
    $value['enabled'] = !$value['enabled'];

    $widgetSetting->value = $value;
    $widgetSetting->save();

    Core::forgetCache();

    $this->widgetGroup = Core::getGroupedWidgets(!$this->customize);
  }
}
