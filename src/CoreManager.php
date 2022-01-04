<?php

namespace OpenJournalTeam\Core;

use Illuminate\Support\Collection;
use OpenJournalTeam\Core\Models\Config;
use OpenJournalTeam\Core\Widgets\Widget;

class CoreManager
{
  protected array $navigationItems = [];

  protected array $widgets = [];

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

  public function getWidgets(): ?Collection
  {
    $widgets = collect($this->widgets);
    if ($widgets->isEmpty()) {
      return null;
    }

    // get json config from database
    $widgetConfig = Config::find('widgets');
    if (!$widgetConfig) {
      $widgetGroups  = [
        '1' => [],
        '2' => [],
        '3' => [],
      ];

      foreach ($this->widgets as $widget) {
        $widgetGroups[$widget::getColumn()][] = $widget;
      }

      $widgetsGroup = collect($widgetGroups)->map(function ($widgets, $column) {
        return collect($widgets)
          ->sortBy(fn (string $widget): int => $widget::getSort())
          ->filter(fn (string $widget): bool => $widget::getEnabled());
      });

      return $widgetsGroup;
    }
  }
}
