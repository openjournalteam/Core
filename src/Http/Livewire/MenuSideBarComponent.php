<?php



namespace OpenJournalTeam\Core\Http\Livewire;

use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use OpenJournalTeam\Core\Models\Menu;

class MenuSideBarComponent extends Component
{
  public $menus;
  public $hookMenu;

  protected $listeners = ['refreshMenu' => '$refresh'];

  public function mount(): void
  {
    $this->hookMenu = apply_filters('MenuManager::add', $this->hookMenu);
  }

  public function render()
  {
    $this->menus = Cache::rememberForever('menus', function () {
      return Menu::with('childs')->where('parent_id', 0)->orderBy('order')->get();
    });

    return view('core::livewire.menu.sidebar');
  }
}
