<?php

namespace OpenJournalTeam\Core\Http\Livewire\Components;

use Livewire\Component;

class MenuSideBarComponent extends Component
{
  public $menus;

  protected $listeners = ['refreshMenu' => '$refresh'];

  public function render()
  {
    return view('core::livewire.menu.sidebar');
  }
}
