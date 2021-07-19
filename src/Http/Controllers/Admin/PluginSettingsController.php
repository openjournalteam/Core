<?php

namespace OpenJournalTeam\Core\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Nwidart\Modules\Facades\Module;
use OpenJournalTeam\Core\Classes\PluginManager;
use OpenJournalTeam\Core\Http\Controllers\BaseController;
use OpenJournalTeam\Core\Http\Resources\JsonResponse;

class PluginSettingsController extends BaseController
{
    public function index()
    {
        $plugins = Module::toCollection();

        $data['plugins'] = $plugins;

        return render('core::pages.settings.plugins.index', $data);
    }

    public function toggle(Request $request)
    {
        $plugin = Module::find($request->name);

        if ($request->enable === 'true') {
            $plugin->enable();
        } else {
            $plugin->disable();
        }

        $json['msg'] = $request->enable === 'true' ? "Plugin {$request->name} enabled." : "Plugin {$request->name} disabled.";

        $json = new JsonResponse($json);

        return response()->json($json, Response::HTTP_OK);
    }

    public function delete(Request $request)
    {
        $plugin = Module::find($request->name);

        $plugin->delete();

        $json['msg'] = "Plugin {$request->name} deleted.";

        $json = new JsonResponse($json);

        return response()->json($json, Response::HTTP_OK);
    }
}
