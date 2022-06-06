<?php

namespace OpenJournalTeam\Core\Http\Livewire\Components\Profile;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class AuthenticationComponent extends Component
{
  use LivewireAlert;

  public $oldPassword, $newPassword;

  public function render()
  {
    return view('core::livewire.profile.authentication');
  }

  public function changePassword()
  {
    $validated = $this->validate([
      'oldPassword' => [
        'required',
        function ($attribute, $value, $fail) {
          if (!Hash::check($value, Auth::user()->getAuthPassword())) {
            $fail('The ' . $attribute . ' is incorrect.');
            return;
          }
        }
      ],
      'newPassword' => 'required|min:8',
    ]);

    // Change password
    Auth::user()->update([
      'password' => Hash::make($validated['newPassword']),
    ]);

    $this->emit('saveFormModal');
    $this->alert('success', 'Successfully change Password');
  }
}
