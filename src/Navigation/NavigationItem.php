<?php

namespace OpenJournalTeam\Core\Navigation;

use Closure;

class NavigationItem
{
    protected ?Closure $isActiveWhen = null;

    protected ?Closure $subNavigationItems = null;

    protected string $icon;

    protected string $label;

    protected ?int $sort = null;

    protected ?string $route = null;

    public function __construct()
    {
    }

    public static function make(): static
    {
        return new static();
    }

    public function icon(string $icon, bool $isSvg = false): static
    {
        if ($isSvg) {
            $this->icon = $icon;

            return $this;
        }

        $this->icon = '<i class="' . $icon . '"></i>';

        return $this;
    }

    public function isActiveWhen(Closure $callback): static
    {
        $this->isActiveWhen = $callback;

        return $this;
    }

    public function subNavigationItems(Closure $callback): static
    {
        $this->subNavigationItems = $callback;

        return $this;
    }

    public function label(string $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function sort(?int $sort): static
    {
        $this->sort = $sort;

        return $this;
    }

    public function route(?string $route): static
    {
        $this->route = $route;

        return $this;
    }

    public function getIcon(): string
    {
        return $this->icon;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getSort(): int
    {
        return $this->sort ?? -1;
    }

    public function getRoute($generateRoute = false): ?string
    {
        if (!$generateRoute) {
            return $this->route;
        }

        if ($this->route) {
            return route($this->route);
        }

        return '#';
    }

    public function getSubNavigationItems()
    {
        $callback = $this->subNavigationItems;

        if ($callback === null) {
            return null;
        }

        return app()->call($callback);
    }

    public function isActive(): bool
    {
        $callback = $this->isActiveWhen;

        if ($callback === null) {
            return false;
        }

        return app()->call($callback);
    }
}
