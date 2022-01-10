<?php

namespace OpenJournalTeam\Core\Http\Livewire\Components;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class UserDropdownComponent extends Component
{
  public $user;

  protected $listeners = ['refresh' => 'refresh'];

  public function render()
  {
    return view('core::livewire.user.dropdown');
  }

  public function refresh()
  {
    $this->user = Auth::user();
  }
}
