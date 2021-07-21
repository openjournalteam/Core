<?php

namespace OpenJournalTeam\Core\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use OpenJournalTeam\Core\Classes\PluginManager;
use OpenJournalTeam\Core\Http\Resources\JsonResponse;

class PluginSettingsController extends AdminController
{
    private $pluginManager;

    public function __construct(PluginManager $pluginManager)
    {
        $this->pluginManager = $pluginManager;
    }

    public function index()
    {
        // dd(Cache::get('laravel-modules'));

        $plugins = $this->pluginManager->getPlugins();

        $data['plugins'] = $plugins;

        return render('core::pages.settings.plugins.index', $data);
    }

    public function toggle(Request $request)
    {
        $plugin = $this->pluginManager->find($request->name);

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
        $plugin = $this->pluginManager->find($request->name);

        $plugin->delete();

        $json['msg'] = "Plugin {$request->name} deleted.";

        $json = new JsonResponse($json);

        return response()->json($json, Response::HTTP_OK);
    }


    
}
