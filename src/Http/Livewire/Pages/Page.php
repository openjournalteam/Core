<?php

namespace OpenJournalTeam\Core\Http\Livewire\Pages;

use Livewire\Component;

class Page extends Component
{
  protected $view;

  public function render()
  {
    return render_livewire($this->view);
  }
}
