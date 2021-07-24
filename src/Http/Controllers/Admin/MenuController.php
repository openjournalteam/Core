<?php

namespace OpenJournalTeam\Core\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use OpenJournalTeam\Core\Http\Resources\JsonResponse;
use OpenJournalTeam\Core\Models\Menu;

class MenuController extends AdminController
{
  public function index()
  {
    return render('core::pages.settings.menu.index');
  }

  public function delete()
  {
  }

  public function save(Request $request)
  {
    $validationArray = [
      'token' => 'required|string',
      'name' => 'required|string|max:255',
    ];

    $request->validate($validationArray);

    if ($request->input('route') && !Route::has($request->input('route'))) {
      return response()->json([
        'errors' => [
          'route' => 'Route not found',
        ],
        'message' => 'The given data was invalid.'

      ], 422);
    }

    Menu::updateOrCreate(
      ['token' => $request->token],
      [
        'id' => 100,
        'parent_id' => $request->input('parent', '0'),
        'name' => $request->input('name'),
        'icon' => $request->input('icon'),
        'order' => Menu::where('parent_id', $request->input('parent_id', 0))->max('order') + 1,
        'route' => $request->input('route'),
        'show' => $request->input('show', '0'),
        'roles' => $request->input('roles'),
      ]
    );

    $data = [
      'msg' => 'Success save data..',
    ];

    return response()->json(new JsonResponse($data));
  }

  public function edit(Menu $menu)
  {
    $role = $menu->roles;
  }
}
