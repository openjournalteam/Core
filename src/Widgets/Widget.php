<?php

namespace OpenJournalTeam\Core\Widgets;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class Widget extends Component
{
    protected static ?int $sort = null;

    protected static string $view;

    public static function getSort(): int
    {
        return static::$sort ?? -1;
    }

    protected function getViewData(): array
    {
        return [];
    }

    public function render(): View
    {
        return view(static::$view, $this->getViewData());
    }
}
