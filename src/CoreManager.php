<?php

namespace OpenJournalTeam\Core;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use OpenJournalTeam\Core\Models\Config;
use OpenJournalTeam\Core\Models\WidgetSetting;
use OpenJournalTeam\Core\Navigation\NavigationItem;

class CoreManager
{
  protected array $navigationItems = [];

  protected array $widgets = [];

  protected $widgetSettings = null;

  protected $navigationSettings = null;

  public function registerNavigationItems(array $items): void
  {
    $this->navigationItems = array_merge($this->navigationItems, $items);
  }

  public function setNavigationItems(array $items): void
  {
    $this->navigationItems = $items;
  }

  public function getNavigationItems(): array
  {
    return $this->navigationItems;
  }

  public function registerWidgets(array $widgets): void
  {
    $this->widgets = array_merge($this->widgets, $widgets);
  }

  public function getNavigation($enableOnly = true): array|Collection
  {
    $sortedItems = collect($this->navigationItems);
    if ($enableOnly) {
      $sortedItems = $sortedItems->filter(function ($item) {
        return $item->getEnabled();
      });
    }

    return $sortedItems->sortBy(fn (NavigationItem $item): int => $item->getSort());
  }

  public function getNavigationSettings()
  {
    if ($this->navigationSettings) {
      return $this->navigationSettings;
    }

    return $this->navigationSettings = Cache::remember('navigation_settings', 14440, fn () => Config::where('key', 'like', 'menu.%')->get());
  }

  public function getNavigationSettingByLabel($label)
  {

    $navSettings = $this->getNavigationSettings();
    $label = 'menu.' . $label;

    $key = $navSettings->search(fn ($setting): bool => $setting->key === $label);
    if ($key === false) {
      return Config::where('key', $label)->first();
    }

    return $navSettings[$key];
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

    $userid = user()->id ?? 0;

    return $this->widgetSettings = Cache::remember('widgetSettingSystem' . $userid, 14400, fn () => WidgetSetting::settingSystemByUser($userid)->get());
  }

  public function getWidgetSettingByName($name)
  {
    $widgetSettings = $this->getWidgetSettings();
    $key = $widgetSettings->search(fn (WidgetSetting $setting): bool => $setting->name === $name);
    if ($key === false) {
      return WidgetSetting::settingSystemByNameAndUser($name)->first();
    }

    return $widgetSettings[$key];
  }

  public function forgetCache()
  {
    $userid = user()->id ?? 0;

    Cache::forget('widgetSettingSystem' . $userid);
  }
}
