<?php

namespace OpenJournalTeam\Core\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Str;

class WidgetContainer extends Component
{
    public $widget;
    public $id;
    public $customize = false;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($widget, $customize)
    {
        $this->widget = $widget;
        $this->customize = $customize;
        $this->id = 'a' .  Str::random(10);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('core::components.widget-container');
    }
}
