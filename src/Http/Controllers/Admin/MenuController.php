<?php



namespace OpenJournalTeam\Core\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use OpenJournalTeam\Core\Http\Resources\JsonResponse;
use OpenJournalTeam\Core\Models\Menu;
use OpenJournalTeam\Core\Models\Role;

class MenuController extends AdminController
{
  public function index()
  {
    add_script('vendor/core/libs/sortablejs/sortablejs.bundle.js');
    add_script('vendor/core/js/pages/settings/menu.js');

    return render('core::pages.settings.menu.index');
  }

  public function delete(Request $request, Menu $menu)
  {
    if (!$request->ajax()) {
      return abort(401);
    }

    $menu->delete();

    $this->clearCache();

    return response()->json(new JsonResponse(['msg' => 'Remove Menu Success..']));
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
        'message' => 'The given data was invalid.',

      ], 422);
    }

    $show = $request->input('show') ? 1 : 0;
    $order = $request->input('order') ?: Menu::where('parent_id', $request->input('parent_id', 0))->max('order') + 1;

    $this->clearCache();

    Menu::updateOrCreate(
      ['token' => $request->token],
      [
        'parent_id' => $request->input('parent_id', '0'),
        'name' => $request->input('name'),
        'icon' => $request->input('icon'),
        'order' => $order,
        'route' => $request->input('route'),
        'show' => $show,
        'roles' => $request->input('roles', []),
      ]
    );

    $data = [
      'msg' => 'Success save data..',
    ];

    return response()->json(new JsonResponse($data));
  }

  public function edit(Menu $menu)
  {
    $menu->parent_id = Menu::select(['id', 'name as text'])->where('id', $menu->parent_id)->get();
    $menu->roles = Role::select(['id', 'name as text'])->whereIn('id', $menu->roles)->get()->makeHidden(['pivot']);

    return response()->json($menu);
  }

  public function options(Request $request)
  {
    $search = $request->input('search');

    $menus = Menu::orderBy('name')->select(['id', 'name as text'])->where('name', 'like', '%' . $search . '%')->where('parent_id', 0)->limit(10)->get();

    return response()->json([
      'results' => $menus,
    ]);
  }

  public function sort(Request $request)
  {
    $ids = $request->input('ids');

    $this->clearCache();

    foreach ($ids as $key => $id) {
      $menu = Menu::find($id);
      $menu->order = $key + 1;
      $menu->save();
    }

    return response()->json([
      'error' => 0,
      'message' => 'Success sorting data..',
    ]);
  }

  private function clearCache(): void
  {
    Cache::forget('menus');
  }
}
