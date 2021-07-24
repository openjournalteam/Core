<div class="card" id="menu-component">
    <ul class="nav nav-tabs nav-tabs-alt">
        <li class="nav-item">
            <a href="#tab-menus" class="nav-link active p-3" data-bs-toggle="tab">Menu</a>
        </li>
        <li class="nav-item">
            <a href="#tab-submenus" class="nav-link p-3" data-bs-toggle="tab">Submenu</a>
        </li>
    </ul>
    <div class="card-body">
        <div class="tab-content">
            <div id="tab-menus" class="tab-pane active show">
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

                @foreach ($menus as $menu)
                    <li class="list-group-item">
                        <div class="d-flex align-items-center me-1">
                            <i class="bi {{ $menu->show ? 'bi-check text-success' : 'bi-x text-danger' }}"
                                style="font-size:1.3em"></i>

                            <a href="#">
                                {{ $menu->name }}
                            </a>
                        </div>
                    </li>
                @endforeach

            </div>
            <div id="tab-submenus" class="tab-pane">
                <div class="d-flex align-items-center mb-2">
                    <h3>Current Submenu</h3>
                    <div class="ms-auto">
                        <a href="#" class="btn btn-outline-primary w-100" data-bs-toggle="modal"
                            data-bs-target="#modal-form-role">
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
                    <h4 data-bs-toggle="tooltip" data-bs-placement="top" title="Main Menu">
                        {{ $menu->name }}</h4>

                    <div class="list-group sortable-menu mb-4" url="#">
                        @forelse ($menu->childs as $sub)
                            <div class="list-group-item list-group-item-action" aria-current="true"
                                data-id="{{ $sub->name . $sub->id }}">
                                <div class="d-flex w-100 h-25px justify-content-between">
                                    <div class="d-flex justify-content-between align-items-center fs-5">
                                        <span class="ms-2" data-bs-toggle="tooltip" data-bs-placement="right"
                                            title="Submenu">
                                            {{ $sub->name }}</span>
                                    </div>
                                    <div class="">
                                        <a href="#" class="text-success fs-5 fw-bold me-4 edit_form_modal edit_menu"
                                            data-bs-toggle="modal" data-bs-target="#modal_form_submenu"
                                            data-json='@json($sub)'>
                                            <i class="far fa-edit text-success"></i>
                                            Edit
                                        </a>
                                        <a href="#" class="text-danger fs-5 fw-bold me-4 delete_confirm">
                                            <i class="far fa-trash-alt text-danger"></i>
                                            Delete
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="list-group-item">
                                No submenu
                            </div>
                        @endforelse
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</div>
