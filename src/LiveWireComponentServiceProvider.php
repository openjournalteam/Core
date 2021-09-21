<?php


namespace OpenJournalTeam\Core;

use Livewire\Livewire;
use OpenJournalTeam\Core\Http\Livewire\MenuComponent;
use OpenJournalTeam\Core\Http\Livewire\MenuSideBarComponent;
use OpenJournalTeam\Core\Http\Livewire\NotificationsDropdownComponent;
use OpenJournalTeam\Core\Http\Livewire\UserDropdownComponent;

class LiveWireComponentServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register(): void
    {
        Livewire::component('core:menu', MenuComponent::class);
        Livewire::component('core:menu:sidebar', MenuSideBarComponent::class);
        Livewire::component('core:notifications-dropdown', NotificationsDropdownComponent::class);
        Livewire::component('core:user-dropdown', UserDropdownComponent::class);
    }
}
