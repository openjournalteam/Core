<?php

namespace OpenJournalTeam\Core\Http\Livewire\Components\Profile;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ApiTokenComponent extends Component
{
  use LivewireAlert;

  public $createToken = false;
  // input
  public $tokenName = null;

  public function render()
  {
    $tokens = Auth::user()->tokens;

    return view('core::livewire.profile.api-token', compact('tokens'));
  }

  public function createToken()
  {
    $this->validate([
      'tokenName' => 'required|string|max:255',
    ]);
    $token  = Auth::user()->createToken($this->tokenName);
    session()->flash('newToken', $token->plainTextToken);

    $this->alert('success', 'Token created successfully.');

    $this->resetForm();
  }

  public function resetForm()
  {
    $this->tokenName = null;
    $this->createToken = false;
  }

  public function deleteToken($id)
  {
    Auth::user()->tokens()->find($id)->delete();

    $this->alert('info', 'Token deleted successfully.');
    $this->emit('saveFormModal');
  }
}
