<div class="page-header d-print-none">
    <div class="row align-items-center">
        <div class="col">
            <div class="page-pretitle">
                Settings
            </div>
            <h2 class="page-title">
                Users & Roles
            </h2>
        </div>
        <div class="col-auto ms-auto d-print-none">
            {{ apply_filters('core::pages::settings::access::actions', '') }}
        </div>
    </div>
</div>
<div class="page-body">
    <div class="card">
        <ul class="nav nav-tabs nav-tabs-alt">
            <li class="nav-item">
                <a href="#tab-users" class="nav-link active p-3" data-bs-toggle="tab">Users</a>
            </li>
            <li class="nav-item">
                <a href="#tab-roles" class="nav-link p-3" data-bs-toggle="tab">Roles</a>
            </li>
            <li class="nav-item">
                <a href="#tab-permission" class="nav-link p-3" data-bs-toggle="tab">Permissions</a>
            </li>
            {{ apply_filters('core::pages::settings::access::nav-tabs', false) }}

        </ul>
        <div class="card-body">
            <div class="tab-content">
                <div id="tab-users" class="tab-pane active show">
                    <div class="d-flex align-items-center mb-2">
                        <h3>Current User</h3>
                        <div class="ms-auto">
                            <a href="#" class="btn btn-outline-primary w-100 add_user" data-bs-toggle="modal"
                                data-bs-target="#modal-form-user">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <circle cx="9" cy="7" r="4" />
                                    <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                    <path d="M16 11h6m-3 -3v6" />
                                </svg>
                                Add User
                            </a>
                        </div>
                    </div>

                    <table class="table table-bordered datatables w-100"
                        data-ajax="{{ route('core.admin.access.user_list') }}">
                        <thead>
                            <tr>
                                <th class="text-center" style="width:5%" data-data="DT_RowIndex" data-name="index"
                                    data-orderable="false" data-searchable="false" data-class="text-center">No</th>
                                <th data-data="name" data-name="name">Name</th>
                                <th data-data="email" data-name="email">Email</th>
                                <th data-data="created_at" style="width:20%" data-name="created_at">
                                    Joined Date</th>
                                <th data-data="roles" data-name="roles" data-orderable="false">
                                    Roles</th>
                                <th style="width:10%" data-data="action" data-name="action" data-orderable="false"
                                    data-searchable="false">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div id="tab-roles" class="tab-pane">
                    <div class="d-flex align-items-center mb-2">
                        <h3>Current Roles</h3>
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
                                Add Roles
                            </a>
                        </div>
                    </div>

                    <table class="table table-bordered datatables w-100"
                        data-ajax="{{ route('core.admin.access.role_list') }}">
                        <thead>
                            <tr>
                                <th class="text-center" data-data="DT_RowIndex" data-name="index" style="width:5%"
                                    data-orderable="false" data-searchable="false" data-class="text-center">No</th>
                                <th data-data="name" data-name="name">Name</th>
                                <th data-data="created_at" data-name="created_at">
                                    Created Date</th>
                                @if (config('app.debug'))
                                <th style="width:10%" data-data="action" data-name="action" data-orderable="false"
                                    data-searchable="false">Action</th>
                                @endif
                            </tr>
                        </thead>
                    </table>

                </div>
                <div id="tab-permission" class="tab-pane">
                    <div class="d-flex align-items-center mb-2">
                        <h3>Current Permission</h3>
                        <div class="ms-auto">
                            @if (config('app.debug'))
                            <a href="#" class="btn btn-outline-primary w-100" data-bs-toggle="modal"
                                data-bs-target="#modal-form-permission">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <circle cx="9" cy="7" r="4" />
                                    <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                    <path d="M16 11h6m-3 -3v6" />
                                </svg>
                                Add Permission
                            </a>
                            @endif
                        </div>

                    </div>

                    <table class="table table-bordered datatables w-100"
                        data-ajax="{{ route('core.admin.access.permission_list') }}">
                        <thead>
                            <tr>
                                <th class="text-center" data-data="DT_RowIndex" data-name="index" style="width:5%"
                                    data-orderable="false" data-searchable="false" data-class="text-center">No</th>
                                <th data-data="name" data-name="name">Name</th>
                                <th data-data="created_at" data-name="created_at">
                                    Created Date</th>
                                @if (config('app.debug'))
                                <th style="width:10%" data-data="action" data-name="action" data-orderable="false"
                                    data-searchable="false">Action</th>
                                @endif
                            </tr>
                        </thead>
                    </table>
                </div>
                {{ apply_filters('core::pages::settings::access::tab-content', false) }}
            </div>
        </div>
    </div>
    {{ apply_filters('core::pages::settings::access::page-body', false) }}
</div>

<div class="modal  fade" id="modal-form-user" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('core.admin.user.save') }}" method="POST" class="ajax_form" autocomplete="off">
                <div class="modal-header">
                    <h5 class="modal-title">Form User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id">

                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input name="username" type="text" class="form-control" placeholder="Enter username" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input name="name" type="text" class="form-control" placeholder="Enter name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email address</label>
                        <input id="email" name="email" type="email" autocomplete="nope" class="form-control"
                            placeholder="Enter email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Roles</label>
                        <select name="roles[]" class="form-select form-select-solid" data-control="select2ajax"
                            data-width="100%" data-dropdown-parent="#modal-form-user"
                            data-placeholder="Select an option" data-allow-clear="true"
                            data-ajax--url="{{ route('core.admin.role.options') }}" data-ajax--delay="700" multiple>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input id="password" name="password" autocomplete="new-password" type="password"
                            class="form-control" placeholder="Password">
                        <small class="form-hint" id="password-edit-hint" style="display: none">
                            Leave the password fields blank to keep the current password. The password must be at
                            least
                            8 characters.
                        </small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password Confirmation</label>
                        <input id="password_confirmation" name="password_confirmation" type="password"
                            class="form-control" placeholder="Password Confirmation">
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
<div class="modal  fade" id="modal-form-role" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('core.admin.role.save') }}" method="POST" class="ajax_form" autocomplete="off">
                <div class="modal-header">
                    <h5 class="modal-title">Form Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input id="role_name" name="name" type="text" class="form-control" placeholder="Enter name"
                            required>
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
<div class="modal  fade" id="modal-assign-role-permission" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('core.admin.role.assign_permission') }}" method="POST" class="ajax_form"
                autocomplete="off">
                <div class="modal-header">
                    <h5 class="modal-title">Form Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input name="name" type="text" class="form-control" placeholder="Enter name" required disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Permissions</label>
                        <select name="permissions[]" class="form-select form-select-solid" data-control="select2ajax"
                            data-width="100%" data-dropdown-parent="#modal-assign-role-permission"
                            data-placeholder="Select an option" data-allow-clear="true"
                            data-ajax--url="{{ route('core.admin.permission.options') }}" data-ajax--delay="700"
                            multiple>
                        </select>
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
<div class="modal  fade" id="modal-form-permission" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('core.admin.permission.save') }}" method="POST" class="ajax_form" autocomplete="off">
                <div class="modal-header">
                    <h5 class="modal-title">Form Permission</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input name="name" type="text" class="form-control" placeholder="Enter name" required>
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