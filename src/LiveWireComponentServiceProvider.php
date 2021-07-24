<?php

namespace OpenJournalTeam\Core;

use Livewire\Livewire;
use OpenJournalTeam\Core\Http\Livewire\MenuComponent;

class LiveWireComponentServiceProvider extends \Illuminate\Support\ServiceProvider
{
  public function register()
  {
    Livewire::component('core:menu', MenuComponent::class);
  }
}
