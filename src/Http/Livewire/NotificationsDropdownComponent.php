<?php

namespace OpenJournalTeam\Core\Http\Livewire;

use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NotificationsDropdownComponent extends Component
{
  public $notifications;
  public $class;

  protected $listeners = ['refresh' => 'refresh'];

  public function render()
  {
    return view('core::livewire.notifications.dropdown');
  }

  public function refresh()
  {
    $this->notifications = Auth::user()
      ->unreadNotifications()
      ->limit(5)
      ->get();
  }

  public function markAsRead(DatabaseNotification $notification)
  {
    $notification->markAsRead();

    $this->refresh();
  }
}
