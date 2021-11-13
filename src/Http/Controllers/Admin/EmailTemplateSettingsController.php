<?php



namespace OpenJournalTeam\Core\Http\Controllers\Admin;

use Illuminate\Http\Request;
use OpenJournalTeam\Core\Models\Config;

class EmailTemplateSettingsController extends AdminController
{
  public function index()
  {
    $emailHeader = Config::firstOrCreate(['key' => 'mailtemplate.header']);
    $emailFooter = Config::firstOrCreate(['key' => 'mailtemplate.footer']);


    add_style('vendor/core/libs/summernote/summernote-lite.min.css');
    add_script('vendor/core/libs/summernote/summernote-lite.min.js');
    add_script('vendor/core/js/summernote.js');

    return render('core::pages.settings.email.index', compact('emailHeader', 'emailFooter'));
  }
  public function save_setup(Request $request)
  {
    $emailHeader = Config::firstOrCreate(['key' => 'mailtemplate.header']);
    $emailFooter = Config::firstOrCreate(['key' => 'mailtemplate.footer']);

    $emailHeader->value = $request->input('emailHeader');
    $emailFooter->value = $request->input('emailFooter');

    $emailHeader->save();
    $emailFooter->save();


    return response_success(['msg' => 'Email Template Settings Saved']);
  }
}
