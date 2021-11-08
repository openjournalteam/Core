<?php

namespace OpenJournalTeam\Core\Http\Controllers\Admin;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use OpenJournalTeam\Core\Auth;
use OpenJournalTeam\Core\Events\NewCustomer;
use OpenJournalTeam\Core\Http\Resources\JsonResponse;
use OpenJournalTeam\Core\Models\Role;
use OpenJournalTeam\Core\Models\User;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;

class AccessSettingsController extends AdminController
{
    public function index()
    {

        add_script('vendor/core/js/pages/settings/access.js');

        return render('core::pages.settings.access.index');
    }

    public function user_list(Request $request)
    {
        $data = User::query()->with('roles');
        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('created_at', function ($user) {
                return $user['created_at']->format('d M Y');
            })
            ->addColumn('roles', function ($row) {
                $html = '';

                foreach ($row->roles as $role) {
                    $html = '';

                    foreach ($row->roles as $role) {
                        $format = '<span class="badge bg-blue-lt mx-1 mb-1">%s</span>';
                        $vars = [
                            $role['name'],
                        ];
                        $dom = vsprintf($format, $vars);

                        $html .= $dom;
                    }

                    return $html;
                }

                return $html;
            })
            ->addColumn('action', function ($row) {
                if ($row->id === 1) {
                    return;
                }
                $format = '<div class="dropdown">
                    <button type="button" aria-label="dropdown-user" class="btn btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" /><circle cx="12" cy="12" r="3" /></svg>
                    </button>
                    <div class="dropdown-menu dropdown-menu-demo">
                      <span class="dropdown-header">Actions</span>
                      <a class="dropdown-item edit_user edit_form_modal" data-url="%s" href="#" data-bs-toggle="modal"
                      data-bs-target="#modal-form-user">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" /><path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" /><line x1="16" y1="5" x2="19" y2="8" /></svg>
                          Edit
                      </a>
                      <a class="dropdown-item text-danger delete_confirm" href="%s">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                        Delete
                      </a>
                    </div>
                  </div>';

                $vars = [
                    route('core.admin.user.edit', [$row->id]),
                    route('core.admin.user.delete', [$row->id]),
                ];

                return vsprintf($format, $vars);
            })
            ->rawColumns(['roles', 'action'])
            ->make(true);
    }

    public function user_save(Request $request)
    {
        $validationArray = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ];

