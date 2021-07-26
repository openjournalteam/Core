<?php

namespace OpenJournalTeam\Core;

use Livewire\Livewire;
use OpenJournalTeam\Core\Http\Livewire\MenuComponent;
use OpenJournalTeam\Core\Http\Livewire\MenuSideBarComponent;

class LiveWireComponentServiceProvider extends \Illuminate\Support\ServiceProvider
{
  public function register()
  {
    Livewire::component('core:menu', MenuComponent::class);
    Livewire::component('core:menu:sidebar', MenuSideBarComponent::class);
  }
}
