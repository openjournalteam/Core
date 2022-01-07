<?php



namespace OpenJournalTeam\Core\Http\Controllers;

use App\Modules\Plugins\Models\Plugins;
use Exception;
use GrahamCampbell\ResultType\Result;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use OpenJournalTeam\Core\Classes\PluginManager;
use OpenJournalTeam\Core\Http\Resources\JsonResponse;

class PluginSettingsController extends BaseController
{
    private $pluginManager;
    protected $pluginPHPFolder;
    protected $pluginPythonFolder;

    public $masterPanelAPI = 'https://masterpanel.ini-sudah.online/api/v1/plugins';

    public function __construct(PluginManager $pluginManager)
    {
        $this->pluginManager = $pluginManager;
        $this->pluginPHPFolder = base_path('plugins');
        $this->pluginPythonFolder = base_path('python/plugins');
    }

    public function installPlugin(Request $request, String $slug)
    {
        $slug = $request->slug;

        /* Check tmp folder */
        if (!is_dir(base_path('tmp'))) {
            mkdir(base_path('tmp'), 0755);
        }

        $request = Http::asForm()->post(
            $this->masterPanelAPI . '/get_download_link',
            [
                'slug' => $slug,
            ]
        );

        if ($request->failed()) {
            return response_error(
                [
                    'message' => 'Error Caught when downloading plugin',
                ],
                Response::HTTP_OK
            );
        }

        $response = $request->object();


        foreach ($response->data->links as $key => $link) {
            /** Downloading.. */
            $url = $this->masterPanelAPI . '/download/' . $link;

            $request = Http::get($url);

            if ($request->failed()) {
                return response_error(
                    "Error Caught when downloading plugin {$key}",
                    Response::HTTP_OK
                );
            }


            /* Get contents */
            $contents = $request->body();

            $fileName = sprintf("%s_%s.zip", $slug, $key);
            $fileTmpFullPath = base_path(
                sprintf(
                    "tmp/%s",
                    $fileName
                )
            );

            /* Save to tmp folder */
            file_put_contents($fileTmpFullPath, $contents);

            /** Check if successfully download the content */
            if (!file_exists($fileTmpFullPath)) {
                return response_error("Install Plugin Failed", Response::HTTP_OK);
            }


            $extractTo = function ($filePath, $destination) {
                $zip = new \ZipArchive();
                $isExists = $zip->open($filePath);
                if ($isExists === true) {
                    if (is_dir($destination) === false) {
                        return false;
                    }
                    $zip->extractTo($destination);
                    $zip->close();
                    return true;
                }
            };

            $targetFolder = $key == 'php' ? $this->pluginPHPFolder : $this->pluginPythonFolder;

            $extract = $extractTo($fileTmpFullPath, $targetFolder);

            if (!$extract) {
                // Delete because we failed extract it
                unlink($fileTmpFullPath);
                return response_error(
                    "Error Caught when extracting plugin {$key}",
                    Response::HTTP_OK
                );
            }

            /* Remove file */
            unlink(sprintf(base_path("tmp/%s"), $fileName));
        }

        /* Move seeders */
        $files = getDirContents($this->pluginPHPFolder . "/{$response->data->name}/Database/Seeders");

        foreach ($files as $file) {
            copy($file, base_path('database/seeders') . '/' . basename($file));

            /* Run Seeders */
            $className = basename($file, '.php');
            if (class_exists("Database\\Seeders\\" . $className)) {
                Artisan::call('db:seed --class=' . $className);
                Artisan::call('optimize:clear'); // Clear cache sehingga menu bisa lgsg terubah
            }
        }

        /* Publish Assets */
        Artisan::call('module:publish ' . $response->data->name);
        Artisan::call('module:migrate-refresh ' . $response->data->name);

        $plugin = Plugins::where('name', $response->data->name)->firstOrNew();

        $plugin->name       = $response->data->name;
        $plugin->slug       = $slug;
        $plugin->php_path   = $this->pluginPHPFolder . "/{$response->data->name}";
        $plugin->version    = $response->data->version ?? '1.0.0';
        $plugin->status     = Plugins::ACTIVE;
        $plugin->save();

        return response_success(
            [
                'message' => 'Plugin successfully installed',
            ],
            Response::HTTP_OK
        );
    }

    public function index()
    {
        $plugins            = $this->pluginManager->getPlugins();
        $data['plugins']    = $plugins;

        $request    = Http::get($this->masterPanelAPI . '/list');
        $pluginList = [];

        if ($request->successful()) {
            $pluginList = $request->object()->data;
        }

        $data['pluginList'] = $pluginList;

        add_script('vendor/core/js/plugins.js');

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

        return response_success($json);
    }

    public function delete(Request $request)
    {
        $plugin = $this->pluginManager->find($request->name);

        $plugin->delete();

        $json['msg'] = "Plugin {$request->name} deleted.";

        return response_success($json);
    }

    public function migrate(Request $request)
    {
        // $plugin = $this->pluginManager->find($request->name);

        $artisan = Artisan::call('module:migrate ' . $request->name);

        $json['msg'] = $artisan === 0 ? "Plugin {$request->name} migrated." : "Plugin {$request->name} migration failed.";

        return response()->json(new JsonResponse($json), Response::HTTP_OK);
    }
}
