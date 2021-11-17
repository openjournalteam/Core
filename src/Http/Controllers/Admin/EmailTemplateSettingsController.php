<?php

namespace OpenJournalTeam\Core\Http\Controllers\Admin;

use Illuminate\Http\Request;
use OpenJournalTeam\Core\Models\Config;
use OpenJournalTeam\Core\Models\MailTemplate;
use Yajra\DataTables\DataTables;

class EmailTemplateSettingsController extends AdminController
{
  public function index(Request $request)
  {
    if ($request->ajax()) {
      $data = MailTemplate::query();
      return DataTables::of($data)
        ->addIndexColumn()
        ->editColumn('key', function ($mailTemplate) {
          return view('core::pages.settings.email.datatables.template.key', compact('mailTemplate'));
        })
        ->make(true);
    }

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

  public function save_template(Request $request)
  {
    $validationArray = [
      'key' => 'required|string|max:255',
      'subject' => 'required|string|max:255',
      'html_template' => 'string',
    ];

    $request->validate($validationArray);

    $inputArray = $request->only('subject', 'html_template');

    MailTemplate::updateOrCreate(
      [
        'key' => $request->input('key'),
      ],
      $inputArray
    );

    return response_success(['msg' => 'Email Template Saved']);
  }

  public function edit_template(Request $request, MailTemplate $mailTemplate)
  {
    abort_if(!$request->ajax(), 401);

    return response()->json($mailTemplate);
  }

  public function reset_template(Request $request, MailTemplate $mailTemplate)
  {
    abort_if(!$request->ajax(), 401);

    if (!$mailTemplate->resetToDefaultTemplate()) {
      return response_error(['msg' => 'Failed to reset template']);
    };

    return response_success(['msg' => 'Template reset to default']);
  }
}
