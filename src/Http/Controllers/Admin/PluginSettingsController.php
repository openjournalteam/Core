<?php



namespace OpenJournalTeam\Core\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Artisan;
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
        $plugins = $this->pluginManager->getPlugins();

        $data['plugins'] = $plugins;

        return render('core::pages.settings.plugins.index', $data);
    }

    public function toggle(Request $request)
    {
        $plugin = $this->pluginManager->find($request->name);

        if ($request->enable === 'true') {
            $plugin->enable();
            Artisan::call('module:publish ' . $request->name);
        } else {
            $plugin->disable();
        }

        $json['msg'] = $request->enable === 'true' ? "Plugin {$request->name} enabled." : "Plugin {$request->name} disabled.";

        return response()->json(new JsonResponse($json), Response::HTTP_OK);
    }

    public function delete(Request $request)
    {
        $plugin = $this->pluginManager->find($request->name);

        $plugin->delete();

        $json['msg'] = "Plugin {$request->name} deleted.";

        return response()->json(new JsonResponse($json), Response::HTTP_OK);
    }

    public function migrate(Request $request)
    {
        // $plugin = $this->pluginManager->find($request->name);

        $artisan = Artisan::call('module:migrate ' . $request->name);

        $json['msg'] = $artisan === 0 ? "Plugin {$request->name} migrated." : "Plugin {$request->name} migration failed.";

        return response()->json(new JsonResponse($json), Response::HTTP_OK);
    }
}
