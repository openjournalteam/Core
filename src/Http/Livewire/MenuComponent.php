<?php

namespace OpenJournalTeam\Core\Http\Livewire;

use Livewire\Component;
use OpenJournalTeam\Core\Models\Menu;

class MenuComponent extends Component
{
    public $menus;
    public $hookMenu = [];

    protected $listeners = ['refreshMenu' => '$refresh'];


    public function render()
    {
        $this->menus = Menu::with('childs')->where('parent_id', 0)->orderBy('order')->get();
        

        return view('core::livewire.menu.component');
    }
}
