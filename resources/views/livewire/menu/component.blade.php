<div class="card" id="menu-component">
    <ul class="nav nav-tabs nav-tabs-alt">
        <li class="nav-item" wire:ignore>
            <a href="#tab-menus" class="nav-link active p-3" data-bs-toggle="tab">Menu</a>
        </li>
        <li class="nav-item" wire:ignore>
            <a href="#tab-submenus" class="nav-link p-3" data-bs-toggle="tab">Submenu</a>
        </li>
    </ul>
    <div class="card-body">
        <div class="tab-content">
            <div id="tab-menus" class="tab-pane active show" wire:ignore.self>
                <div class="d-flex align-items-center mb-2">
                    <h3>Current Menu</h3>
                    <div class="ms-auto">
                        <a href="#" class="btn btn-outline-primary w-100 generate_token" data-bs-toggle="modal"
                            data-bs-target="#modal-form-menu">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <circle cx="9" cy="7" r="4" />
                                <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                <path d="M16 11h6m-3 -3v6" />
                            </svg>
                            Add Menu
                        </a>
                    </div>
                </div>

                <ul class="list-group sortable-menu" url="{{ route('core.admin.menu.sort') }}">
                    @foreach ($menus as $menu)
                        <li class="list-group-item" data-id="{{ $menu->id }}">
                            <div class="d-flex">
                                <div class="d-flex align-items-center me-1">
                                    <i class="bi {{ $menu->show ? 'bi-check text-success' : 'bi-x text-danger' }}"
                                        style="font-size:1.3em" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="{{ $menu->show ? 'Menu Show' : 'Menu Hidden' }}"></i>
                                    <span>
                                        @if (isset($menu->icon))
                                            {!! $menu->icon !!}
                                        @endif
                                        {{ $menu->name }}
                                    </span>
                                </div>

                                <div class="ms-auto d-flex align-items-center">
                                    <a href="#" class="edit_form_modal me-2"
                                        data-url="{{ route('core.admin.menu.edit', $menu->token) }}"
                                        data-bs-toggle="modal" data-bs-target="#modal-form-menu">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3"></path>
                                            <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3"></path>
                                            <line x1="16" y1="5" x2="19" y2="8"></line>
                                        </svg>
                                        Edit
                                    </a>
                                    <a class="text-danger delete_confirm"
                                        href="{{ route('core.admin.menu.delete', $menu->token) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <line x1="4" y1="7" x2="20" y2="7" />
                                            <line x1="10" y1="11" x2="10" y2="17" />
                                            <line x1="14" y1="11" x2="14" y2="17" />
                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                        </svg>
                                        Delete
                                    </a>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>

            </div>
            <div id="tab-submenus" class="tab-pane" wire:ignore.self>
                <div class="d-flex align-items-center mb-2">
                    <h3>Current Submenu</h3>
                    <div class="ms-auto">
                        <a href="#" class="btn btn-outline-primary w-100 generate_token" data-bs-toggle="modal"
                            data-bs-target="#modal-form-submenu">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <circle cx="9" cy="7" r="4" />
                                <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                <path d="M16 11h6m-3 -3v6" />
                            </svg>
                            Add Submenu
                        </a>
                    </div>
                </div>
                @foreach ($menus as $menu)
                    @if ($menu->childs->count() < 1)
                        @continue
                    @endif

                    <div class="d-flex">
                        <h4 data-bs-toggle="tooltip" data-bs-placement="top" title="Main Menu">
                            @if (isset($menu->icon))
                                {!! $menu->icon !!}
                            @endif
                            {{ $menu->name }}
                        </h4>
                    </div>

                    <div class="list-group sortable-menu mb-4" url="{{ route('core.admin.menu.sort') }}">
                        @foreach ($menu->childs as $sub)
                            <div class="list-group-item list-group-item-action" aria-current="true"
                                data-id="{{ $sub->id }}">
                                <div class="d-flex w-100 h-25px justify-content-between">
                                    <div class="d-flex justify-content-between align-items-center fs-5">
                                        <i class="bi {{ $sub->show ? 'bi-check text-success' : 'bi-x text-danger' }}"
                                            style="font-size:1.3em" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="{{ $sub->show ? 'Menu Show' : 'Menu Hidden' }}"></i>
                                        <span class="ms-2" data-bs-toggle="tooltip" data-bs-placement="right"
                                            title="Submenu">
                                            @if (isset($sub->icon))
                                                {!! $sub->icon !!}
                                            @endif
                                            {{ $sub->name }}
                                        </span>
                                    </div>
                                    <div class="d-flex">
                                        <a href="#" class="edit_form_modal me-2"
                                            data-url="{{ route('core.admin.menu.edit', $sub->token) }}"
                                            data-bs-toggle="modal" data-bs-target="#modal-form-submenu">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3">
                                                </path>
                                                <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3"></path>
                                                <line x1="16" y1="5" x2="19" y2="8"></line>
                                            </svg>
                                            Edit
                                        </a>
                                        <a class="text-danger delete_confirm"
                                            href="{{ route('core.admin.menu.delete', $sub->token) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <line x1="4" y1="7" x2="20" y2="7" />
                                                <line x1="10" y1="11" x2="10" y2="17" />
                                                <line x1="14" y1="11" x2="14" y2="17" />
                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                            </svg>
                                            Delete
                                        </a>
                                    </div>
                                </div>
                            </div>

                        @endforeach
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</div>
