<?php

namespace OpenJournalTeam\Core\Http\Livewire\Pages;

use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use OpenJournalTeam\Core\Facades\Core;
use OpenJournalTeam\Core\Models\Role;

class MenuPages extends Component
{
    public $permissionName = null;
    public $roles = [];

    public function mount()
    {
        $this->roles = Role::where('name', '!=', Role::SUPER_ADMIN)->get();

        add_script('vendor/core/libs/sortablejs/sortablejs.bundle.js');
    }

    public function render()
    {
        return render_livewire('core::livewire.menu.index');
    }

    public function updateSort($sorted)
    {
        foreach ($sorted as $key => $label) {
            $navSetting = Core::getNavigationSettingByLabel($label);

            $value = $navSetting->value;
            $value['sort'] = $key + 1;

            $navSetting->value = $value;
            $navSetting->save();
        }

        Cache::forget('navigation_settings');

        $this->emit('refreshMenu');
    }

    public function toggleMenu($label)
    {
        $navSetting = Core::getNavigationSettingByLabel($label);

        $value = $navSetting->value;
        $value['enabled'] = !$value['enabled'];

        $navSetting->value = $value;
        $navSetting->save();

        Cache::forget('navigation_settings');

        $this->emit('refreshMenu');
    }

    public function togglePermission(Role $role)
    {
        if ($role->checkPermissionTo($this->permissionName)) {
            $role->revokePermissionTo($this->permissionName);
        } else {
            $role->givePermissionTo($this->permissionName);
        }

        $this->emit('refreshMenu');
    }
}
