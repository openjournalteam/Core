<?php

namespace OpenJournalTeam\Core\Navigation;

use Closure;
use Illuminate\Support\Str;
use OpenJournalTeam\Core\Facades\Core;
use OpenJournalTeam\Core\Models\Config;

class NavigationItem
{
    protected string $icon;

    protected string $label;

    protected bool $enabled = true;

    protected ?string $permission = null;

    protected ?Closure $isActiveWhen = null;

    protected ?Closure $subNavigationItems = null;

    protected ?int $sort = null;

    protected ?string $route = null;
    
    protected bool | Closure | null $hidden = null;
    
    public function __construct()
    {
    }

    public static function make($label = false): static
    {
        $object = new static();
        if ($label) {
            $object->label($label);
        }
        return $object;
    }

    public function enabled(bool $enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    public function getEnabled(): bool
    {
        if ($setting = $this->getSetting()) return $setting->value['enabled'];

        return $this->enabled;
    }

    public function permission(string $permission)
    {
        $this->permission = Str::start($permission, 'Menu ');

        return $this;
    }

    public function getPermission()
    {
        return $this->permission;
    }

    public function icon(string $icon, bool $rawHtml = false): static
    {
        if ($rawHtml) {
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
        if ($setting = $this->getSetting()) return $setting->value['sort'];

        return $this->sort ?? 99;
    }

    public function getSetting()
    {
        $setting = Core::getNavigationSettingByLabel($this->getLabel());
        if ($setting === null) {
            $setting = Config::updateOrCreate([
                'key' => 'menu.' . $this->getLabel(),
            ], [
                'value' => [
                    'enabled' => $this->enabled,
                    'sort' => $this->sort ?? 99,
                ],
            ]);
        }

        return $setting;
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

    public function hidden(bool | Closure | null $isHidden = null): static
    {
        $this->hidden = $isHidden;
        return $this;
    }

    public function isHidden(): ?bool
    {
        if($this->hidden instanceof Closure) {
            return app()->call($this->hidden);
        }
        return $this->hidden;
    }
}