        $inputArray = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ];

        if ($request->input('password')) {
            $inputArray = array_merge($inputArray, [
                'password' => Hash::make($request->password),
            ]);
        }

        if ($request->input('id')) {
            $user = User::find($request->input('id'));
            if ($user->email !== $request->input('email')) {
                $validationArray['email'] = 'required|string|email|max:255|unique:users';
            }
        } else {
            $validationArray = array_merge($validationArray, [
                'password' => ['required', 'min:8', 'confirmed', Rules\Password::defaults()],
                'email' => 'required|string|email|max:255|unique:users',
            ]);

            $inputArray = array_merge($inputArray, [
                'password' => Hash::make($request->password),
            ]);
        }

        $request->validate($validationArray);

        $user = User::updateOrCreate(
            [
                'id' => $request->input('id'),
            ],
            $inputArray
        );

        if ($request->input('roles')) {
            $user->syncRoles($request->input('roles'));
        } else {
            $user->roles()->detach();
        }

        $data = [
            'msg' => !$request->input('id') ? 'Success Adding User ..' : 'Success Edit User ..',
        ];


        return response()->json(new JsonResponse($data));
    }

    public function user_edit(Request $request, User $user)
    {
        if (!$request->ajax()) {
            return abort(401);
        }

        $roles = $user->roles()->select(['id', 'name as text'])->get()->makeHidden(['pivot']);

        $user->setAttribute('roles', $roles);

        return response()->json($user->makeHidden(['updated_at', 'created_at', 'password', 'email_verified_at']));
    }

    public function user_delete(Request $request, User $user)
    {
        if (!$request->ajax()) {
            return abort(401);
        }

        if ($user->id === 1) {
            return abort(401, 'Default user cant be removed');
        }

        $user->delete();

        return response()->json(new JsonResponse(['msg' => 'Remove User Success..']));
    }

    public function user_check_email(Request $request)
    {
        $user = User::where('email', $request->input('email'))->exists();

        if ($user) {
            return response()->json(false);
        }

        return response()->json(true);
    }

    public function role_list()
    {
        $data = Role::select(['id', 'name', 'created_at']);
        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('created_at', function ($role) {
                return $role['created_at']->format('d M Y');
            })
            ->addColumn('action', function ($row) {
                $format = '<div class="dropdown">
                    <button type="button" aria-label="dropdown-role" class="btn btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" /><circle cx="12" cy="12" r="3" /></svg>
                    </button>
                    <div class="dropdown-menu">
                      <span class="dropdown-header">Actions</span>
                      <a class="dropdown-item edit_form_modal" data-url="%s" href="#" data-bs-toggle="modal"
                      data-bs-target="#modal-assign-role-permission">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" /><path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" /><line x1="16" y1="5" x2="19" y2="8" /></svg>
                          Assign Permission
                      </a>
                      <a class="dropdown-item text-danger delete_confirm" data-url="%s">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                        Delete
                      </a>
                    </div>
                  </div>';

                $vars = [
                    route('core.admin.role.edit', [$row->id]),
                    route('core.admin.role.delete', [$row->id]),

                ];

                return vsprintf($format, $vars);
            })
            ->rawColumns(['roles', 'action'])
            ->make(true);
    }

    public function role_save(Request $request)
    {
        $validationArray = [
            'name' => 'required|string|max:255',
        ];

        $inputArray = [
            'name' => $request->input('name'),
            'guard' => $request->input('guard_name', 'web'),
        ];

        $request->validate($validationArray);

        Role::updateOrCreate(
            [
                'id' => $request->input('id'),
            ],
            $inputArray
        );

        $data = [
            'msg' => !$request->input('id') ? 'Success Adding Role ..' : 'Success Edit Role ..',
        ];

        return response()->json(new JsonResponse($data));
    }

    public function role_assign_permission(Request $request)
    {
        $permissionIds = $request->get('permissions', []);

        $permissions = Permission::whereIn('id', $permissionIds)->get();

        $role = Role::find($request->input('id'));

        $role->syncPermissions($permissions);

        $data = [
            'msg' => 'Success assign Permission ..',
        ];

        return response()->json(new JsonResponse($data));
    }

    public function role_check_name(Request $request)
    {
        $role = Role::where('name', $request->input('name'))->exists();

        if ($role) {
            return response()->json(false);
        }

        return response()->json(true);
    }

    public function role_edit(Request $request, Role $role)
    {
        if (!$request->ajax()) {
            return abort(401);
        }

        $permissions = $role->permissions()->select(['id', 'name as text'])->get();

        $role->setAttribute('permissions', $permissions);

        return response()->json($role->makeHidden(['updated_at', 'created_at']));
    }

    public function role_delete(Request $request, Role $role)
    {
        if (!$request->ajax()) {
            return abort(401);
        }

        if ($role->name === Role::SUPER_ADMIN) {
            return abort(401, 'Admin role cant be removed');
        }

        $role->delete();

        return response()->json(new JsonResponse(['msg' => 'Remove Role Success..']));
    }

    public function role_options(Request $request)
    {
        $search = $request->input('search');

        $roles = Role::orderBy('name')->select(['id', 'name as text'])->where('name', 'like', '%' . $search . '%')->limit(5)->get();

        return response()->json([
            'results' => $roles,
        ]);
    }

    public function permission_list()
    {
        $data = Permission::select(['id', 'name', 'created_at']);
        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('created_at', function ($role) {
                return $role['created_at']->format('d M Y');
            })
            ->addColumn('action', function ($row) {
                $format = '<div class="dropdown">
                    <button type="button" aria-label="dropdown-role" class="btn btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" /><circle cx="12" cy="12" r="3" /></svg>
                    </button>
                    <div class="dropdown-menu dropdown-menu-demo">
                      <span class="dropdown-header">Actions</span>
                      
                      <a class="dropdown-item text-danger delete_confirm" data-url="%s">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                        Delete
                      </a>
                    </div>
                  </div>';

                $vars = [
                    route('core.admin.permission.delete', [$row->id]),
                ];

                return vsprintf($format, $vars);
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function permission_save(Request $request)
    {
        $validationArray = [
            'name' => 'required|string|max:255',
        ];

        $inputArray = [
            'name' => $request->input('name'),
            'guard' => $request->input('guard_name', 'web'),
        ];

        $request->validate($validationArray);

        Permission::updateOrCreate(
            [
                'id' => $request->input('id'),
            ],
            $inputArray
        );

        $data = [
            'msg' => !$request->input('id') ? 'Success Adding Role ..' : 'Success Edit Role ..',
        ];

        return response()->json(new JsonResponse($data));
    }

    public function permission_delete(Request $request, Permission $permission)
    {
        if (!$request->ajax()) {
            return abort(401);
        }

        $permission->delete();

        return response()->json(new JsonResponse(['msg' => 'Remove Permission Success..']));
    }

    public function permission_options(Request $request)
    {
        $search = $request->input('search');

        $model = Permission::orderBy('name')->select(['id', 'name as text'])->where('name', 'like', '%' . $search . '%')->limit(5)->get();

        return response()->json([
            'results' => $model,
        ]);
    }
}
