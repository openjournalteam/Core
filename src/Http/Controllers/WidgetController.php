<?php

namespace OpenJournalTeam\Core\Http\Controllers;

use Illuminate\Http\Request;

class WidgetController extends BaseController
{
  function updateSetting(Request $request)
  {
    $request->validate([
      'classes' => 'required|array',
      'column' => 'required|int',
    ]);

    foreach ($request->classes as $key =>  $class) {
      $class::setStaticPropertyValue('column', $request->column);
      $class::setStaticPropertyValue('sort', $key + 1);
      $class::updatePropertyToDatabase();
    }

    return response_success([
      'msg' => 'Success',
    ]);
  }
}
