<?php

namespace OpenJournalTeam\Core\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends BaseController
{
  public function index(Request $request)
  {
    return render('core::pages.profile.index');
  }
}
