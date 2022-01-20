<?php

namespace OpenJournalTeam\Core\Widgets;

use Illuminate\Contracts\View\View;
use Livewire\Component;
use OpenJournalTeam\Core\Facades\Core;
use OpenJournalTeam\Core\Models\WidgetSetting;

abstract class Widget extends Component
{
    public static int $column = 1;

    public static bool $enabled = true;

    public static int $sort = 1;

    public static string $title = '';

    protected static string $view;

    public function __construct()
    {
        parent::__construct();

        if (!static::getSystemSetting()) {
            WidgetSetting::updateOrCreate([
                'name' => static::class,
                'setting' => 'system',
                'user_id' => user()->id,
            ], ['value' => static::getStaticProperties()]);
        }
    }

    public static function getTitle(): string
    {
        return static::$title;
    }

    public static function getSort(): int|null
    {
        if ($setting = static::getSystemSetting()) return $setting->value['sort'];
        return static::$sort;
    }

    public static function getSystemSetting()
    {
        return Core::getWidgetSettingByName(static::class);
    }

    public static function getEnabled(): bool
    {
        if ($setting = static::getSystemSetting()) return filter_var($setting->value['enabled'], FILTER_VALIDATE_BOOLEAN);;
        return static::$enabled;
    }

    public static function getColumn(): int
    {
        if ($setting = static::getSystemSetting()) return (int) $setting->value['column'];
        return (int) static::$column;
    }

    protected function getViewData(): array
    {
        return [];
    }

    public function render(): View
    {
        return view(static::$view, $this->getViewData());
    }

    static function getStaticPropertyValue($key)
    {
        $rc = new \ReflectionClass(get_called_class());
        return $rc->getStaticPropertyValue($key);
    }

    static function setStaticPropertyValue($key, $value)
    {
        // return static::$$key = $value;
        $rc = new \ReflectionClass(get_called_class());
        return $rc->setStaticPropertyValue($key, $value);
    }

    static function getStaticProperties()
    {
        $rc = new \ReflectionClass(get_called_class());
        return array_filter($rc->getStaticProperties(), function ($consts) {
            $ignore = ['view', 'macros'];
            return !in_array($consts, $ignore);
        }, ARRAY_FILTER_USE_KEY);
    }
}
