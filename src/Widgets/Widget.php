<?php

namespace OpenJournalTeam\Core\Widgets;

use Illuminate\Contracts\View\View;
use Livewire\Component;
use OpenJournalTeam\Core\Models\WidgetSetting;

class Widget extends Component
{
    protected static int $column = 1;

    protected static bool $enabled = true;

    protected static ?int $sort = null;

    protected static string $view;

    public static function getSort(): int
    {
        if ($setting = static::getSetting('sort')) {
            return $setting->value;
        }
        return static::$sort ?? -1;
    }

    public static function getEnabled(): bool
    {
        if ($setting = static::getSetting('enabled')) {
            return filter_var($setting->value, FILTER_VALIDATE_BOOLEAN);
        }

        return static::$enabled;
    }

    public static function getColumn(): int
    {
        if ($setting = static::getSetting('column')) {
            return $setting->value;
        }
        return static::$column;
    }

    public static function setColumn(int $column): void
    {
        static::setSetting('column', $column);
    }

    protected function getViewData(): array
    {
        return [];
    }

    public static function getSetting($key)
    {
        return WidgetSetting::where('name', static::class)->where('setting', $key)->first();
    }

    public static function setSetting($key, $value): void
    {
        $setting = static::getSetting($key);
        if (!$setting) {
            $setting = new WidgetSetting();
            $setting->name = static::class;
            $setting->setting = $key;
        }
        $setting->value = $value;
        $setting->save();
    }

    public function render(): View
    {

        return view(static::$view, $this->getViewData());
    }
}
