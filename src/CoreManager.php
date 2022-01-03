<?php

namespace OpenJournalTeam\Core;

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
}
