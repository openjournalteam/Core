<?php

namespace OpenJournalTeam\Core\Http\Livewire;

use Livewire\Component;
use OpenJournalTeam\Core\Models\Menu;

class MenuComponent extends Component
{
    public $menus;

    protected $listeners = ['refresh' => '$refresh'];

    public function mount()
    {
    }

    public function render()
    {
        $this->menus = Menu::with('childs')->where('parent_id', 0)->orderBy('order')->get();
        return view('core::livewire.menu.component');
    }

    public function save()
    {
    }

    public function delete(Menu $menu)
    {
        $menu->delete();
    }
}
