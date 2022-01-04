<?php

namespace OpenJournalTeam\Core\Http\Controllers;

use Illuminate\Http\Request;
use OpenJournalTeam\Core\Models\WidgetSetting;

class WidgetController extends BaseController
{
  function updateSetting(Request $request)
  {

    $request->validate([
      'classes' => 'required|array',
      'column' => 'required|int',
    ]);

    foreach ($request->classes as $class) {
      $class::setSetting('column', $request->column);
    }

    return response_success([
      'msg' => 'Success',
    ]);
  }
}
