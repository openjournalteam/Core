<?php

namespace OpenJournalTeam\Core\Http\Controllers\Admin;

use Illuminate\Support\Facades\Artisan;

class AdministrationController extends AdminController
{
  public function index()
  {
    return render('core::pages.administration.index');
  }

  public function clear_cache()
  {

    Artisan::call('cache:clear');
    Artisan::call('view:clear');

    return back()->with('message', 'Success Clearing Cache!');
  }

  // TODO create function logout all user
  // public function logout_all_user()
  // {
  //   $sessions = glob(storage_path("framework/sessions/*"));
  //   foreach ($sessions as $file) {
  //     if (is_file($file))
  //       unlink($file);
  //   }
  // }
}
