<?php

namespace OpenJournalTeam\Core\Http\Livewire\Pages;

use Livewire\Component;

class Page extends Component
{
  protected $view;

  protected function getViewData(): array
  {
    return [];
  }

  public function render()
  {
    return render_livewire($this->view, $this->getViewData());
  }
}
