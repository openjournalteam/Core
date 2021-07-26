<div class="page-header d-print-none">
    <div class="row align-items-center">
        <div class="col">
            <div class="page-pretitle">
                Settings
            </div>
            <h2 class="page-title">
                Menu & Submenu
            </h2>
        </div>
        <div class="col-auto ms-auto d-print-none">
        </div>
    </div>
</div>
<div class="page-body">
    @livewire('core:menu')
</div>

<div class="modal modal-blur fade" id="modal-form-menu" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('core.admin.menu.save') }}" method="POST" class="ajax_form" callback="refreshMenu"
                autocomplete="off">
                <div class="modal-header">
                    <h5 class="modal-title">Form Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="generatedToken" name="token">
                    <input type="hidden" name="order">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input name="name" type="text" class="form-control" placeholder="Enter name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Icon</label>
                        <input name="icon" type="text" class="form-control"
                            placeholder="Contoh : <i class='fa fa-icon'> </i>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Route</label>
                        <input name="route" type="text" class="form-control" placeholder="Enter Route">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Roles</label>
                        <select name="roles[]" class="form-select form-select-solid" data-control="select2ajax"
                            data-width="100%" data-dropdown-parent="#modal-form-menu"
                            data-placeholder="Select an option" data-allow-clear="true"
                            data-ajax--url="{{ route('core.admin.role.options') }}" data-ajax--delay="700" multiple
                            required>
                        </select>
                    </div>
                    <div class="mb-3 row align-items-center">
                        <div class="col-md-10">
                            <label class="form-label">Show</label>
                            <div class="text-muted">Menu will be show or not</div>
                        </div>
                        <div class="col-md-2">
                            <label class="form-check form-switch float-end">
                                <input class="form-check-input" name="show" type="checkbox" value="1" checked>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="modal-form-submenu" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('core.admin.menu.save') }}" method="POST" class="ajax_form" callback="refreshMenu"
                autocomplete="off">
                <div class="modal-header">
                    <h5 class="modal-title">Form Submenu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="generatedToken" name="token">
                    <input type="hidden" name="order">
                    <div class="mb-3">
                        <label class="form-label">Parent</label>
                        <select name="parent_id" class="form-select form-select-solid" data-control="select2ajax"
                            data-width="100%" data-dropdown-parent="#modal-form-submenu"
                            data-placeholder="Select an option" data-allow-clear="true"
                            data-ajax--url="{{ route('core.admin.menu.options') }}" data-ajax--delay="500" required>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input name="name" type="text" class="form-control" placeholder="Enter name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Icon</label>
                        <input name="icon" type="text" class="form-control"
                            placeholder="Contoh : <i class='fa fa-icon'> </i>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Route</label>
                        <input name="route" type="text" class="form-control" placeholder="Enter Route">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Roles</label>
                        <select name="roles[]" class="form-select form-select-solid" data-control="select2ajax"
                            data-width="100%" data-dropdown-parent="#modal-form-submenu"
                            data-placeholder="Select an option" data-allow-clear="true"
                            data-ajax--url="{{ route('core.admin.role.options') }}" data-ajax--delay="700" multiple>
                        </select>
                    </div>
                    <div class="mb-3 row align-items-center">
                        <div class="col-md-10">
                            <label class="form-label">Show</label>
                            <div class="text-muted">Menu will be show or not</div>
                        </div>
                        <div class="col-md-2">
                            <label class="form-check form-switch float-end">
                                <input class="form-check-input" name="show" type="checkbox" value="1" checked>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
