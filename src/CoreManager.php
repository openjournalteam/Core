<?php

namespace OpenJournalTeam\Core;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use OpenJournalTeam\Core\Models\Config;
use OpenJournalTeam\Core\Models\WidgetSetting;
use OpenJournalTeam\Core\Widgets\Widget;

class CoreManager
{
  protected array $navigationItems = [];

  protected array $widgets = [];

  protected $widgetSettings = null;

  public function registerNavigationItems(array $items): void
  {
    $this->navigationItems = array_merge($this->navigationItems, $items);
  }

  public function registerWidgets(array $widgets): void
  {
    $this->widgets = array_merge($this->widgets, $widgets);
  }

  public function getNavigation(): array
  {
    // $groupedItems = collect($this->navigationItems)
    //   ->sortBy(fn (Navigation\NavigationItem $item): int => $item->getSort())
    //   ->groupBy(fn (Navigation\NavigationItem $item): ?string => $item->getGroup());

    // $sortedGroups = $groupedItems
    //   ->keys()
    //   ->sortBy(function (?string $group): int {
    //     if (!$group) {
    //       return -1;
    //     }

    //     $sort = array_search($group, $this->navigationGroups);

    //     if ($sort === false) {
    //       return count($this->navigationGroups);
    //     }

    //     return $sort;
    //   });

    return $this->navigationItems;
  }

  public function getWidgets($enableOnly = true): array|Collection
  {
    $widgets = collect($this->widgets);
    if ($widgets->isEmpty()) {
      return [];
    }

    if ($enableOnly) {

      $widgets = $widgets->filter(function ($widget) {
        return $widget::getEnabled();
      });
    }

    return $widgets;
  }

  public function getGroupedWidgets($enableOnly = true)
  {
    $widgets = $this->getWidgets($enableOnly);

    if (!$widgets) return null;

    $widgetGroups  = [
      '1' => [],
      '2' => [],
      '3' => [],
    ];

    foreach ($widgets as $widget) {
      $widgetGroups[$widget::getColumn()][] = $widget;
    }

    $widgetsGroup = collect($widgetGroups)->map(function ($widgets, $column) {
      return collect($widgets)
        ->sortBy(function ($widget, $key) {
          return $widget::getSort();
        })->values()->all();
    });

    return $widgetsGroup;
  }

  public function getWidgetSettings()
  {
    if ($this->widgetSettings) {
      return $this->widgetSettings;
    }

    return $this->widgetSettings = Cache::remember('widgetSettingSystem', 14400, fn () => WidgetSetting::where('setting', 'system')->get());
  }

  public function getWidgetSettingByName($name)
  {
    $widgetSettings = $this->getWidgetSettings();
    $key = $widgetSettings->search(fn (WidgetSetting $setting): bool => $setting->name === $name);
    if ($key === false) {
      return WidgetSetting::where('name', $name)->where('setting', 'system')->first();
    }

    return $widgetSettings[$key];
  }
}
